<?php

include('./includes/header.php');
include('./includes/navbar.php');
include 'config.php';

// Vérifier si l'ID du parent est passé en paramètre
if(isset($_GET['id'])) {
    $parent_id = $_GET['id'];

    // Requête pour récupérer les détails du parent
    $query = "SELECT * FROM Parents WHERE parent_id = $parent_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Vérifier si le formulaire de mise à jour a été soumis
        if(isset($_POST['modifier'])) {
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $numero_telephone = $_POST['numero_telephone'];

            // Requête pour mettre à jour les informations du parent
            $update_query = "UPDATE Parents SET prenom='$prenom', nom='$nom', email='$email', numero_telephone='$numero_telephone'
             WHERE parent_id='$parent_id'";
            $update_result = mysqli_query($conn, $update_query);
            if(!$update_result) {
                die("Erreur de mise à jour du parent: " . mysqli_error($conn));
            }
            echo "<script>window.location.href='parents.php'</script>";
        }
        
        ?>
    <div class="container mt-5">
        <h2 class="mb-4">Modifier le Parent</h2>
        <form method="POST">
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" class="form-control" value="<?php echo $row['prenom']; ?>">
            </div>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $row['nom']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $row['email']; ?>">
            </div>
            <div class="form-group">
                <label for="numero_telephone">Numéro de Téléphone :</label>
                <input type="text" name="numero_telephone" id="numero_telephone" class="form-control" value="<?php echo $row['numero_telephone']; ?>">
            </div>
            <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
            <a href="parents.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>

<?php
    } else {
        echo "Aucun parent trouvé avec cet ID.";
    }
} else {
    echo "ID du parent non spécifié.";
}

include('./includes/scripts.php');
include('./includes/footer.php');
?>
