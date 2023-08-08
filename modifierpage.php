<?php
session_start();
// Reste du code...
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
<?php

// Connexion à la base de données et récupération des données à modifier
$servername="localhost";
$user="root";
$pass="";
$dbname="bib_bd";

$connexion=new PDO ("mysql:host=$servername;dbname=$dbname", $user, $pass);

// Vérifier la connexion
if (!$connexion) {
    die();
}


// Récupérer les données des personnes dans la base de données
$ID_Livre = $_GET['ID_Livre'];
$resultat = $connexion->prepare('SELECT * FROM livres WHERE ID_Livre = :ID_Livre');
$resultat->bindParam(':ID_Livre', $ID_Livre);
$resultat->execute();
$personne = $resultat->fetch(PDO::FETCH_ASSOC);

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (isset($_POST['enregistrer'])) {
// Récupérer les nouvelles valeurs du formulaire
$nom = $_POST['nom'];
$ISBN = $_POST['ISBN'];
$auteur = $_POST['auteur'];
$genre = $_POST['genre'];
$description = $_POST['description'];
if (!empty($_FILES['Changer_photo']['tmp_name'])) {
    // Une nouvelle image a été téléchargée, nous la récupérons
    $img = fopen($_FILES['Changer_photo']['tmp_name'], 'rb'); // Ouvrir le fichier en mode binaire

    if ($img) {
        // Lire le contenu de l'image et le convertir en données binaires
        $imageData = fread($img, filesize($_FILES['Changer_photo']['tmp_name']));
        $img = base64_encode($imageData);
    } else {
        // Afficher un message de débogage en cas d'échec d'ouverture du fichier
        echo 'Échec de l\'ouverture du fichier.';
    }
} else {
    // Aucune nouvelle image téléchargée, nous gardons l'image précédente
    $img = $personne['image'];
}





// Mettre à jour les données de la personne dans la base de données
$resultat = $connexion->prepare('UPDATE livres SET  ISBN = :ISBN , nom = :nom, auteur = :auteur , ID_Categorie = :genre, description = :description , image = :img  WHERE ID_Livre = :ID_livre');
$resultat->bindParam(':ISBN', $ISBN);
$resultat->bindParam(':nom', $nom);
$resultat->bindParam(':auteur', $auteur);
$resultat->bindParam(':genre', $genre);
$resultat->bindParam(':description', $description);
$resultat->bindParam(':img', $img);
$resultat->bindParam(':ID_livre', $ID_Livre);




if ($resultat->execute()) {
    // Succès
    $_SESSION['messageM'] = 'Mise à jour réussie';
} else {
    // Erreur
    $_SESSION['messageM'] = 'Erreur lors de la mise à jour : ' . print_r($resultat->errorInfo(), true);
}


// Rediriger vers la page d'accueil
header('Location:ListesLivres.php');
} else {
// Rediriger vers la page d'accueil sans enregistrer les modifications
header('location:ListesLivres.php');
}
}
?>
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
        <h2><u>Modifier un livre</u></h2>
        <form  method="POST" enctype="multipart/form-data">
            
            <label for="ISBN">ISBN de livre :</label>
            <input type="text" id="ISBN" name="ISBN" value="<?php echo $personne['ISBN'];?>" required>
            <label for="nom">Nom de livre :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $personne['nom'];?>" required>
            <label for="auteur">auteur :</label>
            <input type="text" id="auteur" name="auteur" value="<?php echo $personne['auteur'];?>" required>
            <label for="genre">Genre :</label>
            <select id="genre" name="genre">
    <?php
    // Récupérer toutes les catégories depuis la base de données
    $resultat_categories = $connexion->query('SELECT * FROM categories');
    while ($categorie = $resultat_categories->fetch(PDO::FETCH_ASSOC)) {
        // Vérifier si la catégorie correspond à celle du livre actuel
        $selected = ($personne['ID_Categorie'] == $categorie['ID_Categorie']) ? 'selected' : '';
        echo '<option value="' . $categorie['ID_Categorie'] . '" ' . $selected . '>' . $categorie['nom_categorie'] . '</option>';
    }
    ?>
</select>
            <label for="description">Description :</label>
            <textarea id="description" name="description" rows="4"  required><?php echo $personne['description'];?>"</textarea>
            
                <label for="photo">Image actuelle :</label>
            <?php
            if ($personne['image']) {
                echo '<img src="data:image/jpeg;base64,' . base64_encode($personne['image']) . '" alt="Image actuelle du livre" style="max-width: 300px; max-height: 300px > ';
            } else {
                echo 'Aucune image actuelle disponible.';
            }
            ?>


                <label for="Changer_photo">Changer image :</label>
                <input type="file" id="Changer_photo" name="Changer_photo">
            <?php
                        echo "<button type='submit' class='btn btn-primary' name='enregistrer'>Enregistrer les modifications</button>";
                        echo "<button type='submit' class='btn btn-secondary' name='annuler'>Annuler</button>";
                        $connexion=null;
                            ?>
        </form>
    </div>
</body>
</html>
