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
                    // Mettre à jour le contenu de la cellule statut avec le nouveau statut et la couleur appropriée
                    $("#statut_" + adhesion_id).text(nouveauStatut);
                    if (nouveauStatut === "refusé") {
                        $("#statut_" + adhesion_id).css("color", "red");
                    } else if (nouveauStatut === "accepté") {
                        $("#statut_" + adhesion_id).css("color", "green");
                    } else {
                        $("#statut_" + adhesion_id).css("color", ""); // Réinitialiser la couleur
                    }
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
    <h2>Liste des Adhésions</h2>
    <a href="addAdhesion.php" class="btn btn-primary my-3">Ajouter adhésion</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom Athlète</th>
                <th>Date de Début</th>
                <th>Date de Fin</th>
                <th>Type Adhésion</th>
                <th>Statut</th>
                <th style='text-align:center'>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupérer les adhésions depuis la base de données
            $sql = "SELECT  * from adhesion";
            $result = mysqli_query($conn, $sql);
            // Affichage des résultats dans une table
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $athlete_id = $row['athlete_id'];
                    $sqlathlete="select * from athletes where athlete_id=$athlete_id";
                    $resultathlete = mysqli_query($conn, $sqlathlete);
                    $rowathlete = $resultathlete->fetch_assoc();                  

                    echo "<tr>";
                    echo "<td>".$row['adhesion_id']."</td>";
                    echo "<td>".$rowathlete['nom']."_".$rowathlete['prenom']."</td>";
                    echo "<td>".$row['date_debut']."</td>";
                    echo "<td>".$row['date_fin']."</td>";
                    echo "<td>".$row['typeAdhesion']."</td>";
                    echo "<td onclick=\"modifierStatut(".$row['adhesion_id'].")\">".$row['statut']."</td>";
                    echo "<td>
                 
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
