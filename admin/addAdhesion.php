<?php
ob_start();
// Inclure les fichiers d'en-tête et de navigation
include('includes/header.php');
include('includes/navbar.php');
include('config.php');

// Initialiser les variables et les messages d'erreur
$date_debut = $date_fin = $statut = $athlete_id = "";
$date_debut_err = $date_fin_err = $statut_err = $athlete_id_err = "";

// Traitement du formulaire lorsqu'il est soumis
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider la date de début
    if(empty(trim($_POST["date_debut"]))) {
        $date_debut_err = "Veuillez entrer une date de début.";
    } else {
        $date_debut = trim($_POST["date_debut"]);
    }
    
    // Valider la date de fin
    if(empty(trim($_POST["date_fin"]))) {
        $date_fin_err = "Veuillez entrer une date de fin.";
    } else {
        $date_fin = trim($_POST["date_fin"]);
    }

    // Valider le statut
    if(empty(trim($_POST["statut"]))) {
        $statut_err = "Veuillez entrer un statut.";
    } else {
        $statut = trim($_POST["statut"]);
    }

    // Valider l'ID de l'athlète
    if(empty(trim($_POST["athlete_id"]))) {
        $athlete_id_err = "Veuillez sélectionner un athlète.";
    } else {
        $athlete_id = trim($_POST["athlete_id"]);
    }

    // Vérifier s'il n'y a pas d'erreurs de saisie
    if(empty($date_debut_err) && empty($date_fin_err) && empty($statut_err) && empty($athlete_id_err)) {
        // Préparer une instruction d'insertion SQL
        $sql = "INSERT INTO adhesion (athlete_id, date_debut, date_fin, statut) VALUES (?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($conn, $sql)) {
            // Liage des variables à la déclaration préparée en tant que paramètres
            mysqli_stmt_bind_param($stmt, "isss", $param_athlete_id, $param_date_debut, $param_date_fin, $param_statut);
            
            // Paramétrage des paramètres
            $param_athlete_id = $athlete_id;
            $param_date_debut = $date_debut;
            $param_date_fin = $date_fin;
            $param_statut = $statut;
            
            // Tentative d'exécution de la déclaration préparée
            if(mysqli_stmt_execute($stmt)) {
                // Redirection vers la page des adhésions après l'ajout réussi
                header("location: adhesions.php");
                exit;
            } else {
                echo "Erreur. Veuillez réessayer plus tard.";
            }

            // Fermeture de la déclaration
            mysqli_stmt_close($stmt);
        }
    }

    // Fermeture de la connexion
    mysqli_close($conn);
}
ob_end_flush();
?>

<div class="container mt-5">
    <h2>Ajouter une Adhésion</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
        <div class="form-group">
            <label>Date de Début</label>
            <input type="text" name="date_debut" class="form-control <?php echo (!empty($date_debut_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date_debut; ?>">
            <span class="invalid-feedback"><?php echo $date_debut_err; ?></span>
        </div>
        <div class="form-group">
            <label>Date de Fin</label>
            <input type="text" name="date_fin" class="form-control <?php echo (!empty($date_fin_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date_fin; ?>">
            <span class="invalid-feedback"><?php echo $date_fin_err; ?></span>
        </div>
        <div class="form-group">
            <label>Statut</label>
            <input type="text" name="statut" class="form-control <?php echo (!empty($statut_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $statut; ?>">
            <span class="invalid-feedback"><?php echo $statut_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Ajouter">
            <a href="adhesions.php" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<?php
include './includes/scripts.php';
include './includes/footer.php';
?>
