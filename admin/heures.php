<?php
// Inclure les fichiers d'en-tête et de navigation
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container mt-5">
    <h2>Gestion des séances d'entrainements</h2>
    <div class="row mb-3">
        <div class="col">
            <a href="createHeures.php" class="btn btn-primary">Ajouter une seance</a>
           
        </div>
    </div>
    <table class="table table-bordered">
   
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Session</th>
                <th>Equipe</th>
                <th style="text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            include 'config.php';

            // Requête SQL pour récupérer les heures d'entraînement
            $sql = "SELECT heuresentrainement.*, sessionsentrainement.activite as nom_session, 
            sessionsentrainement.date as date_session, equipe.nom AS nom_equipe
            FROM heuresentrainement
            INNER JOIN sessionsentrainement ON heuresentrainement.session_id = sessionsentrainement.session_id
            INNER JOIN equipe ON heuresentrainement.equipe_id = equipe.id_equipe;
            ";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['heure_id'] . "</td>";
                    echo "<td>" . $row['date_session'] . "</td>";
                    echo "<td>" . $row['heure'] . "</td>";
                    echo "<td>" . $row['nom_session'] . "</td>";
                    
                   
                    echo "<td>" . $row['nom_equipe'] . "</td>";
                    echo "<td>
                            <a href='readHeures.php?id=".$row['heure_id']."' class='btn btn-info'>Lire</a>
                            <a href='updateHeures.php?id=" . $row['heure_id'] . "' class='btn btn-warning '>Modifier</a>
                            <a href='deleteHeures.php?id=" . $row['heure_id'] . "' class='btn btn-danger '>Supprimer</a>
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