<?php
session_start();

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
$ID_Membre = $_GET['ID_Membre'];
$resultat = $connexion->prepare('SELECT * FROM membres WHERE ID_Membre = :ID_Membre');
$resultat->bindParam(':ID_Membre', $ID_Membre);
$resultat->execute();
$personne = $resultat->fetch(PDO::FETCH_ASSOC);

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (isset($_POST['enregistrer'])) {
// Récupérer les nouvelles valeurs du formulaire
$Nom = $_POST['Nom'];
$Prénom = $_POST['Prénom'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];



// Mettre à jour les données de la personne dans la base de données
$resultat = $connexion->prepare('UPDATE membres SET  Nom = :Nom , Prénom = :Prénom, Email = :Email , Password = :Password  WHERE ID_Membre = :ID_Membre');
$resultat->bindParam(':Nom', $Nom);
$resultat->bindParam(':Prénom', $Prénom);
$resultat->bindParam(':Email', $Email);
$resultat->bindParam(':Password', $Password);
$resultat->bindParam(':ID_Membre', $ID_Membre);




if ($resultat->execute()) {
    // Succès
    $_SESSION['messageM'] = 'Mise à jour réussie';
} else {
    // Erreur
    $_SESSION['messageM'] = 'Erreur lors de la mise à jour : ' . print_r($resultat->errorInfo(), true);
}


// Rediriger vers la page d'accueil
header('Location:ListerMembre.php');
} else {
// Rediriger vers la page d'accueil sans enregistrer les modifications
header('location:ListerMembre.php');
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
        <h2><u>Modifier un membre</u></h2>
        <form  method="POST" enctype="multipart/form-data">
            
            <label for="Nom">Nom de membre :</label>
            <input type="text" id="Nom" name="Nom" value="<?php echo $personne['Nom'];?>" required>
            <label for="Prénom">Prénom de membre :</label>
            <input type="text" id="Prénom" name="Prénom" value="<?php echo $personne['Prénom'];?>" required>
            <label for="Email">Email :</label>
            <input type="text" id="Email" name="Email" value="<?php echo $personne['Email'];?>" required>

            <label for="Password">Password :</label>
            <input type="text" id="Password" name="Password" value="<?php echo $personne['Password'];?>" required>

</select>
        
            <?php
                        echo "<button type='submit' class='btn btn-primary' name='enregistrer'>Enregistrer les modifications</button>";
                        echo "<button type='submit' class='btn btn-secondary' name='annuler'>Annuler</button>";
                        $connexion=null;
                            ?>
        </form>
    </div>
</body>
</html>
