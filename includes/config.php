<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$script = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$subfolders = ['admin', 'quiz', 'gallery'];
$folderName = basename($script);
if (in_array($folderName, $subfolders, true)) {
    $base = rtrim(dirname($script), '/');
} else {
    $base = rtrim($script, '/');
}

define('BASE_URL', $base === '' || $base === '.' ? '/' : $base . '/');
