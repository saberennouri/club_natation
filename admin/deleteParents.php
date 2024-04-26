<?php
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

        // Vérifier si le formulaire de suppression a été soumis
        if(isset($_POST['supprimer'])) {
            // Requête pour supprimer le parent
            $delete_query = "DELETE FROM Parents WHERE parent_id='$parent_id'";
            $delete_result = mysqli_query($conn, $delete_query);
            if(!$delete_result) {
                die("Erreur de suppression du parent: " . mysqli_error($conn));
            }
            header("Location: parents.php");
        }
?>
<?php 
    include('includes/header.php'); 
    include('includes/navbar.php');
  ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer le Parent</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Supprimer le Parent</h2>
        <div class="card">
            <div class="card-body">
                <p>Êtes-vous sûr de vouloir supprimer ce parent?</p>
                <p><strong>Nom:</strong> <?php echo $row['prenom'] . ' ' . $row['nom']; ?></p>
                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                <p><strong>Numéro de Téléphone:</strong> <?php echo $row['numero_telephone']; ?></p>
                <form method="POST">
                    <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                    <a href="parents.php" class="btn btn-secondary">Annuler</a>
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
