<?php
$host = "localhost";
$dbName = "bib_bd";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ID_Membre']) && isset($_GET['newEmail'])) {
    $ID_Membre = $_GET['ID_Membre'];
    $newEmail = $_GET['newEmail'];

    // Insérer un nouvel enregistrement dans la table "admin" avec les détails du membre
    $sql = "INSERT INTO admin (Nom, Prénom, Email, Password) SELECT Nom, Prénom, ?, Password FROM membres WHERE ID_Membre = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$newEmail, $ID_Membre]);

    // Rediriger l'utilisateur vers la page listermembres.php pour actualiser la liste
    header("Location: ListerMembre.php");
    exit();
}
?>
