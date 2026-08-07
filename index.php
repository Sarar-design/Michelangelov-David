<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Domov';
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <?php include __DIR__ . '/includes/header.php'; ?>
</head>
<body>
    <?php include __DIR__ . '/includes/nav.php'; ?>

    <!-- HERO -->
    <section class="hero" style="--hero-image: url('<?= BASE_URL ?>assets/images/David5.jpeg');">
        <div class="hero-content">
            <span class="hero-kicker">Renesančna mojstrovina &middot; 1501–1504</span>
            <h1>Michelangelov David</h1>
            <p class="lead">Raziskuj zgodovino najbolj znamenitega renesančnega kipa, spoznaj njegov pomen za Firence in svoje znanje preveri z interaktivnim testom.</p>
            <div class="hero-actions">
                <a href="gradivo1.php" class="btn btn-bronze">Raziskuj <i class="fa-solid fa-arrow-right ms-1"></i></a>
                <a href="quiz/test.php" class="btn btn-outline-marble">Preizkusi znanje</a>
            </div>
        </div>
        <a href="#razisci" class="scroll-cue"><i class="fa-solid fa-chevron-down"></i></a>
    </section>

    <!-- KARTICE -->
    <section class="section" id="razisci">
        <div class="container text-center">
            <h2 class="section-title">Odkrij svet <span class="text-bronze">Davida</span></h2>
            <p class="section-subtitle mx-auto">Od zgodovinskega ozadja do umetniške analize kipa - vse na enem mestu.</p>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card reveal">
                        <div class="icon-wrap"><i class="fa-solid fa-scroll"></i></div>
                        <h3>Zgodovina</h3>
                        <p>Spoznaj zgodbo Davida iz Biblije in okoliščine, v katerih je Michelangelo prejel naročilo za kip.</p>
                        <a href="gradivo1.php" class="btn btn-sm btn-outline-secondary mt-3">Preberi več</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card reveal" style="transition-delay:.1s">
                        <div class="icon-wrap"><i class="fa-solid fa-person-rays"></i></div>
                        <h3>Kip</h3>
                        <p>Analiza drže, proporcev in golote kipa ter njihovega pomena v kontekstu renesančne umetnosti.</p>
                        <a href="gradivo1.php" class="btn btn-sm btn-outline-secondary mt-3">Preberi več</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card reveal" style="transition-delay:.2s">
                        <div class="icon-wrap"><i class="fa-solid fa-palette"></i></div>
                        <h3>Michelangelo</h3>
                        <p>Kdo je bil umetnik, ki je iz zavrženega marmornega bloka ustvaril eno največjih mojstrovin?</p>
                        <a href="gradivo1.php" class="btn btn-sm btn-outline-secondary mt-3">Preberi več</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA za kviz -->
    <section class="section pt-0">
        <div class="container">
            <div class="feature-card reveal d-flex flex-column flex-md-row align-items-center justify-content-between gap-3" style="background: linear-gradient(135deg, var(--navy-700), var(--ink-900)); color:#fff;">
                <div>
                    <h3 style="color:#fff;"><i class="fa-solid fa-graduation-cap text-bronze me-2"></i>Pripravljen na izziv?</h3>
                    <p class="mb-0" style="color:rgba(255,255,255,.75);">Preveri svoje znanje z interaktivnim testom - s časovnikom, takojšnjo povratno informacijo in oceno.</p>
                </div>
                <a href="quiz/test.php" class="btn btn-bronze text-nowrap">Začni test <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
