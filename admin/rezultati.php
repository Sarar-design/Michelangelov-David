<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/includes/auth.php';
$pageTitle = 'Rezultati';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM quiz_rezultati WHERE id = ?");
    $stmt->execute([(int) $_POST['delete_id']]);
    header('Location: rezultati.php?ok=1');
    exit;
}

$rezultati = $pdo->query("SELECT * FROM quiz_rezultati ORDER BY submission_date DESC")->fetchAll();
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
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 style="font-family: var(--font-display);">Rezultati kviza</h2>
                    <span class="text-muted"><?= count($rezultati) ?> zapisov</span>
                </div>

                <?php if (isset($_GET['ok'])): ?>
                    <div class="alert alert-success">Zapis je bil izbrisan.</div>
                <?php endif; ?>

                <div class="admin-card p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Ime</th>
                                    <th>Rezultat</th>
                                    <th>Odstotek</th>
                                    <th>Čas reševanja</th>
                                    <th>Datum</th>
                                    <th class="text-end">Dejanja</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($rezultati)): ?>
                                    <tr><td colspan="6" class="text-center text-muted py-4">Ni podatkov.</td></tr>
                                <?php endif; ?>
                                <?php foreach ($rezultati as $r): ?>
                                <tr>
                                    <td><?= htmlspecialchars($r['ime']) ?></td>
                                    <td><?= (int) $r['tocke'] ?> / <?= (int) $r['skupaj'] ?></td>
                                    <td>
                                        <span class="badge <?= $r['odstotek'] >= 70 ? 'bg-success' : ($r['odstotek'] >= 50 ? 'bg-warning text-dark' : 'bg-danger') ?>">
                                            <?= $r['odstotek'] ?>%
                                        </span>
                                    </td>
                                    <td><?= $r['cas_sekund'] !== null ? gmdate('i:s', (int) $r['cas_sekund']) : '-' ?></td>
                                    <td><?= date('d.m.Y H:i', strtotime($r['submission_date'])) ?></td>
                                    <td class="text-end">
                                        <form method="POST" onsubmit="return confirm('Izbrišem ta zapis?');" class="d-inline">
                                            <input type="hidden" name="delete_id" value="<?= (int) $r['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
