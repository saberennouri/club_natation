<?php
include 'config.php';

// Ajouter un parent
if(isset($_POST['ajouter'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $numero_telephone = $_POST['numero_telephone'];

    $query = "INSERT INTO Parents (nom, prenom, email, numero_telephone)
     VALUES ('$nom', '$prenom', '$email', '$numero_telephone')";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die("Erreur d'ajout du parent: " . mysqli_error($conn));
    }
    header("Location: parents.php");
}
?>