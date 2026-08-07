<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/includes/auth.php';
$pageTitle = 'Uredi vprašanje';

$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM vprasanja WHERE id = ?");
$stmt->execute([$id]);
$vprasanjeRow = $stmt->fetch();

if (!$vprasanjeRow) {
    header('Location: vprasanja.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vprasanje = trim($_POST['vprasanje'] ?? '');
    $tip = $_POST['tip'] ?? 'select';
    $vrstniRed = (int) ($_POST['vrstni_red'] ?? 0);
    $aktivno = isset($_POST['aktivno']) ? 1 : 0;

    if (!in_array($tip, ['select', 'radio', 'checkbox', 'text'], true)) {
        $tip = 'select';
    }

    if ($vprasanje === '') {
        $error = 'Besedilo vprašanja je obvezno.';
    } elseif ($tip === 'text') {
        $pravilniOdgovor = trim($_POST['text_answer'] ?? '');
        if ($pravilniOdgovor === '') {
            $error = 'Vnesi pravilen odgovor.';
        }
        $odgovoriJson = null;
        $pravilniJson = json_encode($pravilniOdgovor, JSON_UNESCAPED_UNICODE);
    } else {
        $options = array_values(array_filter(array_map('trim', $_POST['options'] ?? []), fn($v) => $v !== ''));
        if (count($options) < 2) {
            $error = 'Dodaj vsaj dva možna odgovora.';
        }

        if ($tip === 'checkbox') {
            $correctIdx = array_map('intval', $_POST['correct'] ?? []);
        } else {
            $correctIdx = isset($_POST['correct_radio']) ? [(int) $_POST['correct_radio']] : [];
        }

        if (empty($correctIdx)) {
            $error = $error ?: 'Označi vsaj en pravilen odgovor.';
        }

        $odgovoriJson = json_encode($options, JSON_UNESCAPED_UNICODE);

        if ($tip === 'checkbox') {
            $correctValues = array_values(array_intersect_key($options, array_flip($correctIdx)));
            $pravilniJson = json_encode($correctValues, JSON_UNESCAPED_UNICODE);
        } else {
            $correctValue = $options[$correctIdx[0]] ?? '';
            $pravilniJson = json_encode($correctValue, JSON_UNESCAPED_UNICODE);
        }
    }

    if (!$error) {
        $stmt = $pdo->prepare("UPDATE vprasanja SET vprasanje = ?, tip = ?, odgovori = ?, pravilni_odgovor = ?, vrstni_red = ?, aktivno = ? WHERE id = ?");
        $stmt->execute([$vprasanje, $tip, $odgovoriJson, $pravilniJson, $vrstniRed, $aktivno, $id]);
        header('Location: vprasanja.php?ok=1');
        exit;
    }
}

$odgovoriArr = $vprasanjeRow['odgovori'] ? json_decode($vprasanjeRow['odgovori'], true) : [];
$pravilniArr = json_decode($vprasanjeRow['pravilni_odgovor'], true);
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <?php include __DIR__ . '/../includes/header.php'; ?>
</head>
<body class="admin-body">
    <div class="container-fluid">
        <div class="row">
            <?php include __DIR__ . '/includes/sidebar.php'; ?>

            <div class="col-lg-10 py-4">
                <h2 class="mb-4" style="font-family: var(--font-display);">Uredi vprašanje</h2>

                <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

                <div class="admin-card">
                    <form method="POST" id="questionForm">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Besedilo vprašanja</label>
                            <textarea name="vprasanje" class="form-control" rows="2" required><?= htmlspecialchars($_POST['vprasanje'] ?? $vprasanjeRow['vprasanje']) ?></textarea>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Tip vprašanja</label>
                                <select name="tip" id="tip" class="form-select">
                                    <?php foreach (['select' => 'Spustni seznam (en odgovor)', 'radio' => 'Enoizbirno (radio)', 'checkbox' => 'Večizbirno (checkbox)', 'text' => 'Prosto besedilo'] as $val => $label): ?>
                                        <option value="<?= $val ?>" <?= $vprasanjeRow['tip'] === $val ? 'selected' : '' ?>><?= $label ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Vrstni red</label>
                                <input type="number" name="vrstni_red" class="form-control" value="<?= (int) $vprasanjeRow['vrstni_red'] ?>">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="aktivno" id="aktivno" <?= $vprasanjeRow['aktivno'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="aktivno">Aktivno (prikazano v testu)</label>
                                </div>
                            </div>
                        </div>

                        <div id="optionsSection" class="mb-3">
                            <label class="form-label fw-semibold">Možni odgovori <small class="text-muted">(označi pravilnega/e)</small></label>
                            <div id="optionsList"></div>
                            <button type="button" id="btnAddOption" class="btn btn-sm btn-outline-secondary mt-1"><i class="fa-solid fa-plus me-1"></i>Dodaj odgovor</button>
                        </div>

                        <div id="textAnswerWrap" class="mb-3 d-none">
                            <label class="form-label fw-semibold">Pravilen odgovor</label>
                            <input type="text" name="text_answer" class="form-control" value="<?= htmlspecialchars($vprasanjeRow['tip'] === 'text' ? (string) $pravilniArr : '') ?>">
                        </div>

                        <button type="submit" class="btn btn-bronze"><i class="fa-solid fa-floppy-disk me-1"></i>Shrani spremembe</button>
                        <a href="vprasanja.php" class="btn btn-outline-secondary">Prekliči</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.PREFILL_OPTIONS = <?= json_encode($odgovoriArr ?: [], JSON_UNESCAPED_UNICODE) ?>;
        window.PREFILL_CORRECT = <?= json_encode($pravilniArr, JSON_UNESCAPED_UNICODE) ?>;
    </script>
    <script src="<?= BASE_URL ?>assets/js/admin-question-form.js"></script>
</body>
</html>
