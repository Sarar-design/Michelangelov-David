<!DOCTYPE html>
<html lang="en">
    <?php include 'header.php'; ?>
<head>
    <style>

        .body {
            background-color: #f8f9fa;

        }
        .test-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 120px); 
            padding: 0 20px;
        }

        .test-content {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
    </style>
</head>
<?php include 'nav.php'; ?>

<body class="bg-light">
    <div class="container-fluid test-container">
        <div class="test-content">
            <h2 class="text-center mb-4">Preveri svoje znanje o Michelangelovem Davidu</h2>

            <form id="quizForm" action="rs.php" method="POST" onsubmit="return validateForm()">

                <div class="mb-4">
                    <h5>Ime in priimek:</h5>
                    <input type="text" name="name" class="form-control" placeholder="Vpiši svoje ime in priimek..." required>
                </div>

                <div class="mb-4">
                    <h5>1. Kje je bil prvotno postavljen kip Davida?</h5>
                    <input type="text" name="question1" class="form-control" placeholder="Vaš odgovor tukaj..." required>
                </div>

                <div class="mb-4">
                    <h5>2. Kateri trenutek iz biblijske zgodbe predstavlja Michelangelov David?</h5>
                    <select name="question2" class="form-select" required>
                        <option value="">Izberite odgovor</option>
                        <option value="Trenutek tik preden zaluča kamen v Goljata.">Trenutek tik preden zaluča kamen v Goljata.</option>
                        <option value="Trenutek, ko zamahne z Goljatovim mečem, da bi ga ubil.">Trenutek, ko zamahne z Goljatovim mečem, da bi ga ubil.</option>
                        <option value="Trenutek ko Goljata premaga in njegova glava leži pri Davidovih nogah.">Trenutek ko Goljata premaga in njegova glava leži pri Davidovih nogah.</option>
                        <option value="Trenutek preden David steče k Goljatu, po tem ko zaluča kamen.">Trenutek preden David steče k Goljatu, po tem ko zaluča kamen.</option>
                    </select>
                </div>
                <div class="mb-4">
                    <h5>3. Ali je bila golota pogost element v renesančni umetnosti?</h5>
                    <div>
                        <input type="radio" id="q3a1" name="question3" value="Da" required>
                        <label for="q3a1">Da</label>
                    </div>
                    <div>
                        <input type="radio" id="q3a2" name="question3" value="Ne" required>
                        <label for="q3a2">Ne</label>
                    </div>
                  </di>
                <div class="mb-4">
                    <h5>4. Kaj je kip Davida predstavljal za Firence? (izberite vse, ki veljajo)</h5>
                    <div>
                        <input type="checkbox" id="q4a1" name="question4[]" value="Moč">
                        <label for="q4a1">Moč</label>
                    </div>
                    <div>
                        <input type="checkbox" id="q4a2" name="question4[]" value="Svoboda">
                        <label for="q4a2">Svoboda</label>
                    </div>
                    <div>
                        <input type="checkbox" id="q4a3" name="question4[]" value="Pogum">
                        <label for="q4a3">Pogum</label>
                    </div>
                    <div>
                        <input type="checkbox" id="q4a4" name="question4[]" value="Varuh">
                        <label for="q4a4">Bil je varuh mesta</label>
                    </div>
                </div>

                <div class="mb-4">
                    <h5>5. Kaj je kontrapost?</h5>
                    <select name="question5" class="form-select" required>
                        <option value="">Izberite odgovor</option>
                        <option value="Je metoda kiparjenja, pri kateri so figure izrezljane s pretiranimi proporci, da bi poudarili čustveno intenzivnost.">Je metoda kiparjenja, pri kateri so figure izrezljane s pretiranimi proporci, da bi poudarilično intenzivnost.</option>
                        <option value="Je kiparski pristop, pri katerem je človeška figura upodobljena v spiralnem zasuku, s čimer se poudarja rotacijsko gibanje in ne naravno ravnovesje telesa.">Je kiparski pristop, pri katerem je človeška figura upodobljena v spiralnem zasuku, sčimer se poudarja rotacijsko gibanje in ne naravno ravnovesje telesa.</option>
                        <option value="Drža skulpture v podobi človeka, ki daje iluzijo, da je telo v gibanju.">Drža skulpture v podobi človeka, ki daje iluzijo, da je telo v gibanju.</option>
                        <option value="Pristop, ki ne vključuje človeških figur.">Pristop, ki ne vključuje človeških figur.</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Potrdi</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateForm() {
            const form = document.getElementById('quizForm');
            const checkboxes = form.querySelectorAll('input[type="checkbox"]');
            const checkedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;

            if (checkedCount === 0) {
                alert('Prosim izberite eno opcijo pri vprašanju 4.');
                return false; 
            }

            return true; 
        }
        
        window.onbeforeunload = function() {
            return 'Ali res želite zapustiti stran?';
        };
    </script>
    <?php include 'footer.php'; ?>
</body>
</html>





