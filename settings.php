<?php
session_start();

// Check if the user is an admin with the authorized email domain
if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
    $authorizedEmailDomain = "etu.uae.ac.ma";
    $userEmail = $_SESSION['user']['Email'];
    $isAuthorizedAdmin = strpos($userEmail, $authorizedEmailDomain) !== false;

    if ($isAuthorizedAdmin) {
        // Admin is authorized, continue showing the page content
    } else {
        // Admin is not authorized, redirect or show a message
        echo "Cette page n'est pas destinée à vous.";
        exit();
    }
} else {
    // User is not logged in or not an admin, redirect to sign-in page
    header("Location: notyours.html");
    exit();
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
    </head>
<body>
    <section class="main">

        <nav>

            <div class="logo">
                <img src="image/logo.png">
            </div>

            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="bookpage.php">Books</a></li>
                <li><a href="reglement.html">Règles</a></li>
                <li><a href="myaccount.php">My account</a></li>
                <li><a href="settings.php">Setting</a></li>
                <li><a href="signin.php">Se déconnecter <i class='fas fa-sign-out-alt'></i> </li>
                <li><a href="#"></a></li>
            </ul>

            <div class="social_icon">
                <i class="fa-solid fa-magnifying-glass"></i>
                
            </div>

        </nav>
        <div class="container-form">
        <div class="form">
            <h2>Bienvenu Admin  </h2>
            <div class="box-regles">
            <h3>Gestion des livres </h3>
            <button class="btnn" id="ajouterbtn">Ajouter des livres </button>
            <button class="btnn" id="btn2fois">Modifier / Supprimer  </button>
            </div>

            <div class="box-regles">
                <h3>Gestion des abonnées </h3><br/>
                
                <button class="btnn" id="supprimerbtn1">Modifier / Supprimer  </button>
            </div>

            <div class="box-regles">
                <h3>Gestion des demandes </h3><br/>
                <button class="btnn" id="empruntbtn">Demande d'emprunts </button>
                
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