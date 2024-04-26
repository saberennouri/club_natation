<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Parent</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Détails du Parent</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nom Complet: <?php echo $row['prenom'] . ' ' . $row['nom']; ?></h5>
                <p class="card-text">Email: <?php echo $row['email']; ?></p>
                <p class="card-text">Numéro de Téléphone: <?php echo $row['numero_telephone']; ?></p>
                <a href="parents.php" class="btn btn-primary">Retour</a>
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
