<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php'; ?>
    <style>

        .flip-card {
            perspective: 1000px;
            margin: 20px; 
            display: flex;
            justify-content: center;
            height: 300px; 
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            font-weight: bold;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .flipped .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front,
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .flip-card-front {
            background: linear-gradient(to bottom, #66ccff 0%, #666699 100%);
            color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .flip-card-back {
            background: linear-gradient(to bottom, #666699 0%, #66ccff 100%);
            color: #000;
            transform: rotateY(180deg);
            display: flex; 
            justify-content: center; 
            align-items: center; 
        }

        .card-body {
            padding: 20px;
        }

    </style>
</head>
<body class="bg-light">
    <?php include 'nav.php'; ?>

    <main class="container my-5">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            
            <div class="col">
                <div class="flip-card" onclick="toggleFlip(this)">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <div class="card-body">
                                <h5 class="card-title">Zakaj je David simbol Firenc?</h5>
                            </div>
                        </div>
                        <div class="flip-card-back">
                            <div class="card-body">
                                <p>Firence so se leta 1494 rešile izpod družine Medici, kar jih je povezalo z Davidom, mladeničem, ki se bori proti Goljatu. David simbolizira pogum in pripravo na spopad, kar je pomembno za identiteto Firenc.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="flip-card" onclick="toggleFlip(this)">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <div class="card-body">
                                <h5 class="card-title">Značilni elementi antike, ki jih najdemo na kipu Davida</h5>
                            </div>
                        </div>
                        <div class="flip-card-back">
                            <div class="card-body">
                                <p>Golota, velikost, drža (kontrapost) in mišičasto telo so značilni za antično kiparstvo. Ti elementi poudarjajo lepoto in moč človeške figure.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="flip-card" onclick="toggleFlip(this)">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <div class="card-body">
                                <h5 class="card-title">Razlika med kipom in bibličnim Davidom</h5>
                            </div>
                        </div>
                        <div class="flip-card-back">
                            <div class="card-body">
                                <p>Kip Davida prikazuje starejšega in močnejšega mladeniča v primerjavi z bibličnim Davidom. Michelangelov David predstavlja idealizirano obliko junaka, medtem ko je David v bibliji navaden pastir.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="flip-card" onclick="toggleFlip(this)">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <div class="card-body">
                                <h5 class="card-title">Pretirano veliki proporci</h5>
                            </div>
                        </div>
                        <div class="flip-card-back">
                            <div class="card-body">
                                <p>Večja glava simbolizira koncentracijo na tarčo, večji roki pa dajeta pozornost na orožje. To izraža miselnost in dejanje, preden David premaga Goljata.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="flip-card" onclick="toggleFlip(this)">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <div class="card-body">
                                <h5 class="card-title">Posebnost Davidove drže</h5>
                            </div>
                        </div>
                        <div class="flip-card-back">
                            <div class="card-body">
                                <p>Davidova desna noga nosi težo, leva pa je pokrčena, kar ustvarja S-krivuljo. Ta drža daje vizualno iluzijo gibanja in namiguje na prihodnjo akcijo.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="flip-card" onclick="toggleFlip(this)">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <div class="card-body">
                                <h5 class="card-title">Razlike med Verrochiovim, Donatellovim in Michelangelovim Davidom</h5>
                            </div>
                        </div>
                        <div class="flip-card-back">
                            <div class="card-body">
                                <p>Donatello in Verrochio prikazujeta Davida po zmagi, medtem ko Michelangelo predstavlja mladeniča pred bitko. Michelangelov David je antični junak, medtem ko sta Donatellov in Verrocchiov David običajna pastirja.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleFlip(card) {
            card.classList.toggle('flipped');
        }
    </script>
    <?php include 'footer.php'; ?>
</body>
</html>






