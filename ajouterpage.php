<?php
// Établir la connexion à la base de données
$host = "localhost";
$dbName = "bib_bd";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    // Afficher les erreurs SQL pour le débogage, à supprimer en production
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}

// Vérifier si des données ont été soumises
// ... (le code de connexion à la base de données reste inchangé)

if (isset($_POST['isbn'], $_POST['nom'], $_POST['auteur'], $_POST['genre'], $_POST['description'])) {
    // Récupérer les données du formulaire
    $isbn = $_POST['isbn'];
    $nom = $_POST['nom'];
    $auteur = $_POST['auteur'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    // Récupérer le fichier image téléchargé
    if (isset($_FILES['photo']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
        // Récupérer le fichier image téléchargé
        $image = $_FILES['photo']['tmp_name'];
        // Lire le contenu du fichier image en tant que BLOB
        $imageData = file_get_contents($image);
    } else {
        // Aucune image téléchargée, définir le contenu par défaut ou gérer comme vous le souhaitez
        $imageData = file_get_contents("image/nobook.jpeg");
    }

    // Insérer les données dans la table de la base de données
    $sql = "INSERT INTO livres (nom, auteur,ISBN, ID_Categorie, description, image) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ $nom, $auteur, $isbn, $genre, $description,  $imageData]);

    // Vérifier si l'insertion s'est effectuée avec succès
    if ($stmt->rowCount() > 0) {
        // Rediriger l'utilisateur vers une autre page après l'ajout réussi
        header("Location: settings.html");
        exit();
    } else {
        echo "Erreur lors de l'ajout du livre à la base de données.";
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'ajout de photo</title>
    <link rel="stylesheet" href="css/ajouterpage.css">
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
        <h2><u>Ajouter un livre</u></h2>
        <form  method="POST" enctype="multipart/form-data">
            
            <label for="isbn">ISBN de livre :</label>
            <input type="text" id="isbn" name="isbn" required>
            <label for="nom">Nom de livre :</label>
            <input type="text" id="nom" name="nom" required>
            <label for="auteur">Auteur :</label>
            <input type="text" id="auteur" name="auteur" required>
            <label for="genre">Genre :</label>
            <select id="genre" name="genre">
                <option value="1">Science</option>
                <option value="2">Romance</option>
                <option value="3">Mystère</option>
                
            </select>
            <label for="description">Description :</label>
            <textarea id="description" name="description" rows="4" required></textarea>
            <label for="photo">Image :</label>
            <input type="file" id="photo" name="photo" accept="image/*" >
            <input type="submit" value="Ajouter">
        </form>
    </div>
</body>
</html>
