<?php
// Établir la connexion à la base de données
$host = "localhost";
$dbName = "bib_bd";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}

// Vérifier si des données ont été soumises
if (isset($_POST['Firstname'], $_POST['Lastname'], $_POST['email'], $_POST['password'])) {
    // Récupérer les données du formulaire d'inscription
    $firstname = $_POST['Firstname'];
    $lastname = $_POST['Lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email domain is "etu.uae.ac.ma"
    $emailDomain = explode('@', $email)[1];
    if ($emailDomain === 'etu.uae.ac.ma') {
        // Insérer les données dans la table admin
        $sql = "INSERT INTO admin (Nom, Prénom, Email, Password) VALUES (?, ?, ?, ?)";
    } else {
        // Insérer les données dans la table membres
        $sql = "INSERT INTO membres (Nom, Prénom, Email, Password) VALUES (?, ?, ?, ?)";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$firstname, $lastname, $email, $password]);

    // Rediriger l'utilisateur vers une autre page après l'inscription réussie
    header("Location: signin.php");
    exit();
} else {
    echo "non valide";
    // Les données n'ont pas été soumises, rediriger vers une autre page ou afficher un message d'erreur
    // header("Location: signup.php");
    exit();
}
?>
