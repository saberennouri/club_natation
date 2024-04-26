<?php

include('./includes/header.php');
include('./includes/navbar.php');
include 'config.php';

// Vérifier si l'ID de l'heure est passé en paramètre
if (isset($_GET['id'])) {
    $heure_id = $_GET['id'];

    // Requête pour récupérer les détails du heure
    $query = "SELECT * FROM heuresentrainement WHERE heure_id = $heure_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result); // Récupérer les détails du heure

        // Vérifier si le formulaire de mise à jour a été soumis
        if (isset($_POST['modifier'])) {

            $date_heure = $_POST['heure'];
            
            // Récupérer le nom de l'equipe à partir du formulaire
            $session_name = $_POST['session'];

            // Récupérer l'ID de l'session à partir de son nom
            $getsessionIdQuery = "SELECT session_id FROM sessionsentrainement WHERE activite = '$session_name'";
            $result1 = mysqli_query($conn, $getsessionIdQuery);
            $row1 = mysqli_fetch_assoc($result1);
            $session_id = $row1['session_id'];

            // Récupérer le nom de l'equipe à partir du formulaire
            $equipe_name = $_POST['equipe'];

            // Récupérer l'ID de l'equipe à partir de son nom
            $getequipeIdQuery = "SELECT id_equipe FROM equipe WHERE nom = '$equipe_name'";
            $result2 = mysqli_query($conn, $getequipeIdQuery);
            $row2 = mysqli_fetch_assoc($result2);
            $equipe_id = $row2['id_equipe'];

            // Requête pour mettre à jour les informations du heure
            $update_query = "UPDATE `heuresentrainement` SET `heure`='$date_heure',
            `session_id`='$session_id',`equipe_id`='$equipe_id'
            WHERE heure_id=$heure_id";
            $update_result = mysqli_query($conn, $update_query);

            if (!$update_result) {
                die("Erreur de mise à jour du heure: " . mysqli_error($conn));
            }
            echo "<script>window.location.href='heures.php'</script>";
        }
        ?>

        <div class="container mt-5">
            <h2 class="mb-4">Modifier une heure </h2>
            <form method="post">
                <div class="form-group">
                    <label for="heure">Date de heure :</label>
                    <input type="time" class="form-control" id="heure" name="heure"
                        value="<?php echo $row['heure'] ?>">
                </div>
                <div class="form-group">
                    <label for="session">Session_entrainement :</label>
                    <select class="form-control" id="session" name="session" required>
                        <?php
                        // Sélection des sessions
                        $sql_session = "SELECT * from sessionsentrainement";
                        $result_session = $conn->query($sql_session);
                        if ($result_session->num_rows > 0) {
                            while ($row_session = $result_session->fetch_assoc()) {
                                echo "<option value='" . $row_session['activite'] . "'";
                                if ($row_session['session_id'] == $row['session_id']) {
                                    echo " selected";
                                }
                                echo ">" . $row_session['activite'] . "</option>";
                            }
                        } else {
                            echo "<option>Aucun equipe trouvé</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="equipe">Equipe :</label>
                    <select class="form-control" id="equipe" name="equipe" required>
                        <?php
                        // Sélection des equipe
                        $sql_equipe = "SELECT * from equipe";
                        $result_equipe = $conn->query($sql_equipe);
                        if ($result_equipe->num_rows > 0) {
                            while ($row_equipe = $result_equipe->fetch_assoc()) {
                                echo "<option value='" . $row_equipe['nom'] . "'";
                                if ($row_equipe['id_equipe'] == $row['equipe_id']) {
                                    echo " selected";
                                }
                                echo ">" . $row_equipe['nom'] . "</option>";
                            }
                        } else {
                            echo "<option>Aucun equipe trouvé</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
                <a href="heures.php" class="btn btn-secondary">Annuler</a>
            </form>
        </div>

        <?php
    } else {
        echo "Aucun heure trouvé avec cet ID.";
    }
} else {
    echo "ID d'heure non spécifié.";
}

include('./includes/scripts.php');
include('./includes/footer.php');
?>