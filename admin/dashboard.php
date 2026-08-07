<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/includes/auth.php';
$pageTitle = 'Nadzorna plošča';

$stevVprasanj = (int) $pdo->query("SELECT COUNT(*) c FROM vprasanja WHERE aktivno = 1")->fetch()['c'];
$stevRezultatov = (int) $pdo->query("SELECT COUNT(*) c FROM quiz_rezultati")->fetch()['c'];
$povprecje = $pdo->query("SELECT ROUND(AVG(odstotek),1) p FROM quiz_rezultati")->fetch()['p'];
$povprecje = $povprecje ?? 0;
$najboljsi = $pdo->query("SELECT ime, odstotek FROM quiz_rezultati ORDER BY odstotek DESC, cas_sekund ASC LIMIT 1")->fetch();


$zadnji = $pdo->query("SELECT ime, odstotek, submission_date FROM quiz_rezultati ORDER BY submission_date DESC LIMIT 20")->fetchAll();
$zadnji = array_reverse($zadnji);


$distribucija = [
    '90-100%' => 0, '70-89%' => 0, '50-69%' => 0, '0-49%' => 0,
];
foreach ($pdo->query("SELECT odstotek FROM quiz_rezultati") as $r) {
    $o = (float) $r['odstotek'];
    if ($o >= 90) $distribucija['90-100%']++;
    elseif ($o >= 70) $distribucija['70-89%']++;
    elseif ($o >= 50) $distribucija['50-69%']++;
    else $distribucija['0-49%']++;
}
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
                <h2 class="mb-4" style="font-family: var(--font-display);">Nadzorna plošča</h2>

                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fa-solid fa-circle-question"></i></div>
                            <div>
                                <div class="stat-value"><?= $stevVprasanj ?></div>
                                <div class="stat-label">Aktivnih vprašanj</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                            <div>
                                <div class="stat-value"><?= $stevRezultatov ?></div>
                                <div class="stat-label">Rešenih testov</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fa-solid fa-percent"></i></div>
                            <div>
                                <div class="stat-value"><?= $povprecje ?>%</div>
                                <div class="stat-label">Povprečni rezultat</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fa-solid fa-trophy"></i></div>
                            <div>
                                <div class="stat-value"><?= $najboljsi ? $najboljsi['odstotek'] . '%' : '-' ?></div>
                                <div class="stat-label"><?= $najboljsi ? htmlspecialchars($najboljsi['ime']) : 'Ni podatkov' ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-lg-7">
                        <div class="admin-card">
                            <h5 class="mb-3">Rezultati skozi čas (zadnjih 20)</h5>
                            <canvas id="lineChart" height="110"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="admin-card">
                            <h5 class="mb-3">Porazdelitev ocen</h5>
                            <canvas id="pieChart" height="110"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        const lineCtx = document.getElementById('lineChart');
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_map(fn($r) => $r['ime'], $zadnji), JSON_UNESCAPED_UNICODE) ?>,
                datasets: [{
                    label: 'Odstotek (%)',
                    data: <?= json_encode(array_map(fn($r) => (float) $r['odstotek'], $zadnji)) ?>,
                    borderColor: '#b3823a',
                    backgroundColor: 'rgba(179,130,58,.15)',
                    tension: 0.35,
                    fill: true,
                    pointBackgroundColor: '#8f6529',
                }]
            },
            options: {
                scales: { y: { min: 0, max: 100, ticks: { callback: v => v + '%' } } },
                plugins: { legend: { display: false } }
            }
        });

        const pieCtx = document.getElementById('pieChart');
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode(array_keys($distribucija)) ?>,
                datasets: [{
                    data: <?= json_encode(array_values($distribucija)) ?>,
                    backgroundColor: ['#2f9e5c', '#b3823a', '#e0a94f', '#d9534f']
                }]
            },
            options: { plugins: { legend: { position: 'bottom' } } }
        });
    </script>
</body>
</html>
