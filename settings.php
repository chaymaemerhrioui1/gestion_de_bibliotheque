<?php
session_start();

// Vérifier si l'utilisateur est connecté en vérifiant la session
if (!isset($_SESSION['user'])) {
    header("Location: signin.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

$user = $_SESSION['user']; // Récupérer les informations de l'utilisateur depuis la session

// Vérifier si l'utilisateur est un super utilisateur
$isSuperUser = false;
if (isset($user['Email']) && strpos($user['Email'], '@etu.uae.ac.ma') !== false) {
    $isSuperUser = true;
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Store Website</title>
        <link rel="stylesheet" href="css/settings.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    // Function to prevent going back
    function disableBack() {
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function () {
            window.history.pushState(null, "", window.location.href);
        };
    }

    // Call the function when the document is ready
    document.addEventListener("DOMContentLoaded", function() {
        disableBack();
    });
</script>
    </head>
<body>
    <section class="main">

        <nav>

            <div class="logo">
                <img src="image/logo.png">
            </div>

            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="listesdynamique.php">Livres</a></li>
                <li><a href="reglement.php">Règles</a></li>
                <li><a href="myaccount.php">My account</a></li>
                
                <?php if ($isSuperUser) { ?>
        <li><a href="settings.php">Settings</a></li>
        <?php } ?>
                <li><a href="signout.php">Se déconnecter <i class='fas fa-sign-out-alt'></i> </li>
                <li><a href="#"></a></li>
            </ul>

            <div class="social_icon">
        

            <a href="bookpage.php"> <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </div>

        </nav>
        <div class="container-form">
        <div class="form"><br/><br/>
            <h2>Bienvenu Admin  </h2><br/><br/><br/>
            <div class="box-regles2">
            <h3>Gestion des livres </h3>
            <button class="btnn" id="ajouterbtn">Ajouter des livres </button>
            <button class="btnn" id="btn2fois">Modifier / Supprimer  </button>
            </div><br/><br/>

            <div class="box-regles1">
                <h3>Gestion des abonnées </h3><br/>
                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btnn" id="supprimerbtn1">Modifier / Supprimer  </button>
            </div>

        </div>
        </div>
    </section>


    <script>
        document.getElementById("ajouterbtn").addEventListener("click", function() {
            window.location.href = "ajouterpage.php";
        });
        document.getElementById("btn2fois").addEventListener("click", function() {
            window.location.href = "ListesLivres.php";
        });

    
        document.getElementById("supprimerbtn1").addEventListener("click", function() {
            window.location.href = "ListerMembre.php";
        });
        

        document.getElementById("empruntbtn").addEventListener("click", function() {
            window.location.href = "home.html";
        });
    </script>

    
</body>
</html>