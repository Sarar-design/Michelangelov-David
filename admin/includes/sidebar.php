<?php
$current = basename($_SERVER['SCRIPT_NAME']);
function adminActive($file, $current) { return $file === $current ? 'active' : ''; }
?>
<div class="col-lg-2 admin-sidebar">
    <a href="dashboard.php" class="brand"><i class="fa-solid fa-mound text-bronze me-1"></i>Admin</a>
    <nav class="nav flex-column">
        <a class="nav-link <?= adminActive('dashboard.php', $current) ?>" href="dashboard.php"><i class="fa-solid fa-chart-line me-2"></i>Nadzorna plošča</a>
        <a class="nav-link <?= adminActive('dodaj_vprasanje.php', $current) ?>" href="dodaj_vprasanje.php"><i class="fa-solid fa-circle-plus me-2"></i>Dodaj vprašanje</a>
        <a class="nav-link <?= in_array($current, ['dodaj_vprasanje.php','uredi_vprasanje.php']) && $current !== 'dodaj_vprasanje.php' ? 'active' : '' ?> <?= adminActive('vprasanja.php', $current) ?>" href="vprasanja.php"><i class="fa-solid fa-list-check me-2"></i>Vsa vprašanja</a>
        <a class="nav-link <?= adminActive('rezultati.php', $current) ?>" href="rezultati.php"><i class="fa-solid fa-table me-2"></i>Rezultati</a>
        <hr style="border-color: rgba(255,255,255,.1);">
        <a class="nav-link" href="../index.php" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square me-2"></i>Ogled strani</a>
        <a class="nav-link" href="logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i>Odjava</a>
    </nav>
</div>
