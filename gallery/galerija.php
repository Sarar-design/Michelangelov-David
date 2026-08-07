<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'Galerija';

$slike = [
    ['src' => 'David5.jpeg',    'title' => 'Michelangelov David',      'desc' => 'Celoten pogled na kip v Galleria dell\'Accademia.'],
    ['src' => 'David4.jpeg',    'title' => 'Velikost kipa',            'desc' => 'Kip je visok kar 5,17 metra.'],
    ['src' => 'David8.jpeg',    'title' => 'Golota kipa',              'desc' => 'Prvi javno razstavljeni goli kip po antiki.'],
    ['src' => 'Roka.jpeg',      'title' => 'Roki in glava',            'desc' => 'Nesorazmerno veliki roki in glava.'],
    ['src' => 'Drza.jpeg',      'title' => 'Kontrapost drža',          'desc' => 'Vizualna iluzija gibanja telesa.'],
    ['src' => 'Michelangelo.jpeg', 'title' => 'Michelangelo Buonarroti', 'desc' => 'Avtor kipa Davida.'],
    ['src' => 'Donatello.jpeg', 'title' => 'Donatellov David',         'desc' => 'Zgodnejša upodobitev Davida.'],
    ['src' => 'Verocchio.jpeg', 'title' => 'Verrocchiov David',        'desc' => 'Še ena predhodna interpretacija.'],
    ['src' => 'Freska.jpeg',    'title' => 'Freska v Sikstinski kapeli', 'desc' => 'Michelangelova poznejša upodobitev Davida.'],
    ['src' => 'david.jpeg',     'title' => 'David in Goljat',          'desc' => 'Ilustracija biblične zgodbe.'],
    ['src' => 'Florence.jpeg',  'title' => 'Firence',                  'desc' => 'Mesto, katerega simbol je postal kip.'],
];
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <?php include __DIR__ . '/../includes/header.php'; ?>
</head>
<body>
    <?php include __DIR__ . '/../includes/nav.php'; ?>

    <header class="section pb-0" style="padding-top:8.5rem;">
        <div class="container text-center">
            <h1 class="section-title">Galerija</h1>
            <p class="section-subtitle mx-auto">Klikni na sliko za povečan prikaz.</p>
        </div>
    </header>

    <main class="container section pt-4">
        <div class="row">
            <?php foreach ($slike as $i => $slika): ?>
            <div class="col-sm-6 col-lg-4">
                <div class="gallery-item reveal" data-index="<?= $i ?>">
                    <img src="../assets/images/<?= htmlspecialchars($slika['src']) ?>" alt="<?= htmlspecialchars($slika['title']) ?>" loading="lazy">
                    <div class="gallery-caption"><?= htmlspecialchars($slika['title']) ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    
    <div class="lightbox-overlay" id="lightbox">
        <button class="lightbox-close" id="lightboxClose" aria-label="Zapri"><i class="fa-solid fa-xmark"></i></button>
        <button class="lightbox-prev" id="lightboxPrev" aria-label="Prejšnja"><i class="fa-solid fa-chevron-left"></i></button>
        <img id="lightboxImg" src="" alt="">
        <button class="lightbox-next" id="lightboxNext" aria-label="Naslednja"><i class="fa-solid fa-chevron-right"></i></button>
        <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <script>
        window.GALLERY_IMAGES = <?= json_encode(array_map(function ($s) {
            return ['src' => '../assets/images/' . $s['src'], 'title' => $s['title'], 'desc' => $s['desc']];
        }, $slike), JSON_UNESCAPED_UNICODE) ?>;
    </script>
    <script src="<?= BASE_URL ?>assets/js/gallery.js"></script>
</body>
</html>
