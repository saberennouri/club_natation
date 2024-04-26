<?php
    include 'config.php';

    if (isset($_POST["ajouter"])) {
        $nom = $_POST['nom'];
        $date = $_POST['date'];
        $lieu = $_POST['lieu'];
       

        $sql = "INSERT INTO Competitions ( `nom`, `date_debut`, `lieu`) 
        VALUES ('$nom', '$date', '$lieu')";
        $result = mysqli_query($conn, $sql);

    if(!$result) {
        die("Erreur d'ajout d'entraineur: " . mysqli_error($conn));
    }
    header("Location: competitions.php");
    // Fermeture de la connexion
    mysqli_close($conn);
    }   
?>