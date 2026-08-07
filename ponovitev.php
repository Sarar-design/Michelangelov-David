<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Ponovitev';

$vprasanja = [
    [
        'q' => 'Zakaj je David simbol Firenc?',
        'a' => 'Firence so se leta 1494 rešile izpod družine Medici, kar jih je povezalo z Davidom, mladeničem, ki se bori proti Goljatu. David simbolizira pogum in pripravo na spopad, kar je pomembno za identiteto Firenc.',
    ],
    [
        'q' => 'Značilni elementi antike, ki jih najdemo na kipu Davida',
        'a' => 'Golota, velikost, drža (kontrapost) in mišičasto telo so značilni za antično kiparstvo. Ti elementi poudarjajo lepoto in moč človeške figure.',
    ],
    [
        'q' => 'Razlika med kipom in bibličnim Davidom',
        'a' => 'Kip Davida prikazuje starejšega in močnejšega mladeniča v primerjavi z bibličnim Davidom. Michelangelov David predstavlja idealizirano obliko junaka, medtem ko je David v bibliji navaden pastir.',
    ],
    [
        'q' => 'Pretirano veliki proporci',
        'a' => 'Večja glava simbolizira koncentracijo na tarčo, večji roki pa dajeta pozornost na orožje. To izraža miselnost in dejanje, preden David premaga Goljata.',
    ],
    [
        'q' => 'Posebnost Davidove drže',
        'a' => 'Davidova desna noga nosi težo, leva pa je pokrčena, kar ustvarja S-krivuljo. Ta drža daje vizualno iluzijo gibanja in namiguje na prihodnjo akcijo.',
    ],
    [
        'q' => 'Razlike med Verrochiovim, Donatellovim in Michelangelovim Davidom',
        'a' => 'Donatello in Verrochio prikazujeta Davida po zmagi, medtem ko Michelangelo predstavlja mladeniča pred bitko. Michelangelov David je antični junak, medtem ko sta Donatellov in Verrocchiov David običajna pastirja.',
    ],
];
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <?php include __DIR__ . '/includes/header.php'; ?>
</head>
<body>
    <?php include __DIR__ . '/includes/nav.php'; ?>

    <header class="section pb-0" style="padding-top:8.5rem;">
        <div class="container text-center">
            <h1 class="section-title">Ponovitev</h1>
            <p class="section-subtitle mx-auto">Klikni na kartico, da preveriš odgovor.</p>
        </div>
    </header>

    <main class="container section pt-4">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php foreach ($vprasanja as $item): ?>
            <div class="col">
                <div class="flip-card reveal" tabindex="0">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <h5><?= htmlspecialchars($item['q']) ?></h5>
                            <span class="flip-hint"><i class="fa-solid fa-rotate me-1"></i>Klikni za odgovor</span>
                        </div>
                        <div class="flip-card-back">
                            <p><?= htmlspecialchars($item['a']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
