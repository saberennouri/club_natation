<?php
include('./includes/header.php');
include('./includes/navbar.php');
include 'config.php';

// Vérifier si l'ID du entraineur est passé en paramètre
if(isset($_GET['id'])) {
    $coach_id = $_GET['id'];

    // Requête pour récupérer les détails du entraineur
    $query = "SELECT * FROM entraineurs WHERE entraineur_id = $coach_id";
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
          

            // Requête pour mettre à jour les informations d'entraineur
            $update_query = "UPDATE entraineurs SET prenom='$prenom', nom='$nom', email='$email', 
            numero_telephone='$numero_telephone'  WHERE entraineur_id='$coach_id'";
            $update_result = mysqli_query($conn, $update_query);
           
            if(!$update_result) {
                die("Erreur de mise à jour d'entraineur: " . mysqli_error($conn));
            }
           echo "<script>window.location.href='coachs.php'</script>";
        }
?>

<div class="container mt-5">
        <h2 class="mb-4">Modifier un Entraineur</h2>
        <form method="post">
        <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $row['prenom']?>">
            </div>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $row['nom']?>">
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']?>">
            </div>
            <div class="form-group">
                <label for="numero_telephone">Numéro de Téléphone :</label>
                <input type="text" class="form-control" id="numero_telephone" name="numero_telephone" value="<?php echo $row['numero_telephone']?>">
            </div>
          
           
            <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
            <a href="coachs.php" class="btn btn-secondary">Annuler</a>
        </form>

<?php
    } else {
        echo "Aucun entraineur trouvé avec cet ID.";
    }
} else {
    echo "ID d'entraineur non spécifié.";
}

include('./includes/scripts.php');
include('./includes/footer.php');
?>
