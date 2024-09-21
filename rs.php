<?php
include 'db2.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $name = $_POST['name'];
    $question1 = isset($_POST['question1']) ? $_POST['question1'] : null;
    $question2 = isset($_POST['question2']) ? $_POST['question2'] : null;
    $question3 = isset($_POST['question3']) ? $_POST['question3'] : null;
    $question4 = isset($_POST['question4']) ? implode(", ", $_POST['question4']) : null;
    $question5 = isset($_POST['question5']) ? $_POST['question5'] : null;


    $sql = "INSERT INTO quiz_submissions (name, question1, question2, question3, question4, question5) 
            VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {


        mysqli_stmt_bind_param($stmt, 'ssssss', $name, $question1, $question2, $question3, $question4, $question5);

        if (mysqli_stmt_execute($stmt)) {
            echo "<p>Podatki so se uspešno shranili v bazo.</p>";
        } else {
            echo "<p>Napaka: neuspešno shranjevanje podatkov. " . mysqli_error($conn) . "</p>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Napaka: Pripravljanje stavka sql neuspešno." . mysqli_error($conn) . "</p>";
    }
    
    mysqli_close($conn);

} else {
    echo "<p>Napaka: Napaka pri obdelavi obrazca.</p>";
}
?>




