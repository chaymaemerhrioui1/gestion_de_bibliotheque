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
        <title>reglement</title>
        <link rel="stylesheet" href="css/reglement.css">
        
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
        <div class="form">
            <h2>Our regles ! </h2>
            <div class="box-regles">
                <p>Regles de pret</p><br/>
                <ul>
                    <li>Tout adhérent a le droit d’emprunter 1 à 10 emprunts  des collections de la Bibliothèque pendant 8 jours ouvrables en plus d’un document de la Section romans .</li>
                    <li>La bibliothèque se réserve le droit d’exclure certains documents du prêt.</li>
                    <li>Tout retard sera sanctionné par une amende (3dh/jour).</li>
                    <li>Tout document perdu ou abimé devra être remplacé ou remboursé.</li>
                </ul>
        
                <br/><p>Modalité de prêt</p>
                <ul>
                    <li>Pour toute opération de prêt, les étudiants de l’Université Hassan II de Casablanca sont tenus de déposer leur carte de d’étudiant au guichet de prêt.</li>
                    <li>La carte sera récupérée une fois le livre rendu.</li>
                </ul>
                <br/><p>Compte lecteur</p>
                <ul>
                    <li>Pour connaître la situation des prêts en cours, retards, amendes, faire des propositions d’achat, etc., la bibliothèque met à la disposition des adhérents un compte lecteur accessible sur la page d’accueil du catalogue de la bibliothèque.</li>
                </ul>
                <br/><p>Compte lecteur</p>
            <ul>
              <li>Pour connaître la situation des prêts en cours, retards, amendes, faire des propositions d’achat, etc., la bibliothèque met à la disposition des adhérents un compte lecteur accessible sur la page d’accueil du catalogue de la bibliothèque.</li>
            </ul>
        </div>
        </div>
        </div>
    </section>







    





</body>
</html>