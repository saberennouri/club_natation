<?php
// Inclure les fichiers d'en-tête et de navigation
include('includes/header.php');
include('includes/navbar.php');
include('config.php');
?>

<script>
    // Fonction pour afficher un popup de modification de l'état
    function modifierStatut(adhesion_id) {
        var nouveauStatut = prompt("Veuillez saisir le nouveau statut (en_attente, accepté, refusé) :");
        
        // Si l'utilisateur a saisi une nouvelle valeur
        if (nouveauStatut !== null) {
            // Envoyer la demande de mise à jour via AJAX
            $.ajax({
                type: 'POST',
                url: 'update_statut.php',
                data: { adhesion_id: adhesion_id, new_status: nouveauStatut },
                success: function(nouveauStatut) {
                    // Mettre à jour le contenu de la cellule statut avec le nouveau statut
                    $("#statut_" + adhesion_id).text(nouveauStatut);
                    window.location.href='adhesions.php';
                
                },
                error: function(xhr, status, error) {
                    // Gérer les erreurs
                    alert("Erreur lors de la mise à jour du statut : " + error);
                }
            });
        }
    }
    

</script>

<div class="container mt-5">
    <h2>Gestion des Adhésions</h2>
    <a href="addAdhesion.php" class="btn btn-primary my-3">Ajouter adhésion</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom Athlète</th>
                <th>Date de Début</th>
                <th>Date de Fin</th>
                <th>Statut</th>
                <th style='text-align:center'>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupérer les adhésions depuis la base de données
            $sql = "SELECT a.prenom as prenom_athlete, a.nom as nom_athlete, ad.*,
                           COALESCE(ad.statut, 'Statut par défaut') AS statut_affiche
                    FROM athletes a
                    LEFT JOIN adhesion ad ON a.athlete_id = ad.athlete_id
                    ORDER BY ad.adhesion_id ASC";

            $result = mysqli_query($conn, $sql);

            // Affichage des résultats dans une table
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['adhesion_id']."</td>";
                    echo "<td>".$row['nom_athlete']."_".$row['prenom_athlete']."</td>";
                    echo "<td>".$row['date_debut']."</td>";
                    echo "<td>".$row['date_fin']."</td>";
                    echo "<td onclick=\"modifierStatut(".$row['adhesion_id'].")\">".$row['statut_affiche']."</td>";
                    echo "<td>
                    <a href='read_adhesion.php?id=" . $row['adhesion_id'] . "' class='btn btn-info'>Lire</a>
                    <a href='update_adhesion.php?id=" . $row['adhesion_id'] . "' class='btn btn-warning'>Modifier</a>
                    <a href='delete_adhesion.php?id=" . $row['adhesion_id'] . "' class='btn btn-danger'>Supprimer</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucune adhésion trouvée.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include './includes/scripts.php';
include './includes/footer.php';
?>
