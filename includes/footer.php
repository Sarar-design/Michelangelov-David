<?php if (!defined('BASE_URL')) { require_once __DIR__ . '/config.php'; } ?>
<footer class="site-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5>Michelangelov David</h5>
                <p class="small">Spletna učilnica, namenjena spoznavanju enega največjih mojstrovin renesančne kiparske umetnosti.</p>
                <div class="socials">
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="Wikipedia"><i class="fa-brands fa-wikipedia-w"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Povezave</h5>
                <ul class="list-unstyled">
                    <li><a href="<?= BASE_URL ?>index.php">Domov</a></li>
                    <li><a href="<?= BASE_URL ?>gradivo1.php">Gradivo</a></li>
                    <li><a href="<?= BASE_URL ?>ponovitev.php">Ponovitev</a></li>
                    <li><a href="<?= BASE_URL ?>gallery/galerija.php">Galerija</a></li>
                    <li><a href="<?= BASE_URL ?>quiz/test.php">Test znanja</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>O projektu</h5>
                <p class="small">Kip Davida je delo Michelangela Buonarrotija, izklesano med letoma 1501 in 1504, in velja za enega najbolj prepoznavnih simbolov renesanse.</p>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; <?= date('Y') ?> Michelangelov David &middot; Izobraževalni projekt
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/script.js"></script>
