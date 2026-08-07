<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json; charset=utf-8');

$input = json_decode(file_get_contents('php://input'), true);
$id = isset($input['id']) ? (int) $input['id'] : 0;
$answer = $input['answer'] ?? null;

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Neveljaven ID vprašanja.']);
    exit;
}

$stmt = $pdo->prepare("SELECT tip, pravilni_odgovor FROM vprasanja WHERE id = ? AND aktivno = 1");
$stmt->execute([$id]);
$row = $stmt->fetch();

if (!$row) {
    http_response_code(404);
    echo json_encode(['error' => 'Vprašanje ne obstaja.']);
    exit;
}

$correct = json_decode($row['pravilni_odgovor'], true);
$isCorrect = false;

if ($row['tip'] === 'checkbox') {
    $userArr = is_array($answer) ? $answer : [];
    sort($userArr);
    $correctArr = is_array($correct) ? $correct : [];
    sort($correctArr);
    $isCorrect = ($userArr == $correctArr) && count($userArr) > 0;
} else {
    $isCorrect = is_string($answer) && trim(mb_strtolower($answer)) === trim(mb_strtolower((string) $correct));
}

echo json_encode([
    'correct'       => $isCorrect,
    'correctAnswer' => $correct,
]);
