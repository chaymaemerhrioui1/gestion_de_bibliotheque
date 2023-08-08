<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'ajout de photo</title>
    <link rel="stylesheet" href="css/bookpage.css">
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


    <div class="container">
        <h2><u>Rechercher un livre</u></h2>
        <form action="search_book.php" method="POST" enctype="multipart/form-data">
            <label for="isbn"> ISBN du livre :</label>
            <input type="text" id="isbn" name="isbn" >

            <label for="nom">Titre de livre :</label>
            <input type="text" id="nom" name="nom" >
            <label for="auteur">Auteur :</label>
            <input type="text" id="auteur" name="auteur" >

            <label for="description">Description  :</label>
            <input type="text" id="description" name="description" >


            <label for="ID_Categorie">Genre :</label>
            <select id="ID_Categorie" name="ID_Categorie">
                
                <option value="science">Science</option>
                <option value="romance">Romance</option>
                <option value="mystere">Mystère</option>
                
            </select>

            <button class="btnn" id="rechercherbtn">Rechercher </button>
            

        </form>
    </div>
</body>
</html>
