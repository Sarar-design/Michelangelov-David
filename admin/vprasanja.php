<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/includes/auth.php';
$pageTitle = 'Vsa vprašanja';

$vprasanja = $pdo->query("SELECT * FROM vprasanja ORDER BY vrstni_red ASC, id ASC")->fetchAll();

$tipLabels = ['select' => 'Spustni seznam', 'radio' => 'Enoizbirno', 'checkbox' => 'Večizbirno', 'text' => 'Prosto besedilo'];
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
                    <h2 style="font-family: var(--font-display);">Vsa vprašanja</h2>
                    <a href="dodaj_vprasanje.php" class="btn btn-bronze"><i class="fa-solid fa-plus me-1"></i>Dodaj vprašanje</a>
                </div>

                <?php if (isset($_GET['ok'])): ?>
                    <div class="alert alert-success">Sprememba je bila uspešno shranjena.</div>
                <?php endif; ?>

                <div class="admin-card p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Vprašanje</th>
                                    <th>Tip</th>
                                    <th>Status</th>
                                    <th class="text-end">Dejanja</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($vprasanja)): ?>
                                    <tr><td colspan="5" class="text-center text-muted py-4">Ni vprašanj. Dodaj prvo!</td></tr>
                                <?php endif; ?>
                                <?php foreach ($vprasanja as $v): ?>
                                <tr>
                                    <td><?= (int) $v['vrstni_red'] ?></td>
                                    <td><?= htmlspecialchars(mb_strimwidth($v['vprasanje'], 0, 80, '...')) ?></td>
                                    <td><span class="badge bg-secondary"><?= $tipLabels[$v['tip']] ?? $v['tip'] ?></span></td>
                                    <td>
                                        <?php if ($v['aktivno']): ?>
                                            <span class="badge bg-success">Aktivno</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Skrito</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <a href="uredi_vprasanje.php?id=<?= (int) $v['id'] ?>" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                                        <form action="izbrisi.php" method="POST" class="d-inline" onsubmit="return confirm('Ali res želite izbrisati to vprašanje?');">
                                            <input type="hidden" name="id" value="<?= (int) $v['id'] ?>">
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
