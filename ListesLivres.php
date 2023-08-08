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

// Vérifier si l'ISBN du livre à modifier est passé en paramètre dans l'URL
if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    
    // Vérifier si un livre a été sélectionné pour la modification
    if (isset($_GET['ID_Livre'])) {
        $ID_Livre = $_GET['ID_Livre'];
    
        // Vérifier si le formulaire de modification a été soumis
        if (isset($_POST['modifier'])) {
            // Récupérer les données du formulaire de modification
            $nom = $_POST['nom'];
            $auteur = $_POST['auteur'];
            $genre = $_POST['genre'];
            $description = $_POST['description'];
            // Récupérer le fichier image téléchargé (s'il a été fourni)
        if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['photo']['tmp_name'];
            $imageData = file_get_contents($image);
        } else {
            // Si aucun nouveau fichier n'a été fourni, garder l'image existante
            $imageData = $livre['image'];
        }
    // Mettre à jour les données du livre (y compris l'image) dans la base de données
    $sql = "UPDATE livres SET nom = ?, auteur = ?, ID_Categorie = ?, description = ?, image = ? WHERE ID_Livre = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $auteur, $genre, $description, $imageData, $ID_Livre]);

    // Rediriger l'utilisateur vers la page actuelle pour actualiser les données
    header("Location: modifierpage.php?ID_Livre=$ID_Livre");
    exit();
}

// Check if the HTTP request method is POST (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the "supprimer" parameter exists in the POST data
    if (isset($_POST['supprimer']) && isset($_POST['ID_Livre'])) {
        // Execute the DELETE query to remove the book from the database
        $sql = "DELETE FROM livres WHERE ID_Livre = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['ID_Livre']]);
        
        // Redirect the user back to the page to refresh the list of books
        header("Location: modifierpage.php");
        exit();
    }
}

    
        // Récupérer les informations du livre sélectionné depuis la base de données
        $sql = "SELECT * FROM livres WHERE ID_Livre = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$ID_Livre]);
        $livre = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Vérifier si le livre existe dans la base de données
        if (!$livre) {
            echo "Livre non trouvé dans la base de données.";
            exit();
        }
    }}
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listes des livres</title>
    <link rel="stylesheet" href="css/ajouterpage.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

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
                
            </ul>

            <div class="social_icon">
                <i class="fa-solid fa-magnifying-glass"></i>
                
            </div>

        </nav>


    <div class="container">
    <h2><u>Liste des livres</u></h2>
        <table class="table table-sm">
            <tr>
                <th>ISBN</th>
                <th>Nom</th>
                <th>Auteur</th>
                <th>Genre</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT l.*, c.nom_categorie FROM livres l
        LEFT JOIN categories c ON l.ID_Categorie = c.ID_Categorie";
$stmt = $pdo->query($sql);
$livres = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
            // $sql = "SELECT * FROM livres";
            // $stmt = $pdo->query($sql);
            // $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($livres as $livre){
                    echo "<tr>";
                    echo "<td>" . $livre['ISBN'] . "</td>";
                    echo "<td>" . $livre['nom'] . "</td>";
                    echo "<td>" . $livre['auteur'] . "</td>";
                    echo "<td>" . $livre['nom_categorie'] . "</td>";
                    echo "<td>" . $livre['description'] . "</td>";
                     // Afficher l'image si elle existe
    if ($livre['image']) {
        echo "<td><img src='data:image/jpeg;base64," . base64_encode($livre['image']) . "' width='100' height='100'></td>";
    } else {
        // Si aucune image n'est disponible, afficher un message ou une image par défaut
        echo "<td>Aucune image</td>";
        // Exemple avec une image par défaut: echo "<td><img src='chemin/vers/image_par_defaut.jpg' width='100' height='100'></td>";
    }


                    
                    echo "<td><a class='btn btn-warning' href='suppLivre.php?ID_Livre=" . $livre['ID_Livre'] . "'>Supprimer</a>  <a class='bbb btn btn-success' href='modifierpage.php?ID_Livre=" . $livre['ID_Livre'] . "'>Modifier</a></td>";
                    echo "</tr>";
}
                ?>

        </table> 
    </div>
</body>
</html>



























    