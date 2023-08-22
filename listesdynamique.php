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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Book List</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
}
section{
    width: 100%;
    height: 100vh;
    background-image: url(../image/im2.jpg);
    background-size: cover;
    background-position: center;
}

section nav{
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-around;
    box-shadow: 0 0 10px #ff7200;
    background: #fff;
    position: fixed;
    left: 0;
    z-index: 100;
}

section nav .logo img{
    width: 100px;
    cursor: pointer;
    margin: 8px 0;
}

section nav ul{
    list-style: none;
}

section nav li{
    display: inline-block;
    padding: 0 10px;
}

section nav li a{
    text-decoration: none;
    color: #000;
}

section nav li a:hover{
    color: #ff7200;
}

section nav .social_icon i{
    margin: 0 5px;
    font-size: 18px;
}

section nav .social_icon i:hover{
    color:#ff7200;
    cursor: pointer;
}

section .main{
    display: flex;
    align-items: center;
    justify-content: space-around;
    position: relative;
    top: 10%;
}

section .main h1{
    position: relative;
    font-size: 55px;
    top: 80px;
    left: 25px;
    color: #fff;
}

section .main h1 span{
    color: #ff7200;
}

section .main p{
    width: 650px;
    text-align: justify;
    line-height: 22px;
    position: relative;
    top: 125px;
    left: 25px;
    color: #fff;
}

section .main .main_tag .main_btn{
    background: #ff7200;
    padding: 10px 20px;
    position: relative;
    top: 200px;
    left: 25px;
    color: #fff;
    text-decoration: none;
}

section .main .main_img img{
    width: 780px;
    position: relative;
    top: 90px;
    left: 20px;
}

.featured_boks{
    width: 100%;
    height: 100vh;
    padding: 70px 0;
}

.featured_boks h1{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 30px;
    font-size: 45px;
}

.featured_boks .featured_book_box{
    width: 95%;
    height: 60vh;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
    overflow: hidden;
    overflow-x: scroll;
}

.featured_boks .featured_book_box .featured_book_card{
    width: 250px;
    height: 420px;
    text-align: center;
    padding: 5px;
    border: 1px solid #919191;
    margin: auto 20px;
}

.featured_boks .featured_book_box .featured_book_card:hover{
    box-shadow: 0 0 5px #ff7200;
}

.featured_boks .featured_book_box .featured_book_card .featurde_book_img img{
    width: 150px;
}

.featured_boks .featured_book_box .featured_book_card .featurde_book_tag h2{
    margin: 12px;
}

.featured_boks .featured_book_box .featured_book_card .featurde_book_tag .writer{
    color: #919191;
}

.featured_boks .featured_book_box .featured_book_card .featurde_book_tag .categories{
    color: #ff7200;
    margin-top: 8px;
}

.featured_boks .featured_book_box .featured_book_card .featurde_book_tag .book_price{
    margin-top: 8px;
    font-weight: bold;
    margin-bottom: 15px;
}

.featured_boks .featured_book_box .featured_book_card .featurde_book_tag .book_price sub{
    font-weight: 100;
    padding: 0 5px;
}

.featured_boks .featured_book_box .featured_book_card .featurde_book_tag .f_btn{
    padding: 15px 20px;
    border: 2px solid #ff7200;
    text-decoration: none;
    color: #000;
   
}

::-webkit-scrollbar{
    width: 10px;
    height: 5px;
}

::-webkit-scrollbar-track{
    box-shadow: inset 0 0 8px rgba(0,0,0,0.2);
}

::-webkit-scrollbar-thumb{
    background: #ff7200;
    border-radius: 10px;
}




/*arrivals*/

.arrivals{
    width: 100%;
    height: 100vh;
    margin-bottom: 35px;
}

.arrivals h1{
    font-size: 50px;
    text-align: center;
    margin-bottom: 35px;
}

.arrivals .arrivals_box{
    width: 95%;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    grid-gap: 25px 0;
}

