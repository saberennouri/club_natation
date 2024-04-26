<?php
include('./includes/header.php');
include('./includes/navbar.php');
include 'config.php';

// Vérifier si l'ID du utilisateur est passé en paramètre
if (isset($_GET['id'])) {
    $utilisateur_id = $_GET['id'];

    // Requête pour récupérer les détails du utilisateur
    $query = "SELECT * FROM utilisateurs WHERE utilisateur_id = $utilisateur_id";
    $result = mysqli_query($conn, $query);
    

    // Vérifier si la requête a retourné des résultats
    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result); // Fetch the user details

        // Vérifier si le formulaire de mise à jour a été soumis
        if (isset($_POST['modifier'])) {
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $motdepasse = $_POST['mot_de_passe'];

            // Récupérer le nom du rôle à partir du formulaire
            $role_name = $_POST['role'];

            // Récupérer l'ID du rôle à partir de son nom
            $getRoleIdQuery = "SELECT role_id FROM roles WHERE nom = '$role_name'";
            $result = mysqli_query($conn, $getRoleIdQuery);
            $row1 = mysqli_fetch_assoc($result);
            $role_id = $row1['role_id'];

            // Requête pour mettre à jour les informations d'utilisateur
            $update_query = "UPDATE utilisateurs SET nom='$nom', email='$email', 
            mot_de_passe='$motdepasse', role_id=$role_id
            WHERE utilisateur_id=$utilisateur_id";
            $update_result = mysqli_query($conn, $update_query);

            if (!$update_result) {
                die("Erreur de mise à jour d'utilisateur: " . mysqli_error($conn));
            }
            echo "<script>window.location.href='utilisateurs.php'</script>";
        }
        ?>

        <div class="container mt-5">
            <h2 class="mb-4">Modifier un utilisateur</h2>
            <form method="post">
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $row['nom'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="motdepasse">Mot de passe :</label>
                    <input type="text" class="form-control" id="mot_de_passe" name="mot_de_passe"
                        value="<?php echo $row['mot_de_passe'] ?>">
                </div>

                <div class="form-group">
                    <label for="role">Rôle :</label>
                    <select class="form-control" id="role" name="role" required>
                        <?php
                        // Connexion à la base de données
                        require_once 'config.php';

                        // Sélection des membres
                        $sql = "SELECT * from roles";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option>" . $row['nom'] . "</option>";
                            }
                        } else {
                            echo "<option>Aucun rôle trouvé</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
                <a href="utilisateurs.php" class="btn btn-secondary">Annuler</a>
            </form>
        </div>

    <?php
    } else {
        echo "Aucun utilisateur trouvé avec cet ID.";
    }
} else {
    echo "ID d'utilisateur non spécifié.";
}

include('./includes/scripts.php');
include('./includes/footer.php');
?>
