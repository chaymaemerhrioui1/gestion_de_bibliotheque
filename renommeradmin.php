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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ID_Membre'])) {
    // Établissez la connexion à la base de données (comme dans le fichier listermembres.php)

    $ID_Membre = $_GET['ID_Membre'];

    // Vérifiez si l'utilisateur a confirmé le renommage de l'admin
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // Mettez à jour l'email du membre en ajoutant '@etu.uae.ac.ma'
        $newEmail = $membre['Email'] . 'Admin_Souhaite@etu.uae.ac.ma';
        $sql = "UPDATE membres SET Email = ? WHERE ID_Membre = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$newEmail, $ID_Membre]);

        // Affichez une alerte JavaScript pour informer l'utilisateur de la mise à jour
        echo "<script>
            alert('L\'email a été renommé avec succès en ajoutant \'@etu.uae.ac.ma\'');
            window.location.href = 'ListerMembre.php';
        </script>";
        exit();
    }

    // Récupérez les informations du membre sélectionné depuis la base de données
    $sql = "SELECT * FROM membres WHERE ID_Membre = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ID_Membre]);
    $membre = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifiez si le membre existe dans la base de données
    if (!$membre) {
        echo "Membre non trouvé dans la base de données.";
        exit();
    }

    echo "<script>
        var confirmed = confirm('Voulez-vous vraiment renommer l\'email de ce membre en ajoutant \'@etu.uae.ac.ma\' ?');
        if (confirmed) {
            window.location.href = 'renommeradmin.php?ID_Membre=$ID_Membre&confirm=yes';
        } else {
            window.location.href = 'ListerMembre.php';
        }
    </script>";
}
?>