.arrivals .arrivals_box .arrivals_card{
    width: 250px;
    height: 340px;
    text-align: center;
    padding: 5px;
    border: 1px solid #919191;
    margin: auto 20px;
}

.arrivals .arrivals_box .arrivals_card:hover{
    box-shadow: 0 0 5px #ff7200;
}

.arrivals .arrivals_box .arrivals_card .arrivals_image{
    width: 150px;
    height: 220px;
    margin: 0 auto;
    cursor: pointer;
    box-shadow: 0 0 8px rgba(0,0,0,0.5);
    overflow: hidden;
}

.arrivals .arrivals_box .arrivals_card .arrivals_image img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: 0.3s;
}

.arrivals .arrivals_box .arrivals_card:hover .arrivals_image img{
    transform: scale(1.1);
}

.arrivals .arrivals_box .arrivals_card .arrivals_tag p{
    font-family: queen of camelot;
    font-size: 20px;
    margin: 8px 0;
}

.arrivals .arrivals_box .arrivals_card .arrivals_tag .arrivals_icon{
    color: #ff7200;
    margin-bottom: 18px;
}

.arrivals .arrivals_box .arrivals_card .arrivals_tag .arrivals_btn{
    padding: 8px 20px;
    border: 2px solid #ff7200;
    text-decoration: none;
    color: #000;
}




/*reviews*/

.reviews{
    width: 100%;
    height: auto;
}

.reviews h1{
    text-align: center;
    font-size: 50px;
    margin-top: 55px;
}

.reviews .review_box{
    width: 95%;
    height: 50vh;
    margin: 15px auto;
    display: flex;
    align-items: center;
    justify-content: center;
}

.reviews .review_box .review_card{
    width: 400px;
    height: 320px;
    box-shadow: 0 0 8px #ff7200;
    padding: 15px;
    margin: 0 12px;
}

.reviews .review_box .review_card i{
    float: right;
    font-size: 120px;
    position: relative;
    bottom: 20px;
    color: #eaeaea;
}

.reviews .review_box .review_card .card_top img{
    width: 80px;
    border-radius: 50%;
    margin-bottom: 10px;
}

.reviews .review_box .review_card .card p{
    margin: 10px 0 10px 0;
    text-align: justify;
    line-height: 22px;
}

.reviews .review_box .review_card .card .review_icon i{
    font-size: 16px;
    float: left;
    margin-top: 20px;
    color: #ff7200;
    padding: 0 1px;
}

    </style>

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
    <a href="bookpage.php">
<ion-icon name="logo-google"></ion-icon>
</a>

        
    </div>

</nav>
<br/><br/><br/>
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "bib_bd";

    $conn = new mysqli($servername, $username, $password_db, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>

    <!-- Header and other content here -->

    <!-- Books section -->
<div class="arrivals">
    <h1>Our books</h1>
    <div class="arrivals_box">
        <?php
        $sqlBooks = "SELECT * FROM livres";
        $resultBooks = $conn->query($sqlBooks);

        if ($resultBooks->num_rows > 0) {
            while ($row = $resultBooks->fetch_assoc()) {
                ?>
                <div class="arrivals_card">
                    <div class="arrivals_image">
                        <!-- Display base64-encoded image -->
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" alt="Book Cover">
                    </div>
                    <div class="arrivals_tag">
                        <p><?php echo $row['nom']; ?></p>
                        <!-- Add other book details here -->
                        <div class="arrivals_icon">
                            <!-- Add star icons or rating logic here -->
                        </div>
                        <a href="book_details.php?id=<?php echo $row['ID_Livre']; ?>" class="arrivals_btn">Learn More</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No books available.</p>";
        }
        ?>
    </div>
</div>


    <!-- Footer and other content here -->

    <?php
    // Close the database connection
    $conn->close();
    ?>

    <!-- Include your JavaScript scripts here -->
</body>
</html>
