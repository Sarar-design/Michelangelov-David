<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
$pageTitle = 'Admin prijava';

if (!empty($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = (string) ($_POST['password'] ?? '');

    $stmt = $pdo->prepare("SELECT id, username, password_hash FROM admin_users WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Napačno uporabniško ime ali geslo.';
}
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <?php include __DIR__ . '/../includes/header.php'; ?>
</head>
<body class="admin-body">
    <div class="login-shell">
        <div class="login-card">
            <div class="text-center mb-3">
                <i class="fa-solid fa-user-shield fa-2x text-bronze mb-2"></i>
                <h3 style="font-family: var(--font-display);">Admin prijava</h3>
            </div>
            <?php if ($error): ?><div class="alert alert-danger py-2"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Uporabniško ime</label>
                    <input type="text" name="username" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Geslo</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-bronze w-100">Prijava</button>
            </form>
            <p class="text-center small text-muted mt-3 mb-0">
                Prvi administrator? <a href="setup.php">Ustvari račun</a>
            </p>
        </div>
    </div>
</body>
</html>
