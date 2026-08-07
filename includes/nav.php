<?php
if (!defined('BASE_URL')) { require_once __DIR__ . '/config.php'; }
$current = basename($_SERVER['SCRIPT_NAME']);
function navActive($file, $current) {
    return $file === $current ? 'active' : '';
}
?>
<nav class="navbar navbar-expand-lg site-navbar fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>index.php">
            <i class="fa-solid fa-mound me-1 text-bronze"></i> Michelangelov <span>David</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Preklopi navigacijo">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link <?= navActive('index.php', $current) ?>" href="<?= BASE_URL ?>index.php">Domov</a></li>
                <li class="nav-item"><a class="nav-link <?= navActive('gradivo1.php', $current) ?>" href="<?= BASE_URL ?>gradivo1.php">Gradivo</a></li>
                <li class="nav-item"><a class="nav-link <?= navActive('ponovitev.php', $current) ?>" href="<?= BASE_URL ?>ponovitev.php">Ponovitev</a></li>
                <li class="nav-item"><a class="nav-link <?= navActive('galerija.php', $current) ?>" href="<?= BASE_URL ?>gallery/galerija.php">Galerija</a></li>
                <li class="nav-item"><a class="nav-link <?= navActive('test.php', $current) ?>" href="<?= BASE_URL ?>quiz/test.php">Test</a></li>
            </ul>
        </div>
    </div>
</nav>
