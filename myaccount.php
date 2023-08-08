<?php
session_start();

// Vérifier si l'utilisateur est connecté en vérifiant la session
if (!isset($_SESSION['user'])) {
    header("Location: signin.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

$user = $_SESSION['user']; // Récupérer les informations de l'utilisateur depuis la session
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
        width: 150px; /* Adjust the size of the image as needed */
        border-radius: 50%; /* Rounded border for circular image */
        margin-bottom: 20px;
    }
    
</style>

</head>
<body>
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
    
    
</ul>

<div class="social_icon">
    <i class="fa-solid fa-magnifying-glass"></i>
    
</div>

</nav>
<div class="account-info">
        <h1>Welcome to Your Account</h1>
        <img src="image/usergirl.png" alt="User Photo">
        <?php
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            echo "<p>Nom : " . $user['Nom'] . "</p>";
            echo "<p>Prénom : " . $user['Prénom'] . "</p>";
            echo "<p>Email : " . $user['Email'] . "</p>";
        } else {
            echo "<p>User not logged in.</p>";
        }
        ?>
        
        
    </div>
</body>
</html>
