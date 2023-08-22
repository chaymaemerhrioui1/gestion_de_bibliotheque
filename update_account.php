<?php
session_start();

if (isset($_POST['oldPassword']) && isset($_POST['newName']) && isset($_POST['newEmail'])) {
    $oldPassword = $_POST['oldPassword'];
    $newName = $_POST['newName'];
    $newEmail = $_POST['newEmail'];
    $newPassword = $_POST['newPassword'];

    // Assuming you have already established a database connection
    $servername = "localhost";
        $username = "root";
        $password_db = "";
        $dbname = "bib_bd";

        $conn = new mysqli($servername, $username, $password_db, $dbname);
        if ($conn->connect_error) {
            die("La connexion à la base de données a échoué : " . $conn->connect_error);
        }

    // Verify old password against the stored password
    $userId = $_SESSION['user']['ID_Membre'];
    $sql = "SELECT Password FROM membres WHERE ID_Membre = '$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['Password'];

        if (password_verify($oldPassword, $storedPassword)) {
            // Update user's name and email
            $sqlUpdate = "UPDATE membres SET Nom = '$newName', Email = '$newEmail' WHERE ID_Membre = '$userId'";
            if ($conn->query($sqlUpdate) === TRUE) {
                echo "Account information updated successfully.";
            } else {
                echo "Error updating account information: " . $conn->error;
            }

            // Update password if provided
            if (!empty($newPassword)) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $sqlUpdatePassword = "UPDATE membres SET Password = '$hashedPassword' WHERE ID_Membre = '$userId'";
                if ($conn->query($sqlUpdatePassword) === TRUE) {
                    echo "Password updated successfully.";
                } else {
                    echo "Error updating password: " . $conn->error;
                }
            }
        } else {
            echo "Old password is incorrect.";
        }
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
