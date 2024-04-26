<?php
// Inclure le fichier de configuration de la base de données
include 'config.php';

// Vérifier si le formulaire a été soumis
if (isset($_POST['ajouter'])) {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $date = $_POST['date_evenement'];
    $lieu = $_POST['lieu'];
    

    // Requête SQL pour insérer un nouvel événement dans la base de données
    $sql = "INSERT INTO evenements (nom, date_evenement, lieu)
     VALUES ('$nom', '$date', '$lieu')";
    
    // Exécuter la requête
    if (mysqli_query($conn, $sql)) {
        echo "Nouvel événement ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'événement: " . mysqli_error($conn);
    }
    header("Location: evenements.php");
    // Fermer la connexion à la base de données
    mysqli_close($conn);
}
?>