<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json; charset=utf-8');

$input = json_decode(file_get_contents('php://input'), true);

$ime = trim((string) ($input['ime'] ?? ''));
$odgovori = is_array($input['odgovori'] ?? null) ? $input['odgovori'] : [];
$cas = isset($input['cas_sekund']) ? (int) $input['cas_sekund'] : null;

if ($ime === '' || empty($odgovori)) {
    http_response_code(400);
    echo json_encode(['error' => 'Manjkajo podatki (ime ali odgovori).']);
    exit;
}


$stmt = $pdo->query("SELECT id, tip, pravilni_odgovor FROM vprasanja WHERE aktivno = 1");
$vprasanja = [];
foreach ($stmt->fetchAll() as $row) {
    $vprasanja[$row['id']] = $row;
}

$skupaj = count($vprasanja);
$tocke = 0;

foreach ($odgovori as $o) {
    $id = isset($o['id']) ? (int) $o['id'] : 0;
    $answer = $o['answer'] ?? null;

    if (!isset($vprasanja[$id])) {
        continue;
    }

    $q = $vprasanja[$id];
    $correct = json_decode($q['pravilni_odgovor'], true);

    if ($q['tip'] === 'checkbox') {
        $userArr = is_array($answer) ? $answer : [];
        sort($userArr);
        $correctArr = is_array($correct) ? $correct : [];
        sort($correctArr);
        if ($userArr == $correctArr && count($userArr) > 0) {
            $tocke++;
        }
    } else {
        if (is_string($answer) && trim(mb_strtolower($answer)) === trim(mb_strtolower((string) $correct))) {
            $tocke++;
        }
    }
}

$odstotek = $skupaj > 0 ? round(($tocke / $skupaj) * 100, 2) : 0;

$sql = "INSERT INTO quiz_rezultati (ime, tocke, skupaj, odstotek, cas_sekund, odgovori_json)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $ime,
    $tocke,
    $skupaj,
    $odstotek,
    $cas,
    json_encode($odgovori, JSON_UNESCAPED_UNICODE),
]);

echo json_encode([
    'tocke'    => $tocke,
    'skupaj'   => $skupaj,
    'odstotek' => $odstotek,
]);
