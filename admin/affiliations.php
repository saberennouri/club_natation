<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container mt-5">
    <h2>Assigner un athlète à une équipe ou supprimer son affiliation</h2>

    <?php
    if (isset($_GET['affiliation_removed'])) {
        echo '<div class="alert alert-success" role="alert">Affiliation supprimée avec succès!</div>';
    }
    ?>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Date de Naissance</th>
                <th>Équipe</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            require_once 'config.php';

            // Sélection des athlètes et des équipes
            $sql = "SELECT a.athlete_id, a.prenom, a.nom, a.date_naissance, e.nom as equipe_nom , af.id_membre as id_membre
                    FROM athletes a 
                    LEFT JOIN membre_equipe af ON a.athlete_id = af.id_athlete 
                    LEFT JOIN equipe e ON af.id_equipe = e.id_equipe";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $equipe_nom = $row['equipe_nom'] ? $row['equipe_nom'] : 'Non affilié';
                    echo "<tr>
                    <td>" . $row['id_membre'] . "</td>
                    <td>" . $row['prenom'] . "</td>
                    <td>" . $row['nom'] . "</td>
                    <td>" . $row['date_naissance'] . "</td>
                    <td>" . $equipe_nom . "</td>
                    <td>";
                    if ($row['equipe_nom']) {
                        echo "<a href='removeTeam.php?id=" . $row['athlete_id'] . "' class='btn btn-danger'>Supprimer l'affiliation</a>";
                    } else {
                        echo "<a href='addTeam.php?id=" . $row['athlete_id'] . "' class='btn btn-success'>Ajouter à une équipe</a>";
                    }
                    echo "</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Aucun athlète trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
