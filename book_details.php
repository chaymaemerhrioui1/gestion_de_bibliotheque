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

// Get the book ID from the URL parameter
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Retrieve book details from the database
    $sqlBook = "SELECT * FROM livres WHERE ID_Livre = $bookId";
    $resultBook = $conn->query($sqlBook);

    if ($resultBook->num_rows > 0) {
        $bookDetails = $resultBook->fetch_assoc();
    } else {
        $bookDetails = null;
    }
} else {
    $bookDetails = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Book List</title>
    <style>
        .book-details {
            display: flex;
            align-items: center;
            margin: 20px;
        }

        .book-details-image {
            margin-top:150px;
            margin left: 100px;
        }

        .book-details-info {
            margin-left:60px;
        }

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

        
    </style>
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
        <li><a href="reglement.html">Règles</a></li>
        
        <li><a href="myaccount.php">My account</a></li>
        <?php if (isset($_SESSION['isSpecialUser']) && $_SESSION['isSpecialUser']) { ?>
        <li><a href="settings.php">Settings</a></li>
        <?php } ?>
        <li><a href="signin.php">Se déconnecter <i class='fas fa-sign-out-alt'></i> </li>
            <li><a href="#"></a></li>
    </ul>

    <div class="social_icon">
    <a href="bookpage.php">
<ion-icon name="logo-google"></ion-icon>
</a>

        
    </div>

</nav><br/><br/><br/>


<?php if ($bookDetails) { ?>
    <div class="book-details">
        <div class="book-details-image">
            <!-- Display base64-encoded image -->
            <img src="data:image/jpeg;base64,<?php echo base64_encode($bookDetails['image']); ?>" alt="Book Cover" style="width: 250px; height: 300px;">

        </div>
        <div class="book-details-info">
            <h1><?php echo $bookDetails['nom']; ?></h1>
            <p><strong>Author:</strong> <?php echo $bookDetails['auteur']; ?></p>
            <p><strong>ISBN:</strong> <?php echo $bookDetails['ISBN']; ?></p>
            <p><strong>Category:</strong> <?php echo $bookDetails['ID_Categorie']; ?></p>
            <p><strong>Description:</strong> <?php echo $bookDetails['description']; ?></p>
            

            
        </div>
    </div>
<?php } else { ?>
    <p>Book details not available.</p>
<?php } ?>


    <?php
    // Close the database connection
    $conn->close();
    ?>

    <!-- Include your JavaScript scripts here -->
</body>
</html>
