<?php
include('./includes/header.php');
include('./includes/navbar.php');
include 'config.php';

// Vérifier si l'ID de la equipe est passé en paramètre
if (isset($_GET['id'])) {
    $equipe_id = $_GET['id'];

    // Requête pour récupérer les détails de la equipe
    $query = "SELECT * FROM equipe WHERE id_equipe = $equipe_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); // Récupérer les détails de la equipe

        // Vérifier si le formulaire de mise à jour a été soumis
        if (isset($_POST['modifier'])) {
            
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            echo $description;
           
            $athlete_name = $_POST['athlete'];
           // echo $athlete_name;

          
            // Récupérer l'ID de l'athlète à partir de son nom
            $getAthleteIdQuery = "SELECT athlete_id FROM athletes WHERE prenom = '$athlete_name'";
            $result2 = mysqli_query($conn, $getAthleteIdQuery);
            $row2 = mysqli_fetch_assoc($result2);
            $athlete_id = $row2['athlete_id'];
            //echo $athlete_id;

            // Requête pour mettre à jour les informations de la equipe
            $update_query = "UPDATE `equipe` SET `nom`='$nom',`description`='$description',`athlete_id`='$athlete_id' 
                             WHERE 
                                     id_equipe=$equipe_id";
            $update_result = mysqli_query($conn, $update_query);

            if (!$update_result) {
                die("Erreur de mise à jour de la equipe: " . mysqli_error($conn));
            }
            echo "<script>window.location.href='equipe.php'</script>";
        }
        ?>
        <div class="container mt-5">
        <h2 class="mb-4">Modifier une équipe</h2>
      <form method="post">
        
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $row['nom'];?>">
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <input type="text" class="form-control" id="description" name="description" value="<?php echo $row['description'];?>">
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
                
        <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
    </form>
</div>
        <?php
    } else {
        echo "Aucun equipe trouvé avec cet ID.";
    }
} else {
    echo "ID d'equipe non spécifié.";
}

include('./includes/scripts.php');
include('./includes/footer.php');
?>