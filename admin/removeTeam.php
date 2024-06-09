<?php
require_once 'config.php';

// Vérifier si l'ID de l'athlète est passé en paramètre
if (isset($_GET['id'])) {
    $athlete_id = $_GET['id'];

    // Préparer et exécuter la requête pour supprimer l'affiliation
    $sql = "DELETE FROM membre_equipe WHERE id_athlete = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $athlete_id);

    if ($stmt->execute()) {
        // Rediriger vers la page principale après la suppression
        header("Location: affiliations.php?affiliation_removed=1");
    } else {
        echo "Erreur lors de la suppression de l'affiliation: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID de l'athlète non spécifié.";
}

$conn->close();
?>
