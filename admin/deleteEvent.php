<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
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

        // Vérifier si le formulaire de suppression a été soumis
        if(isset($_POST['supprimer'])) {
            // Requête pour supprimer le evenement
            $delete_query = "DELETE FROM evenements WHERE evenement_id='$evenement_id'";
            $delete_result = mysqli_query($conn, $delete_query);
            if(!$delete_result) {
                die("Erreur de suppression d'\evenement: " . mysqli_error($conn));
            }
            echo "<script>window.location.href='evenements.php'</script>";
        }
?>

    <div class="container mt-5">
        <h2 class="mb-4">Supprimer l'evenement</h2>
        <div class="card">
            <div class="card-body">
                <p>Êtes-vous sûr de vouloir supprimer cet evenement?</p>
                <p><strong>Nom:</strong> <?php echo  $row['nom']; ?></p>                
                <p><strong>date_evenement:</strong> <?php echo $row['date_evenement']; ?></p>
                <p><strong>Lieu:</strong> <?php echo $row['lieu']; ?></p>
                
                <form method="POST">
                    <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                    <a href="evenements.php" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        echo "Aucun evenement trouvé avec cet ID.";
    }
} else {
    echo "ID du evenement non spécifié.";
}
include('includes/scripts.php'); 
include('includes/footer.php'); 

?>
