<?php
// Établir la connexion à la base de données (comme dans les autres fichiers)
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

// Vérifier si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire via POST
    $userID = $_POST['userID'];
    $newNom = $_POST['newNom'];
    $newPrenom = $_POST['newPrenom'];
    $newEmail = $_POST['newEmail'];
    $newPassword = $_POST['newPassword'];

    // Préparer les colonnes et valeurs à mettre à jour
    $updateColumns = array();
    $updateValues = array();

    if (!empty($newNom)) {
        $updateColumns[] = 'Nom = ?';
        $updateValues[] = $newNom;
    }
    if (!empty($newPrenom)) {
        $updateColumns[] = 'Prénom = ?';
        $updateValues[] = $newPrenom;
    }
    if (!empty($newEmail)) {
        $updateColumns[] = 'Email = ?';
        $updateValues[] = $newEmail;
    }
    if (!empty($newPassword)) {
        $updateColumns[] = 'Password = ?';
        $updateValues[] = $newPassword;
    }

    // Si des colonnes à mettre à jour ont été spécifiées, exécuter la requête
    if (!empty($updateColumns)) {
        $updateColumnsString = implode(', ', $updateColumns);
        $sql = "UPDATE membres SET $updateColumnsString WHERE ID_Membre = ?";
        $stmt = $pdo->prepare($sql);
        $updateValues[] = $userID; // Ajouter l'ID de l'utilisateur à la fin des valeurs
        $stmt->execute($updateValues);

        // Envoyer une réponse au client (vous pouvez personnaliser le message)
        echo "Informations mises à jour avec succès !";
    } else {
        echo "Aucune information à mettre à jour.";
    }
}
?>
