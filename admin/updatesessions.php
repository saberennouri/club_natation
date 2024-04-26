<?php
include('./includes/header.php');
include('./includes/navbar.php');
include 'config.php';

// Vérifier si l'ID de la session est passé en paramètre
if (isset($_GET['id'])) {
    $session_id = $_GET['id'];

    // Requête pour récupérer les détails de la session
    $query = "SELECT * FROM sessionsentrainement WHERE session_id = $session_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); // Récupérer les détails de la session

        // Vérifier si le formulaire de mise à jour a été soumis
        if (isset($_POST['modifier'])) {
            $date_session = $_POST['date'];
            $lieu = $_POST['lieu'];
            $activite = $_POST['activite'];
            $entraineur_name = $_POST['entraineur'];
            $athlete_name = $_POST['athlete'];
            $equipe_name = $_POST['equipe'];

            // Récupérer l'ID de l'entraîneur à partir de son nom
            $getEntraineurIdQuery = "SELECT entraineur_id FROM entraineurs WHERE prenom = '$entraineur_name'";
            $result1 = mysqli_query($conn, $getEntraineurIdQuery);
            $row1 = mysqli_fetch_assoc($result1);
            $entraineur_id = $row1['entraineur_id'];

            // Récupérer l'ID de l'athlète à partir de son nom
            $getAthleteIdQuery = "SELECT athlete_id FROM athletes WHERE prenom = '$athlete_name'";
            $result2 = mysqli_query($conn, $getAthleteIdQuery);
            $row2 = mysqli_fetch_assoc($result2);
            $athlete_id = $row2['athlete_id'];

            // Récupérer l'ID de l'équipe à partir de son nom
            $getEquipeIdQuery = "SELECT id_equipe FROM equipe WHERE nom = '$equipe_name'";
            $result3 = mysqli_query($conn, $getEquipeIdQuery);
            $row3 = mysqli_fetch_assoc($result3);
            $equipe_id = $row3['id_equipe'];

            // Requête pour mettre à jour les informations de la session
            $update_query = "UPDATE sessionsentrainement SET date='$date_session', lieu='$lieu', activite='$activite', entraineur_id='$entraineur_id', athlete_id='$athlete_id', equipe_id='$equipe_id' WHERE session_id=$session_id";
            $update_result = mysqli_query($conn, $update_query);

            if (!$update_result) {
                die("Erreur de mise à jour de la session: " . mysqli_error($conn));
            }
            echo "<script>window.location.href='sessions.php'</script>";
        }
        ?>
        <div class="container mt-5">
            <h2 class="mb-4">Modifier une session </h2>
            <form method="post">
                <div class="form-group">
                    <label for="date">Date :</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo $row['date'];
                    ; ?>">
                </div>
                <div class="form-group">
                    <label for="lieu">Lieu :</label>
                    <input type="text" class="form-control" id="lieu" name="lieu" value="<?php echo $row['lieu']; ?>">
                </div>
                <div class="form-group">
                    <label for="activite">Activité :</label>
                    <input type="text" class="form-control" id="activite" name="activite"
                        value="<?php echo $row['activite']; ?>">
                </div>
                <div class="form-group">
                    <label for="entraineur">Entraineur :</label>
                    <select class="form-control" id="entraineur" name="entraineur">
                        <?php
                        // Connexion à la base de données
                        require_once 'config.php';

                        // Sélection des membres
                        $sql = "SELECT * from entraineurs";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option>";
                                echo "<td>" . $row['prenom'] . "</td>";
                                echo "</option>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Aucun role trouvé</td></tr>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="athlete">Nom de l'athlète :</label>
                    <select class="form-control" id="athlete" name="athlete">
                        <?php
                        // Connexion à la base de données
                        require_once 'config.php';

                        // Sélection des membres
                        $sql = "SELECT * from athletes";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option>";
                                echo "<td>" . $row['prenom'] . "</td>";
                                echo "</option>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Aucun athlete trouvé</td></tr>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="equipe_id">Nom de l'équipe :</label>
                    <select class="form-control" id="equipe" name="equipe">
                        <?php
                        // Connexion à la base de données
                        require_once 'config.php';

                        // Sélection des membres
                        $sql = "SELECT * from equipe";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option>";
                                echo "<td>" . $row['nom'] . "</td>";
                                echo "</option>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Aucun equipe trouvé</td></tr>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
                <a href="sessions.php" class="btn btn-secondary">Annuler</a>
            </form>
        </div>

        <?php
    } else {
        echo "Aucun session trouvé avec cet ID.";
    }
} else {
    echo "ID d'session non spécifié.";
}

include('./includes/scripts.php');
include('./includes/footer.php');
?>