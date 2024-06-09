<?php
include('./includes/header.php');
include('./includes/navbar.php');
include 'config.php';

// Vérifier si l'ID du evenement est passé en paramètre
if(isset($_GET['id'])) {
    $evenement_id = $_GET['id'];

    // Requête pour récupérer les détails du evenement
    $query = "SELECT * FROM evenements WHERE evenement_id = $evenement_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Vérifier si le formulaire de mise à jour a été soumis
        if(isset($_POST['modifier'])) {
            $nom = $_POST['nom'];
            $date = $_POST['date_evenement'];
            $lieu = $_POST['lieu'];
            $heuredebut= $_POST['heuredebut'];
            $heurefin=$_POST['heurefin'];
           

            // Requête pour mettre à jour les informations d'evenement
            $update_query = "UPDATE evenements SET nom='$nom',date_evenement='$date',lieu='$lieu',heure_debut='$heuredebut',heure_fin='$heurefin'
             WHERE evenement_id='$evenement_id'";
            $update_result = mysqli_query($conn, $update_query);
           
            if(!$update_result) {
                die("Erreur de mise à jour d'evenement: " . mysqli_error($conn));
            }
           echo "<script>window.location.href='evenements.php'</script>";
        }
?>

<div class="container mt-5">
        <h2 class="mb-4">Modifier un evenement</h2>
        <form method="post">           
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $row['nom']?>">
            </div>
            <div class="form-group">
                <label for="date_evenement">Date evenement :</label>
                <input type="date" class="form-control" id="date_evenement" name="date_evenement" value="<?php echo $row['date_evenement']?>">
            </div>
            <div class="form-group">
                <label for="motdepasse">Lieu :</label>
                <input type="text" class="form-control" id="lieu" name="lieu" value="<?php echo $row['lieu']?>">
            </div>
            <div class="form-group">
                <label for="heuredebut">Heure Début :</label>
                <input type="time" name="heuredebut" id="heuredebut" value="<?php echo $row['heure_debut']?>">
            
                <label for="heurefin">Heure Fin :</label>
                <input type="time" name="heurefin" id="heurefin" value="<?php echo $row['heure_fin']?>">
            </div>  
           
            <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
            <a href="evenements.php" class="btn btn-secondary">Annuler</a>
        </form>

<?php
    } else {
        echo "Aucun evenement trouvé avec cet ID.";
    }
} else {
    echo "ID d'evenement non spécifié.";
}

include('./includes/scripts.php');
include('./includes/footer.php');
?>
