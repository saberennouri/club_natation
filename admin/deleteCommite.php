<?php
include 'config.php';

// Vérifier si l'ID du comite est passé en paramètre
if(isset($_GET['id'])) {
    $comite_id = $_GET['id'];

    // Requête pour récupérer les détails du comite
    $query = "SELECT * FROM comites WHERE comite_id = $comite_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Vérifier si le formulaire de suppression a été soumis
        if(isset($_POST['supprimer'])) {
            // Requête pour supprimer le comite
            $delete_query = "DELETE FROM comites WHERE comite_id='$comite_id'";
            $delete_result = mysqli_query($conn, $delete_query);
            if(!$delete_result) {
                die("Erreur de suppression d'\comite: " . mysqli_error($conn));
            }
            header("Location: comites.php");
        }
?>
<?php include('includes/header.php'); 
include('includes/navbar.php');  ?>
    <div class="container mt-5">
        <h2 class="mb-4">Supprimer l'comite</h2>
        <div class="card">
            <div class="card-body">
                <p>Êtes-vous sûr de vouloir supprimer cet comite?</p>
                <h5 class="card-title">Nom : <?php echo  $row['nom']; ?></h5>
                <p class="card-text">Description: <?php echo $row['description']; ?></p>
                
                
                <form method="POST">
                    <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                    <a href="commites.php" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>

<?php
    } else {
        echo "Aucun comite trouvé avec cet ID.";
    }
} else {
    echo "ID du comite non spécifié.";
}
include('includes/scripts.php'); 
include('includes/footer.php'); 

?>
