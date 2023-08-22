<!DOCTYPE html>
<html>
<head>
    <title>Book Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            background-image: url("image/im1.jpg");
        }

        h2 {
            color: #333;
            margin-left: 300px;
            margin-top: 80px;
        }

        .book-container {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            margin-top: 100px;
            background-color:#fff;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .book-image {
            flex: 0 0 150px;
            margin-right: 20px;
        }

        .book-image img {
            max-width: 100%;
            height: auto;
        }

        .book-info {
            flex: 1;
        }
        .section-title h2 {
            display: inline-block;
            background-color: orange;
            color: white;
            padding: 5px 10px;
            border: 2px solid orange;
            border-radius: 5px;
        }
        .book-info p strong {
            font-size: 18px; 
            
        }
        .container1 {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .book-info-container1 {
            
            width: 400px;
            height: 150px;
            background-color: #ffffff; /* Couleur de fond du nuage (blanc dans cet exemple) */
            border-radius: 50px; /* Rayon de la courbure des bords pour créer l'effet de nuage */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
            
        }

        .book-image {
            flex: 0 0 220px;
            margin-right: 20px;
        }

        .container1 h4{
            margin-left:160px;
        }
        .container1 p{
            margin-left:40px;
        }
    </style>
</head>
<body>
<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'bib_bd';

$connection = new mysqli($hostname, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $selectedGenre = $_POST['ID_Categorie'];
    $bookTitle = $_POST['nom'];
    $bookAuthor = $_POST['auteur'];

    $conditions = array();

    // Check if book title is provided and add it to conditions
    if (!empty($bookTitle)) {
        $conditions[] = "nom LIKE '%$bookTitle%'";
    }

    // Check if book author is provided and add it to conditions
    if (!empty($bookAuthor)) {
        $conditions[] = "auteur LIKE '%$bookAuthor%'";
    }

    // Check if a genre is selected and add it to conditions
    if (!empty($selectedGenre)) {
        $conditions[] = "ID_Categorie = (SELECT ID_Categorie FROM categories WHERE nom_categorie = '$selectedGenre')";
    }

    // Create the WHERE clause for the SQL query
    if (!empty($conditions)) {
        $whereClause = implode(" AND ", $conditions);
        $query = "SELECT ISBN, nom, auteur, ID_Categorie, description, image, 
                (SELECT nom_categorie FROM categories WHERE ID_Categorie = livres.ID_Categorie) AS nom_categorie
                FROM livres
                WHERE $whereClause";
    } else {
        // If no conditions provided, select all books
        $query = "SELECT ISBN, nom, auteur, ID_Categorie, description, image, 
                (SELECT nom_categorie FROM categories WHERE ID_Categorie = livres.ID_Categorie) AS nom_categorie
                FROM livres";
    }

    // Execute the query
    $result = mysqli_query($connection, $query);

    // Check if any matching records were found
    if (mysqli_num_rows($result) > 0) {
        // Display success message if book(s) were found
        echo '<div class="section-title">';
        echo '<h2>Book Information</h2>';
        echo '</div>';
        // Loop through the results and display book information
        while ($row = mysqli_fetch_assoc($result)) {
            // Here, you can display the book details and image using HTML and CSS
            echo '<div class="book-container">';
            echo '<div class="book-image">';
            // Display the image if the 'image' column is not empty
            $defaultImage = "nobook.jpeg";
            if (!empty($row['image'])) {
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Book Image">';
            }else {
                // Afficher l'image par défaut
                echo '<img src="' . $defaultImage . '" alt="Default Image">';
            }
            echo '</div>';
            echo '<div class="book-info">';
            echo '<p><strong>ISBN : </strong>' . $row['ISBN'] . '</p>';
            echo '<p><strong>Titre de livre :</strong> ' . $row['nom'] . '</p>';
            echo '<p><strong>Auteur :</strong> ' . $row['auteur'] . '</p>';
            echo '<p><strong>Genre : </strong>' . $row['nom_categorie'] . '</p>';
            echo '<p><strong>Description: </strong>' . $row['description'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo "<hr>"; // Add a horizontal line between books
        }
    } else {
        
        echo '<div class="container1">';
        echo '<div class="book-image">';
        echo '<img src="image/sorry.jpeg" alt="Sorry Image">';
        echo '</div>';
        echo '<div class="book-info-container1">';
        // Display a message if no matching records were found
        echo '<h4>Sorry !</h4>';
        echo "<p>No book found with the provided information .</p>";
    }
}

// Close the database connection
mysqli_close($connection);
?>
</body>
</html>
