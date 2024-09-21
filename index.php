<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php'; ?>
   
    <style>
        body {
            background-image: url('bg.jpeg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .container-box {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 15px;
            padding: 30px;
            max-width: 600px;
            margin: 200px auto;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card container-box">
            <div class="card-body">
                <h2 class="card-title">Dobrodošli na spletni učilnici o Michelangelovem Davidu</h2>
                <p class="card-text">Raziskuj o Michelangelovem znamenitem kipu, poduči se o zanimivosti te umetnine in svoje znanje preveri s testom.</p>
                <a href="gradivo1.php" class="btn btn-primary">Prični z učenjem</a>
            </div>
        </div>
    </div>

    </script>
    <?php include 'footer.php'; ?>
</body>
</html>



