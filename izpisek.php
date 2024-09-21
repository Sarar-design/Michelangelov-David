
<?php

include 'db2.php';

$sql = "SELECT * FROM quiz_submissions ORDER BY time DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izpolnjeni testi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .table-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            overflow-x: auto;
        }
        .table {
            table-layout: auto;
            width: 100%;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
            max-width: 200px; 
        }
        .table th {
            position: sticky;
            top: 0;
            background-color: #6c757d !important; 
            color: white;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h1 class="text-center mb-4">Vsi izpolnjeni testi</h1>
        
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ime</th>
                        <th>Vprašanje 1</th>
                        <th>Vprašanje 2</th>
                        <th>Vprašanje 3</th>
                        <th>Vprašanje 4</th>
                        <th>Vprašanje 5</th>
                        <th>Čas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['question1'] . "</td>";
                            echo "<td>" . $row['question2'] . "</td>";
                            echo "<td>" . $row['question3'] . "</td>";
                            echo "<td>" . $row['question4'] . "</td>";
                            echo "<td>" . $row['question5'] . "</td>";
                            echo "<td>" . $row['time'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>Ni podatkov.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>

