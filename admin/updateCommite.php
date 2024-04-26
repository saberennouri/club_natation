<?php

include('./includes/header.php');
include('./includes/navbar.php');
include 'config.php';

// Vérifier si l'ID de l'athlète est passé en paramètre
if (isset($_GET['id'])) {
    $comite_id = $_GET['id'];

    // Requête pour récupérer les détails de l'athlète
    $query = "SELECT * FROM comites WHERE comite_id = $comite_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result); // Récupérer les détails de l'athlète

        // Vérifier si le formulaire de mise à jour a été soumis
        if (isset($_POST['modifier'])) {
            
            $nom = $_POST['nom'];
            $description = $_POST['description'];
           

            // Récupérer le nom du utilisateur à partir du formulaire
            $user_name = $_POST['utilisateur'];

            // Récupérer l'ID du utilisateur à partir de son nom
            $getutilisateurIdQuery = "SELECT utilisateur_id FROM utilisateurs WHERE nom = '$user_name'";
            $result1 = mysqli_query($conn, $getutilisateurIdQuery);
            $row1 = mysqli_fetch_assoc($result1);
            $utilisateur_id = $row1['utilisateur_id'];

            

            // Requête pour mettre à jour les informations de commité
            $update_query = "UPDATE `comites` SET `nom`='$nom',`description`='$description',
            `responsable_id`='$utilisateur_id'
            WHERE comite_id=$comite_id";
            $update_result = mysqli_query($conn, $update_query);

            if (!$update_result) {
                die("Erreur de mise à jour de commité: " . mysqli_error($conn));
            }
            echo "<script>window.location.href='commites.php'</script>";
        }
        ?>

        <div class="container mt-5">
            <h2 class="mb-4">Modifier une commité</h2>
            <form method="post">
              
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $row['nom'] ?>" >
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <input type="description" class="form-control" id="description" name="description" value="<?php echo $row['description'] ?>">
                </div>
                
                <div class="form-group">
                    <label for="utilisateur">utilisateur :</label>
                    <select class="form-control" id="utilisateur" name="utilisateur" required>
                        <?php
                        // Sélection des utilisateurs
                        $sql_utilisateur = "SELECT * from utilisateurs";
                        $result_utilisateur = $conn->query($sql_utilisateur);
                        if ($result_utilisateur->num_rows > 0) {
                            while ($row_utilisateur = $result_utilisateur->fetch_assoc()) {
                                echo "<option value='" . $row_utilisateur['nom'] . "'";
                                if ($row_utilisateur['utilisateur_id'] == $row['responsable_id']) {
                                    echo " selected";
                                }
                                echo ">". $row_utilisateur['nom'] . "</option>";
                            }
                        } else {
                            echo "<option>Aucun utilisateur trouvé</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
                <a href="commites.php" class="btn btn-secondary">Annuler</a>
            </form>
        </div>

        <?php
    } else {
        echo "Aucun commité trouvé avec cet ID.";
    }
} else {
    echo "ID du commité non spécifié.";
}

include('./includes/scripts.php');
include('./includes/footer.php');
?>
