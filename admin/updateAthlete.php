<?php

include('./includes/header.php');
include('./includes/navbar.php');
include 'config.php';

// Vérifier si l'ID de l'athlète est passé en paramètre
if (isset($_GET['id'])) {
    $athlete_id = $_GET['id'];

    // Requête pour récupérer les détails de l'athlète
    $query = "SELECT * FROM athletes WHERE athlete_id = $athlete_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result); // Récupérer les détails de l'athlète

        // Vérifier si le formulaire de mise à jour a été soumis
        if (isset($_POST['modifier'])) {
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $date_naissance = $_POST['date_naissance'];
            $sexe = $_POST['sexe'];

            // Récupérer le nom du parent à partir du formulaire
            $parent_name = $_POST['parent'];

            // Récupérer l'ID du parent à partir de son nom
            $getparentIdQuery = "SELECT parent_id FROM parents WHERE nom = '$parent_name'";
            $result1 = mysqli_query($conn, $getparentIdQuery);
            $row1 = mysqli_fetch_assoc($result1);
            $parent_id = $row1['parent_id'];

            // Récupérer le nom de l'entraîneur à partir du formulaire
            $entraineur_name = $_POST['entraineur'];

            // Récupérer l'ID de l'entraîneur à partir de son nom
            $getEntraineurIdQuery = "SELECT entraineur_id FROM entraineurs WHERE nom = '$entraineur_name'";
            $result2 = mysqli_query($conn, $getEntraineurIdQuery);
            $row2 = mysqli_fetch_assoc($result2);
            $entraineur_id = $row2['entraineur_id'];

            // Requête pour mettre à jour les informations de l'athlète
            $update_query = "UPDATE `athletes` SET `prenom`='$prenom',`nom`='$nom',`date_naissance`='$date_naissance',
            `sexe`='$sexe',`parent_id`='$parent_id',`entraineur_id`='$entraineur_id'
            WHERE athlete_id=$athlete_id";
            $update_result = mysqli_query($conn, $update_query);

            if (!$update_result) {
                die("Erreur de mise à jour de l'athlète: " . mysqli_error($conn));
            }
            echo "<script>window.location.href='athletes.php'</script>";
        }
        ?>

        <div class="container mt-5">
            <h2 class="mb-4">Modifier un Athlète</h2>
            <form method="post">
                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $row['prenom'] ?>">
                </div>
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $row['nom'] ?>" >
                </div>
                <div class="form-group">
                    <label for="date_naissance">Date de Naissance :</label>
                    <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="<?php echo $row['date_naissance'] ?>">
                </div>
                <div class="form-group">
                    <label for="sexe">Sexe :</label>
                    <select class="form-control" id="sexe" name="sexe" required>
                        <option >Masculin</option>
                        <option>Féminin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="parent">Parent :</label>
                    <select class="form-control" id="parent" name="parent" required>
                        <?php
                        // Sélection des parents
                        $sql_parent = "SELECT * from parents";
                        $result_parent = $conn->query($sql_parent);
                        if ($result_parent->num_rows > 0) {
                            while ($row_parent = $result_parent->fetch_assoc()) {
                                echo "<option value='" . $row_parent['nom'] . "'";
                                if ($row_parent['parent_id'] == $row['parent_id']) {
                                    echo " selected";
                                }
                                echo ">" . $row_parent['prenom'] . " " . $row_parent['nom'] . "</option>";
                            }
                        } else {
                            echo "<option>Aucun parent trouvé</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="entraineur">Entraîneur :</label>
                    <select class="form-control" id="entraineur" name="entraineur" required>
                        <?php
                        // Sélection des entraîneurs
                        $sql_entraineur = "SELECT * from entraineurs";
                        $result_entraineur = $conn->query($sql_entraineur);
                        if ($result_entraineur->num_rows > 0) {
                            while ($row_entraineur = $result_entraineur->fetch_assoc()) {
                                echo "<option value='" . $row_entraineur['nom'] . "'";
                                if ($row_entraineur['entraineur_id'] == $row['entraineur_id']) {
                                    echo " selected";
                                }
                                echo ">" . $row_entraineur['prenom'] . " " . $row_entraineur['nom'] . "</option>";
                            }
                        } else {
                            echo "<option>Aucun entraîneur trouvé</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
                <a href="index.php" class="btn btn-secondary">Annuler</a>
            </form>
        </div>

        <?php
    } else {
        echo "Aucun athlète trouvé avec cet ID.";
    }
} else {
    echo "ID d'athlète non spécifié.";
}

include('./includes/scripts.php');
include('./includes/footer.php');
?>
