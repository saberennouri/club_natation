<?php
include "./includes/header.php";
include "./includes/navbar.php";
include "./config.php";

// Fetch performance data from the database
$sql = "SELECT p.*, a.prenom, a.nom, e.nom as event_name
        FROM performances p
        JOIN athletes a ON p.athlete_id = a.athlete_id
        JOIN evenements e ON p.event_id = e.evenement_id";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="mb-4">Performances des Athlètes</h2>
    <a href="createPerformances.php" class="btn btn-primary my-3">Ajouter Performances</a>
    <table class="table  table-hover border">
        <thead>
            <tr style="font-size:12px;background-color:aqua">
                <th>Prénom</th>
                <th>Nom</th>
                <th>Événement</th>
                <th>Temps Enregistré</th>
                <th>Classement</th>
                <th>Records Personnels</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["prenom"] . "</td>";
                    echo "<td>" . $row["nom"] . "</td>";
                    echo "<td>" . $row["event_name"] . "</td>";
                    echo "<td>" . $row["temps_enregistre"] . "</td>";
                    echo "<td>" . $row["classement"] . "</td>";
                    echo "<td>" . $row["records_personnels"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>
                            <a href='update_performance.php?id=" . $row["performance_id"] . "' class='btn btn-warning'>Modifier</a>
                            <a href='delete_performance.php?id=" . $row["performance_id"] . "' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette performance?\")'>Supprimer</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Aucune performance trouvée</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>

<?php
// Close the database connection
$conn->close();
?>
