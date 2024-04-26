<?php
    include 'config.php';

    if (isset($_POST["ajouter"])) {
        $nom = $_POST['nom'];
        $date = $_POST['date'];
        $lieu = $_POST['lieu'];
        $description = $_POST['description'];

        $sql = "INSERT INTO comites (nom, description, responsable_id) 
        VALUES ('$nom', '$date', '$lieu', '$description')";
        $result = mysqli_query($conn, $sql);

    if(!$result) {
        die("Erreur d'ajout d'entraineur: " . mysqli_error($conn));
    }
    header("Location: comites.php");
    // Fermeture de la connexion
    mysqli_close($conn);
    }   
?>