<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';


$stmt = $pdo->query("SELECT id, vprasanje, tip, odgovori FROM vprasanja WHERE aktivno = 1 ORDER BY vrstni_red ASC, id ASC");
$rows = $stmt->fetchAll();

$questions = [];
foreach ($rows as $r) {
    $questions[] = [
        'id'        => (int) $r['id'],
        'vprasanje' => $r['vprasanje'],
        'tip'       => $r['tip'],
        'odgovori'  => $r['odgovori'] ? json_decode($r['odgovori'], true) : null,
    ];
}
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <?php include __DIR__ . '/../includes/header.php'; ?>
</head>
<body>
    <?php include __DIR__ . '/../includes/nav.php'; ?>

    <main class="section" style="padding-top:8.5rem; min-height: 90vh;">
        <div class="container">

            <?php if (empty($questions)): ?>
                <div class="quiz-shell text-center">
                    <p class="mb-0">Trenutno ni na voljo nobenega vprašanja. Prosimo, poskusite kasneje.</p>
                </div>
            <?php else: ?>

            
            <div class="quiz-shell" id="screen-start">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-graduation-cap fa-2x text-bronze mb-3"></i>
                    <h2 class="section-title" style="font-size:1.6rem;">Preveri svoje znanje</h2>
                    <p class="text-muted">Kviz vsebuje <?= count($questions) ?> vprašanj o Michelangelovem Davidu. Za vsak pravilen odgovor takoj izveš rezultat.</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Ime in priimek</label>
                    <input type="text" id="playerName" class="form-control form-control-lg" placeholder="Vpiši svoje ime in priimek..." required>
                </div>
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-bronze btn-lg" id="btnStart">Začni test <i class="fa-solid fa-play ms-1"></i></button>
                </div>
            </div>

            
            <div class="quiz-shell d-none" id="screen-quiz">
                <div class="quiz-topbar">
                    <span id="questionCounter">Vprašanje 1 / <?= count($questions) ?></span>
                    <span class="quiz-timer"><i class="fa-regular fa-clock me-1"></i><span id="timerDisplay">00:00</span></span>
                </div>
                <div class="progress">
                    <div class="progress-bar" id="progressBar" style="width: 0%"></div>
                </div>
                <div class="quiz-question">
                    <h3 id="questionText"></h3>
                    <div id="optionsWrap"></div>
                    <div class="quiz-feedback" id="feedback"></div>
                </div>
                <div class="quiz-nav">
                    <button type="button" class="btn btn-bronze" id="btnNext" disabled>Naprej <i class="fa-solid fa-arrow-right ms-1"></i></button>
                </div>
            </div>

            
            <div class="quiz-shell result-shell d-none" id="screen-result">
                <i class="fa-solid fa-award fa-2x text-bronze mb-2"></i>
                <div class="result-score"><span id="resultPercent">0</span>%</div>
                <div class="result-stars" id="resultStars"></div>
                <div class="result-message" id="resultMessage"></div>
                <p class="text-muted mb-4">Pravilnih odgovorov: <span id="resultScore"></span> / <?= count($questions) ?> &middot; Čas: <span id="resultTime"></span></p>
                <div class="d-flex gap-2 justify-content-center flex-wrap">
                    <button type="button" class="btn btn-bronze" id="btnRetry"><i class="fa-solid fa-rotate-right me-1"></i>Reši ponovno</button>
                    <a href="../gradivo1.php" class="btn btn-outline-secondary">Nazaj na gradivo</a>
                </div>
                <p class="small text-muted mt-4" id="saveStatus"></p>
            </div>

            <?php endif; ?>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <script>
        window.QUIZ_QUESTIONS = <?= json_encode($questions, JSON_UNESCAPED_UNICODE) ?>;
        window.QUIZ_SUBMIT_URL = 'submit.php';
    </script>
    <script src="<?= BASE_URL ?>assets/js/quiz.js"></script>
</body>
</html>
