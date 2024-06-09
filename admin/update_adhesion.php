<?php
// Inclure les fichiers d'en-tête et de navigation
include('includes/header.php');
include('includes/navbar.php');
include('config.php');

// Vérifier si l'ID de l'adhésion est passé en paramètre dans l'URL
if(isset($_GET['id'])) {
    $adhesion_id = $_GET['id'];

    // Requête pour récupérer les détails de l'adhésion
    $query = "SELECT * FROM adhesion WHERE adhesion_id = $adhesion_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        //var_dump($row);

        // Récupérer tous les statuts disponibles
        $query_statuts = "SELECT DISTINCT statut FROM adhesion";
        $result_statuts = mysqli_query($conn, $query_statuts);

        // Vérifier si le formulaire de mise à jour est soumis
        if(isset($_POST['update_adhesion'])) {
            $new_date_debut = $_POST['new_date_debut'];
            $new_date_fin = $_POST['new_date_fin'];
            $new_statut = $_POST['new_statut'];

            // Requête pour mettre à jour l'adhésion dans la base de données
            if($new_statut=='rejeté'){
                $query = "UPDATE adhesion SET date_debut='$new_date_debut', date_fin='$new_date_fin', statut='' WHERE adhesion_id='$adhesion_id'";
                $result = mysqli_query($conn, $update_query);

            }else{
            $update_query = "UPDATE adhesion SET date_debut='$new_date_debut', date_fin='$new_date_fin', statut='$new_statut' WHERE adhesion_id='$adhesion_id'";
            $update_result = mysqli_query($conn, $update_query);
            if(!$update_result) {
                die("Erreur de mise à jour de l'adhésion: " . mysqli_error($conn));
            }
            echo "<script>window.location.href='adhesions.php'</script>";

         }
        }
?>
<div class="container mt-5">
    <h2>Modifier une adhésion</h2>
    <form method="post">
        <div class="form-group">
            <label for="new_date_debut">Nouvelle date de début :</label>
            <input type="date" class="form-control" id="new_date_debut" name="new_date_debut" value="<?php echo $row['date_debut']; ?>">
        </div>
        <div class="form-group">
            <label for="new_date_fin">Nouvelle date de fin :</label>
            <input type="date" class="form-control" id="new_date_fin" name="new_date_fin" value="<?php echo $row['date_fin']; ?>">
        </div>
        <div class="form-group">
            <label for="new_statut">Nouveau statut :</label>
            
            <select class="form-control" id="new_statut" name="new_statut">
            <option value="">Sélectionner Statut</option>
                <?php
                // Afficher tous les statuts disponibles dans la liste déroulante
                while($row_statut = mysqli_fetch_assoc($result_statuts)) {
                    echo "<option>".$row_statut['statut']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Type Adhésion</label>
            <select name="adhesion_type" class="form-control <?php echo (!empty($typeAdhesion_err)) ? 'is-invalid' : ''; ?>">
                <option value="">Sélectionner Type adhésion</option>
                <?php
                // Récupérer les types des adhésions depuis la base de données
                $sql_adhesion = "SELECT * from adhesion";
                $result_adhesion = mysqli_query($conn, $sql_adhesion);
                if (mysqli_num_rows($result_adhesion) > 0) {
                    while ($row_adhesion = mysqli_fetch_assoc($result_adhesion)) {
                        echo "<option value='" . $row_adhesion['adhesion_id'] . "'>" . $row_adhesion['typeAdhesion'] . "</option>";
                    }
                }
                ?>
            </select>
            <span class="invalid-feedback"><?php echo $typeAdhesion_err; ?></span>
        </div>
        <button type="submit" name="update_adhesion" class="btn btn-primary">Modifier</button>
        <a href="adhesions.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php 
 
} else {
        echo "Aucune adhésion trouvée avec cet ID.";
    }
} else {
    echo "ID d'adhésion non spécifié.";
}

include('./includes/scripts.php');
include('./includes/footer.php');
?>
