<?php

include 'config.php';

// Check if the 'ajouter' button is clicked
if (isset($_POST['ajouter'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $date_naissance = $_POST['date_naissance'];
    $sexe = $_POST['sexe'];

    // Get parent id from the submitted form
    $parent_name = $_POST['parent'];
    $getparentIdQuery = "SELECT parent_id FROM parents WHERE prenom = '$parent_name'";
    $result1 = mysqli_query($conn, $getparentIdQuery);
    $row1 = mysqli_fetch_assoc($result1);
    $parent_id = $row1['parent_id'];

    // Get entraineur id from the submitted form
    $entraineur_name = $_POST['entraineur'];
    $getEntraineurIdQuery = "SELECT entraineur_id FROM entraineurs WHERE prenom = '$entraineur_name'";
    $result2 = mysqli_query($conn, $getEntraineurIdQuery);
    $row2 = mysqli_fetch_assoc($result2);
    $entraineur_id = $row2['entraineur_id'];

    // Insert query to add a new athlete
    $insert_query = "INSERT INTO `athletes` (`prenom`, `nom`, `date_naissance`, `sexe`, `parent_id`, `entraineur_id`)
                     VALUES ('$prenom', '$nom', '$date_naissance', '$sexe', '$parent_id', '$entraineur_id')";
    $insert_result = mysqli_query($conn, $insert_query);

    if (!$insert_result) {
        die("Erreur d'ajout de l'athlète: " . mysqli_error($conn));
    }
    echo "<script>window.location.href='athletes.php'</script>";
}
