<?php
// Inclure les fichiers d'en-tête et de navigation
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container mt-5">
    <h2>Emploi du temps des séances d'entraînement de natation pour la semaine</h2>
    <div class="row mb-3">
        <div class="col">
            <a href="createsessions.php" class="btn btn-primary">Ajouter une session</a>
           
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Lieu</th>
                <th>Heure</th>
                <th>Athlètes</th>
                <th>Entraîneur</th>
                <th>Équipe</th>
                <th style="text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            include 'config.php';

            // Requête SQL pour récupérer les sessions d'entraînement
            $sql = "SELECT 
                        sessionsentrainement.*, athletes.*,
                        heuresentrainement.heure, 
                        equipe.nom AS nom_equipe, 
                        entraineurs.nom AS nom_entraineur, 
                        entraineurs.prenom AS prenom_entraineur
                    FROM 
                        sessionsentrainement
                        INNER JOIN heuresentrainement ON sessionsentrainement.session_id = heuresentrainement.session_id
                        INNER JOIN equipe ON sessionsentrainement.equipe_id = equipe.id_equipe
                        inner join athletes on sessionsentrainement.athlete_id=athletes.athlete_id
                        INNER JOIN entraineurs ON sessionsentrainement.entraineur_id = entraineurs.entraineur_id 
                         ORDER BY `sessionsentrainement`.`session_id` ASC";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['session_id'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['lieu'] . "</td>";
                    echo "<td>" . $row['heure'] . "</td>";
                    echo "<td>" . $row['prenom'] . " " . $row['nom'] . "</td>";
                    echo "<td>" . $row['prenom_entraineur'] . " " . $row['nom_entraineur'] . "</td>";
                    echo "<td>" . $row['nom_equipe'] . "</td>";
                    echo "<td>
                            <a href='readsessions.php?id=".$row['session_id']."' class='btn btn-info'>Lire</a>
                            <a href='updatesessions.php?id=" . $row['session_id'] . "' class='btn btn-warning '>Modifier</a>
                            <a href='deletesessions.php?id=" . $row['session_id'] . "' class='btn btn-danger '>Supprimer</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Aucune session trouvée.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// Inclure les fichiers de scripts et de pied de page
include('includes/scripts.php');
include('includes/footer.php');
?>