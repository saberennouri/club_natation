<?php
// insertion donnée à partir du formulaire du dashboard parent
session_start();
include "./config.php";

if (isset($_POST['ajouter'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $date_naissance = $_POST['date_naissance'];
    $sexe = $_POST['sexe'];
    $parent = $_SESSION['parent_id'];  // Assuming you store parent ID in the session
    $entraineur = $_SESSION['entraineur_id']; // Retrieve the entraineur_id from the form


// Prepare an SQL statement to insert the data into the database
    $sql = "INSERT INTO athletes (prenom, nom, date_naissance, sexe, parent_id, entraineur_id) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssii", $prenom, $nom, $date_naissance, $sexe, $parent, $entraineur);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully";
            // Redirect or provide feedback to the user as needed
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
