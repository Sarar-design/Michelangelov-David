<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
$pageTitle = 'Namestitev';


$exists = (int) $pdo->query("SELECT COUNT(*) AS c FROM admin_users")->fetch()['c'] > 0;

$error = '';
$success = false;

if (!$exists && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = (string) ($_POST['password'] ?? '');
    $password2 = (string) ($_POST['password2'] ?? '');

    if ($username === '' || $password === '') {
        $error = 'Uporabniško ime in geslo sta obvezna.';
    } elseif (strlen($password) < 6) {
        $error = 'Geslo mora imeti vsaj 6 znakov.';
    } elseif ($password !== $password2) {
        $error = 'Gesli se ne ujemata.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password_hash) VALUES (?, ?)");
        $stmt->execute([$username, $hash]);
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <?php include __DIR__ . '/../includes/header.php'; ?>
</head>
<body class="admin-body">
    <div class="login-shell">
        <div class="login-card text-center">
            <i class="fa-solid fa-shield-halved fa-2x text-bronze mb-3"></i>
            <h3 class="mb-3" style="font-family: var(--font-display);">Namestitev administratorja</h3>

            <?php if ($exists): ?>
                <p class="text-muted">Administrator je že ustvarjen. Ta stran je zdaj onemogočena.</p>
                <a href="login.php" class="btn btn-bronze w-100 mt-2">Pojdi na prijavo</a>
            <?php elseif ($success): ?>
                <p class="text-success"><i class="fa-solid fa-circle-check me-1"></i>Administrator je bil uspešno ustvarjen.</p>
                <a href="login.php" class="btn btn-bronze w-100 mt-2">Prijava</a>
            <?php else: ?>
                <p class="text-muted small">Ta obrazec je na voljo samo enkrat, za ustvarjanje prvega administratorskega računa.</p>
                <?php if ($error): ?><div class="alert alert-danger py-2"><?= htmlspecialchars($error) ?></div><?php endif; ?>
                <form method="POST" class="text-start">
                    <div class="mb-3">
                        <label class="form-label">Uporabniško ime</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Geslo</label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ponovi geslo</label>
                        <input type="password" name="password2" class="form-control" required minlength="6">
                    </div>
                    <button type="submit" class="btn btn-bronze w-100">Ustvari administratorja</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
