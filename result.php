

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = ($_POST['question1']);
        $question1 = ($_POST['question1']);
        $question2 = ($_POST['question2']);
        $question3 = ($_POST['question3']);
        $question4 = ($_POST['question4']);
        $question5 = ($_POST['question5']);

        echo "<p><strong>Ime in priimek:</strong> $name</p>";
        echo "<p><strong>1. Kje je bil prvotno postavljen kip Davida?</strong> $question1</p>";
        echo "<p><strong>2. Kateri trenutek iz biblijske zgodbe predstavlja Michelangelov David?</strong> $question2</p>";
        echo "<p><strong>3. Ali je bila golota pogost element v renesančni umetnosti?</strong> $question3</p>";
        echo "<p><strong>4. Kaj je kip Davida predstavljal za Firence?</strong> ";
        echo implode(", ", $question4);
        echo "</p>";
        echo "<p><strong>5. Kaj je kontrapost?</strong> $question5</p>";
    } 
    ?>

    
