<?php
include 'config.php';

// Vérifier si l'ID du parent est passé en paramètre
if(isset($_GET['id'])) {
    $athlete_id = $_GET['id'];

    // Requête pour récupérer les détails du parent
    $query = "SELECT * FROM athletes WHERE athlete_id = $athlete_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Vérifier si le formulaire de suppression a été soumis
        if(isset($_POST['supprimer'])) {
            // Requête pour supprimer le parent
            $delete_query = "DELETE FROM athletes WHERE athlete_id='$athlete_id'";
            $delete_result = mysqli_query($conn, $delete_query);
            if(!$delete_result) {
                die("Erreur de suppression d'\athlète: " . mysqli_error($conn));
            }
            header("Location: athletes.php");
        }
?>
<?php include('includes/header.php'); 
include('includes/navbar.php');  ?>
    <div class="container mt-5">
        <h2 class="mb-4">Supprimer l'athlète</h2>
        <div class="card">
            <div class="card-body">
                <p>Êtes-vous sûr de vouloir supprimer cet athlète?</p>
                <p><strong>Nom:</strong> <?php echo $row['prenom'] . ' ' . $row['nom']; ?></p>
                
                <p><strong>Date du naissance:</strong> <?php echo $row['date_naissance']; ?></p>
                <form method="POST">
                    <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                    <a href="athletes.php" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        echo "Aucun parent trouvé avec cet ID.";
    }
} else {
    echo "ID du parent non spécifié.";
}
include('includes/scripts.php'); 
include('includes/footer.php'); 

?>
