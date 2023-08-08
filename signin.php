<?php
session_start();
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $servername = "localhost";
        $username = "root";
        $password_db = "";
        $dbname = "bib_bd";

        $conn = new mysqli($servername, $username, $password_db, $dbname);
        if ($conn->connect_error) {
            die("La connexion à la base de données a échoué : " . $conn->connect_error);
        }

        // Check in the admin table
        $sqlAdmin = "SELECT * FROM admin WHERE Email = '$email' AND Password = '$password'";
        $resultAdmin = $conn->query($sqlAdmin);

        if ($resultAdmin->num_rows > 0) {
            $_SESSION['isAdmin'] = true;
            $_SESSION['user'] = $resultAdmin->fetch_assoc(); // Store admin data in user session
            header("Location:home.php");
            exit();
        }

        // Check in the membres table
        $sqlMembres = "SELECT * FROM membres WHERE Email = '$email' AND Password = '$password'";
        $resultMembres = $conn->query($sqlMembres);

        if ($resultMembres->num_rows > 0) {
            $_SESSION['isAdmin'] = false;
            $_SESSION['user'] = $resultMembres->fetch_assoc(); // Store member data in user session
            header("Location:home.php");
            exit();
        }

        $message = "Mot de passe ou email incorrect.";
        $conn->close();
    } else {
        $message = "Veuillez remplir tous les champs du formulaire.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign in</title>
    <link rel="stylesheet" href="css/signinstyle.css">
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">SQLI</h2>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">ABOUT</a></li>
                    <li><a href="#">CONTACT</a></li>
                </ul>
            </div>

        </div> 
        <div class="content">
            <h1>Site Web Du <br><span>Bibliothèque</span> <br> SQLI</h1>
            <p class="par">Notre Bibliothèque sert à ménager nos livres pour avoir la pation de les lires </p>

                <button class="cn"><a href="#">JOIN US</a></button>

                <div class="form">
                    <form method="POST">
                    <h2>Login Here</h2>
                    <input type="email" name="email" placeholder="Enter Email Here"><br/>
                    <input type="password" name="password" placeholder="Enter Password Here"><br/>
                    <input type="checkbox" id="register-check">
                    <label for="register-check"> Remember me</label>
                    <button class="btnn" type="submit" id="btn-create2">Login</button>

                    <?php if (!empty($message)) { ?>
        <div class="error-message">
            <?php echo $message; ?>
        </div>
    <?php } ?>

                    <p class="link">Don't have an account<br>
                    <a href="signup.php" class="sign1">Sign up </a></p>
                    <p class="liw">Log in with</p>

                    <div class="icons">
                        
                        <a href="https://www.google.com/" target="_blank"><ion-icon name="logo-google"></ion-icon></a>
                        <a href="https://www.facebook.com/login/" target="_blank"><ion-icon name="logo-facebook"></ion-icon></a>
                        <a href="https://www.instagram.com/" target="_blank"><ion-icon name="logo-instagram"></ion-icon></a>
                        <a href="https://www.twitter.com/" target="_blank"><ion-icon name="logo-twitter"></ion-icon></a>
                        </div>

</div>
    </div>
    </form>
    
</div>
</div>
</div>
</body>
</html>


