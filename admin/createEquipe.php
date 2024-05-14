<?php 
include "./includes/header.php";
include "./includes/navbar.php";
// get email from session 
//$email_admin=$_SESSION['email_admin'];
//echo "bienvenue " .$email;
?>
<div class="container mt-5">
        <h2 class="mb-4">Ajouter une équipe</h2>
        <form method="post" action="addEquipe.php">
        
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="form-group">
            <label>Nom de l'Athlète</label>
            <select name="athlete_id" class="form-control <?php echo (!empty($athlete_id_err)) ? 'is-invalid' : ''; ?>">
                <option value="">Sélectionner un athlète</option>
                <?php
                // Récupérer les noms des athlètes depuis la base de données
                $sql_athletes = "SELECT athlete_id, CONCAT(nom, ' ', prenom) AS nom_complet FROM athletes";
                $result_athletes = mysqli_query($conn, $sql_athletes);
                if(mysqli_num_rows($result_athletes) > 0) {
                    while($row_athlete = mysqli_fetch_assoc($result_athletes)) {
                        echo "<option value='" . $row_athlete['athlete_id'] . "'>" . $row_athlete['nom_complet'] . "</option>";
                    }
                }
                ?>
            </select>
            <span class="invalid-feedback"><?php echo $athlete_id_err; ?></span>
        </div>
           
            <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
        </form>


<?php
include "./includes/scripts.php";
include "./includes/footer.php";
?>