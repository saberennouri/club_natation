<?php
include 'config.php';

// Vérifier si l'ID du parent est passé en paramètre
if(isset($_GET['id'])) {
    $adhesion_id = $_GET['id'];

    // Requête pour récupérer les détails du parent
    $query = "SELECT adhesion.*, athletes.*
    FROM adhesion
    INNER JOIN athletes ON adhesion.athlete_id = athletes.athlete_id
    WHERE adhesion.adhesion_id = $adhesion_id
    ";
    $result = mysqli_query($conn, $query);
    $row1 = mysqli_fetch_assoc($result);
    //var_dump($row1);
    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
         //var_dump($row);
        // Vérifier si le formulaire de suppression a été soumis
        if(isset($_POST['supprimer'])) {
            // Requête pour supprimer le parent
            $delete_query = "DELETE FROM adhesion WHERE adhesion_id='$adhesion_id'";
            $delete_result = mysqli_query($conn, $delete_query);
            if(!$delete_result) {
                die("Erreur de suppression d'\athlète: " . mysqli_error($conn));
            }
            header("Location: adhesions.php");
        }
?>
<?php include('includes/header.php'); 
include('includes/navbar.php');  ?>
    <div class="container mt-5">
        <h2 class="mb-4">Supprimer l'athlète</h2>
        <div class="card">
            <div class="card-body">
                <p>Êtes-vous sûr de vouloir supprimer cet athlète?</p>
                <p><strong>Nom:</strong> <?php echo $row1['prenom'] . ' ' . $row1['nom']; ?></p>
                
                <p><strong>Date du naissance:</strong> <?php echo $row1['date_naissance']; ?></p>
                <form method="POST">
                    <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                    <a href="adhesions.php" class="btn btn-secondary">Annuler</a>
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
