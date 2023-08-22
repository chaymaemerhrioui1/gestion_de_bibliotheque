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

if (isset($_GET['ID_Livre'])) {
    $ID_livre = $_GET['ID_Livre'];
    // Supprimer la personne de la base de données
    $resultat = $connexion->prepare("DELETE FROM livres WHERE ID_livre = :ID_livre");
    $resultat->bindParam(':ID_livre', $ID_livre);
    $resultat->execute();
}
$nombreSupprime = $resultat->rowCount(); // Récupérer le nombre de lignes supprimées
if ($nombreSupprime > 0) {
    $_SESSION['messageS'] = "Supprision avec succès";} 
    else {
    $_SESSION['messageS'] = "Aucune ligne supprimée.";
}


header("location:ListesLivres.php");
$connexion=null;