<?php
session_start();

if (!isset($_SESSION['user'])) {
    // Redirect if the user is not logged in
    header("Location: signin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $user_id = $_SESSION['user']['ID_User'];
    $comment = $_POST['comment'];

    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "bib_bd";

    $conn = new mysqli($servername, $username, $password_db, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO user_comments (user_id, comment) VALUES ('$user_id', '$comment')";

    if ($conn->query($sql) === TRUE) {
        // Comment inserted successfully
        header("Location: home.php"); // Redirect back to home page
        exit();
    } else {
        // Error inserting comment
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
