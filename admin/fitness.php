<?php
session_start();
include "./includes/navParent.php";
include "./includes/header.php";
include "./config.php";

// Vérifier si l'identifiant du parent est défini dans la session
if (!isset($_SESSION['parent_id'])) {
    // Rediriger vers la page de connexion ou afficher un message d'erreur
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$parent_id = $_SESSION['parent_id'];

// Récupérer les données des conditions physiques
$sql = "SELECT 
    pc.*, 
    a.prenom AS athlete_prenom, 
    a.nom AS athlete_nom, 
    p.prenom AS parent_prenom, 
    p.nom AS parent_nom
FROM 
    physical_conditions pc
INNER JOIN 
    athletes a ON pc.athlete_id = a.athlete_id
INNER JOIN 
    parents p ON a.parent_id = p.parent_id
WHERE 
    p.parent_id = '$parent_id'";

$result = $conn->query($sql);
?>

<div class="container center">
    <h2 style="text-align:center">Physical Conditions</h2>
    <br><br> <a href="add_condition.php" class="btn btn-primary">Ajouter une condition physique</a>
    <br><br><br>
    <table class="table table-hover border">
        <thead>
            <tr>
                <th>ID</th>
                <th>Athlete</th>
                <th>Date</th>
                <th>Poids</th>
                <th>Taille</th>
                <th>Taux du graisse</th>
                <th>Masse Musculaire</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['condition_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['athlete_prenom']) . " " . htmlspecialchars($row['athlete_nom']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['weight']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['height']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['body_fat']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['muscle_mass']) . "</td>";
                    echo "<td>
                            <a href='update_condition.php?condition_id=" . htmlspecialchars($row['condition_id']) . "'>Edit</a> |
                            <a href='delete_condition.php?condition_id=" . htmlspecialchars($row['condition_id']) . "'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
    include "./includes/footer.php";
    $conn->close();
    ?>
</div>
