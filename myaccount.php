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

// Établir la connexion à la base de données (comme dans les autres fichiers)
$host = "localhost";
$dbName = "bib_bd";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}

// Vérifier si le formulaire de modification a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newNom = $_POST['newNom'];
    $newPrenom = $_POST['newPrenom'];
    $newEmail = $_POST['newEmail'];
    $newPassword = $_POST['newPassword'];
    $oldPassword = $_POST['oldPassword'];

    // Mettre à jour les informations de l'utilisateur dans la base de données
    $sql = "UPDATE membres SET Nom = ?, Prénom = ?, Email = ?, Password = ? WHERE ID_Membre = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$newNom, $newPrenom, $newEmail, $newPassword, $user['ID_Membre']]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="css/bookpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
    body {
            font-family: Arial, sans-serif;
            background-image: url(image/im1.jpg);
            margin: 0;
            padding: 0;
        }

    .account-info {
        text-align: center;
        background: white;
        padding: 50px;
        border-radius: 10px;
    }

    .account-info h1 {
        font-size: 2em;
        margin-bottom: 20px;
    }

    .account-info p {
        font-size: 1.2em;
        margin: 10px 0;
    }

    .account-info a {
        color: black;
        text-decoration: none;
    }
    .account-info img {
        width: 150px; 
        border-radius: 50%; 
        margin-bottom: 20px;
    }
    #updateButton {
    width: 350px;
    height: 40px;
    background: #ff7200;
    border: none;
    margin-top: 30px;
    margin-left: 500px;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color: #fff;
    transition: 0.4s ease;
}


    
</style>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>


</head>
<body>
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
<a href="bookpage.php"><i class="fa-solid fa-magnifying-glass"></i></a>
    
</div>

</nav>
<div class="account-info"><br/><br/><br/><br/>
    <h1>Bienvenue dans votre Compte</h1>
    <img src="image/usergirl.png" alt="User Photo">
    <?php
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        echo "<p>Nom : " . $user['Nom'] . "</p>";
        echo "<p>Prénom : " . $user['Prénom'] . "</p>";
        echo "<p>Email : " . $user['Email'] . "</p>";
        echo "<p>Password : ******</p>"; // Pour des raisons de sécurité, n'affichez pas le mot de passe ici
        echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/>";
        echo "<h4>Voulez vous modifier vos informations personnelles : 👇👇</h4>";
        // Formulaire pour mettre à jour les informations
        echo "<form id='updateForm'>";
        echo "<input type='hidden' name='userID' value='" . $user['ID_Membre'] . "'>";
        echo "<p>Nouveau Nom : <input type='text' name='newNom'></p>";
        echo "<p>Nouveau Prénom : <input type='text' name='newPrenom'></p>";
        echo "<p>Nouvel Email : <input type='text' name='newEmail'></p>";
        echo "<p>Ancien Password : <input type='password' name='oldPassword'></p>";
        echo "<p>Nouveau Password : <input type='password' name='newPassword'></p>";
        echo "<button type='button' id='updateButton'>Mettre à jour</button>";
        echo "</form>";
    } else {
        echo "<p>User not logged in.</p>";
    }
    ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const updateButton = document.getElementById("updateButton");
    updateButton.addEventListener("click", function() {
        const form = document.getElementById("updateForm");
        const formData = new FormData(form);

        // Utilisation de la requête AJAX pour mettre à jour les informations
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "update_user_info.php");
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert("Informations mises à jour avec succès !");

                // Mise à jour des informations affichées sur la page
                const updatedNom = formData.get("newNom");
                const updatedPrenom = formData.get("newPrenom");
                const updatedEmail = formData.get("newEmail");

                const nomElement = document.querySelector(".account-info p:nth-of-type(1)");
                const prenomElement = document.querySelector(".account-info p:nth-of-type(2)");
                const emailElement = document.querySelector(".account-info p:nth-of-type(3)");

                if (updatedNom) {
                    nomElement.textContent = "Nom : " + updatedNom;
                }
                if (updatedPrenom) {
                    prenomElement.textContent = "Prénom : " + updatedPrenom;
                }
                if (updatedEmail) {
                    emailElement.textContent = "Email : " + updatedEmail;
                }
            } else {
                alert("Erreur lors de la mise à jour des informations.");
            }
        };
        xhr.send(formData);
    });
});
</script>





        
        
    </div>
</body>
</html>
