<?php
include 'config.php';

// Vérifier si l'ID du adhesion est passé en paramètre
if(isset($_GET['id'])) {
    $adhesion_id = $_GET['id'];

    // Requête pour récupérer les détails du adhesion
    $query = "SELECT * FROM adhesion WHERE adhesion_id = $adhesion_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Vérifier si le formulaire de suppression a été soumis
        if(isset($_POST['supprimer'])) {
            // Requête pour supprimer le adhesion
            $delete_query = "DELETE FROM adhesion WHERE adhesion_id='$adhesion_id'";
            $delete_result = mysqli_query($conn, $delete_query);
            if(!$delete_result) {
                die("Erreur de suppression du adhesion: " . mysqli_error($conn));
            }
            header("Location: adhesions.php");
        }
?>
<?php 
    include('includes/header.php'); 
    include('includes/navbar.php');
  ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer le adhesion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Supprimer l'adhesion</h2>
        <div class="card">
            <div class="card-body">
                <p>Êtes-vous sûr de vouloir supprimer ce adhesion?</p>                
                <p class="card-text">Date: <?php echo $row["date_debut"]; ?></p>
                <p class="card-text">Lieu: <?php echo $row["date_fin"]; ?></p>
                <p class="card-text">Status: <?php echo $row["statut"]; ?></p>
               
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
        echo "Aucun adhesion trouvé avec cet ID.";
    }
} else {
    echo "ID du adhesion non spécifié.";
}


include('includes/scripts.php'); 
include('includes/footer.php'); 

?>
