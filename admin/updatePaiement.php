<?php
include('./includes/header.php');
include('./includes/navbar.php');
include 'config.php';

// Vérifier si l'ID du paiement est passé en paramètre
if (isset($_GET['update_id'])) {
    $paiement_id = $_GET['update_id'];

    // Requête pour récupérer les détails du paiement
    $query = "SELECT * FROM paiements WHERE paiement_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $paiement_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si la requête a retourné des résultats
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Récupérer les détails du paiement

        // Vérifier si le formulaire de mise à jour a été soumis
        if (isset($_POST['modifier'])) {
            $montant = $_POST['montant'];
            $date_paiement = $_POST['date_paiement'];
            $payment_method = $_POST['payment_method'];
            $athlete_id = $_POST['athlete'];

            // Requête pour mettre à jour les informations du paiement
            $update_query = "UPDATE paiements SET adhesion_id=?, montant=?, date_paiement=?, payment_method=? WHERE paiement_id=?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("isssi", $adhesion_id, $montant, $date_paiement, $payment_method, $paiement_id);
            $stmt->execute();

            if (!$stmt) {
                die("Erreur de mise à jour du paiement: " . $conn->error);
            }
            echo "<script>window.location.href='paiements.php'</script>";
        }
        ?>
        <div class="container mt-5">
            <h2 class="mb-4">Modifier un paiement </h2>
            <form method="post">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="athlete">Nom de l'Athlète</label>
                        <select class="form-control" id="athlete" name="athlete">
                            <?php
                            // Récupérer les noms des athlètes depuis la base de données
                            $sql_athletes = "SELECT athlete_id, CONCAT(nom, ' ', prenom) AS nom_complet FROM athletes";
                            $result_athletes = mysqli_query($conn, $sql_athletes);
                            if (mysqli_num_rows($result_athletes) > 0) {
                                while ($row_athlete = mysqli_fetch_assoc($result_athletes)) {
                                    echo "<option value='" . $row_athlete['athlete_id'] . "'>" . $row_athlete['nom_complet'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="montant">Montant</label>
                        <input type="text" class="form-control" id="montant" name="montant" value="<?php echo $row['montant']; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="date_paiement">Date Paiement</label>
                        <input type="date" class="form-control" id="date_paiement" name="date_paiement" value="<?php echo $row['date_paiement']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="payment_method">Payment Method</label>
                        <input type="text" class="form-control" id="payment_method" name="payment_method" value="<?php echo $row['payment_method']; ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="modifier">Modifier Paiement</button>
            </form>
        </div>
        <?php
    } else {
        echo "Aucun paiement trouvé avec cet ID.";
    }
} else {
    echo "ID d'paiement non spécifié.";
}

include('./includes/scripts.php');
include('./includes/footer.php');
?>
