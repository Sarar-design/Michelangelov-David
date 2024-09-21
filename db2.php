<?php
$host = 'localhost:3308'; 
$dbname = 'michelangelo_quiz';
$username = 'root';
$password = '';

$conn = mysqli_connect($host, $username, $password, $dbname);


if (!$conn) {
    die("Povezava z MySQL je bila neuspešna! Error: " . mysqli_connect_error());
} 

?>
