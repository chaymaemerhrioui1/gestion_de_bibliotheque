<!-- search_results.php -->
<?php
if (isset($_GET['search_query'])) {
    $search_query = $_GET['search_query'];

    // Vous pouvez maintenant rechercher le mot $search_query dans votre contenu HTML et afficher les résultats
    // Par exemple, vous pourriez parcourir votre contenu HTML et chercher le mot dans les titres, paragraphes, etc.
    // Ensuite, affichez les résultats trouvés.

    // Exemple basique
    $content = ob_get_clean(); // Récupère le contenu HTML de votre "home.php"
    if (stripos($content, $search_query) !== false) {
        echo "Found the word: $search_query";
    } else {
        echo "No results found.";
    }
} 
?>
