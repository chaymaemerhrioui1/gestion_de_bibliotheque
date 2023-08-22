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
if (isset($_GET['Nom'])) {
    $isbn = $_GET['Nom'];
    
    // Vérifier si un livre a été sélectionné pour la modification
    if (isset($_GET['ID_Membre'])) {
        $ID_Membre = $_GET['ID_Membre'];
    
        // Vérifier si le formulaire de modification a été soumis
        if (isset($_POST['modifier'])) {
            // Récupérer les données du formulaire de modification
            $nom = $_POST['Nom'];
            $Prénom = $_POST['Prénom'];
            $Email = $_POST['Email'];
            $Password = $_POST['Password'];
            
    // Mettre à jour les données du livre (y compris l'image) dans la base de données
    $sql = "UPDATE membres SET Nom = ?, Prénom = ?, Email = ?, Password = ? WHERE ID_Membre = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$Nom, $Prénom, $Email, $Password, $ID_Membre]);

    // Rediriger l'utilisateur vers la page actuelle pour actualiser les données







    
    header("Location: modifierpage.php?ID_Membre=$ID_Membre");
    exit();
}

// Check if the HTTP request method is POST (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the "supprimer" parameter exists in the POST data
    if (isset($_POST['supprimer']) && isset($_POST['ID_Membre'])) {
        // Execute the DELETE query to remove the book from the database
        $sql = "DELETE FROM membres WHERE ID_Membre = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['ID_Membre']]);
        
        // Redirect the user back to the page to refresh the list of books




        
        header("Location: modifierpage.php");
        exit();
    }
}

    
        // Récupérer les informations du livre sélectionné depuis la base de données
        $sql = "SELECT * FROM membres WHERE ID_Membre = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$ID_Membre]);
        $membre = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Vérifier si le livre existe dans la base de données
        if (!$membre) {
            echo "Membre non trouvé dans la base de données.";
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

        <script>
function confirmDelete(memberID) {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce membre ?")) {
        window.location.href = "suppMembre.php?ID_Membre=" + memberID;
    }
}
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
    <h2><u>Liste des Abonnées</u></h2>
        <table class="table table-sm">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
            <?php
            

    
             $sql = "SELECT * FROM membres";
            $stmt = $pdo->query($sql);
            $membres = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($membres as $membre) {
                echo "<tr>";
                echo "<td>" . $membre['Nom'] . "</td>";
                echo "<td>" . $membre['Prénom'] . "</td>";
                echo "<td>" . $membre['Email'] . "</td>";
                echo "<td>" . str_repeat("*", strlen($membre['Password'])) . "</td>"; // Replace password with *
                echo "<td><a class='btn btn-warning' href='javascript:void(0);' onclick='confirmDelete(" . $membre['ID_Membre'] . ")'>Supprimer</a> <a class='bbb btn btn-success' href='modifiermembre.php?ID_Membre=" . $membre['ID_Membre'] . "'>Modifier</a> <a class='btn btn-primary' href='renommeradmin.php?ID_Membre=" . $membre['ID_Membre'] . "'>Renommer admin</a></td>";
                echo "</tr>";
            }
            
                ?>

        </table> 
    </div>
</body>
</html>



























    