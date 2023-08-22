<?php
session_start();
$servername="localhost";
$username="root";
$password="";
$dbname="bib_bd";

$connexion=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
if (!$connexion) {
    die();
}

if (isset($_GET['ID_Membre'])) {
    $ID_Membre = $_GET['ID_Membre'];
    // Supprimer la personne de la base de données
    $resultat = $connexion->prepare("DELETE FROM membres WHERE ID_Membre = :ID_Membre");
    $resultat->bindParam(':ID_Membre', $ID_Membre);
    $resultat->execute();
    $nombreSupprime = $resultat->rowCount(); // Récupérer le nombre de lignes supprimées

    if ($nombreSupprime > 0) {
        $_SESSION['messageS'] = "Suppression avec succès";
    } else {
        $_SESSION['messageS'] = "Aucune ligne supprimée.";
    }
}

header("location:ListerMembre.php");
$connexion=null;
?>
