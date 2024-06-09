<?php
include "./config.php";

if (isset($_GET['id'])) {
    $performance_id = $_GET['id'];

    // Delete the performance record
    $sql = "DELETE FROM performances WHERE performance_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $performance_id);
        if ($stmt->execute()) {
            echo "Performance supprimée avec succès";
        } else {
            echo "Erreur lors de la suppression: " . $stmt->error;
        }
        $stmt->close();
    }
}

header("Location: performances.php");
exit();
?>
