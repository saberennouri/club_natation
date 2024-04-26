<?php
include('./includes/header.php');
include('./includes/navbar.php');
include 'config.php';

// Vérifier si l'ID du competition est passé en paramètre
if(isset($_GET['id'])) {
    $competition_id = $_GET['id'];

    // Requête pour récupérer les détails du competition
    $query = "SELECT * FROM competitions WHERE competition_id = $competition_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Vérifier si le formulaire de mise à jour a été soumis
        if(isset($_POST['modifier'])) {
            $nom = $_POST['nom'];
            $date = $_POST['date_lieu'];
            $lieu = $_POST['lieu'];
            
           

            // Requête pour mettre à jour les informations d'competition
            $update_query = " UPDATE competitions SET
             nom='$nom',date_debut='$date',lieu='$lieu',Description='$description'
             WHERE competition_id='$competition_id'";
            $update_result = mysqli_query($conn, $update_query);
           
            if(!$update_result) {
                die("Erreur de mise à jour d'competition: " . mysqli_error($conn));
            }
           echo "<script>window.location.href='competitions.php'</script>";
        }
?>

<div class="container mt-5">
        <h2 class="mb-4">Modifier un competition</h2>
        <form method="post">           
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $row['nom']?>">
            </div>
            <div class="form-group">
                <label for="date_competition">Date competition :</label>
                <input type="date" class="form-control" id="date_competition" name="date_competition" value="<?php echo $row['date_debut']; ?>">
            </div>
            <div class="form-group">
                <label for="lieu">Lieu :</label>
                <input type="text" class="form-control" id="lieu" name="lieu" value="<?php echo $row['lieu']?>">
            </div>                      
            <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
            <a href="competitions.php" class="btn btn-secondary">Annuler</a>
        </form>

<?php
    } else {
        echo "Aucun competition trouvé avec cet ID.";
    }
} else {
    echo "ID d'competition non spécifié.";
}

include('./includes/scripts.php');
include('./includes/footer.php');
?>
