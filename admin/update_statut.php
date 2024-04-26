<?php
// Inclure le fichier de configuration de la base de données
include('config.php');

// Vérifier si les données sont reçues via POST
if(isset($_POST['adhesion_id']) && isset($_POST['new_status'])) {
    $adhesion_id = $_POST['adhesion_id'];
    $new_status = $_POST['new_status'];

    // Mettre à jour le statut dans la base de données
    $update_query = "UPDATE adhesion SET statut='$new_status' WHERE adhesion_id='$adhesion_id'";
    $update_result = mysqli_query($conn, $update_query);
    
    // Récupérer le nouveau statut de l'adhésion
    $new_status_query = "SELECT statut FROM adhesion WHERE adhesion_id='$adhesion_id'";
    $new_status_result = mysqli_query($conn, $new_status_query);
    $new_status_row = mysqli_fetch_assoc($new_status_result);
    $new_status_value = $new_status_row['statut'];

    // Envoyer le nouveau statut en réponse
    header('location:adhesions.php');
} else {
    // Si les données ne sont pas reçues, renvoyer une erreur
    echo "Erreur: Données non reçues.";
}
?>
