<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du competition</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Détails du competition</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nom Complet: <?php echo  $row['nom']; ?></h5>
                <p class="card-text">Date: <?php echo $row['date_debut']; ?></p>
                <p class="card-text">Lieu: <?php echo $row['lieu']; ?></p>
                <a href="competitions.php" class="btn btn-primary">Retour</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        echo "Aucun competition trouvé avec cet ID.";
    }
} else {
    echo "ID du competition non spécifié.";
}
include('includes/scripts.php'); 
include('includes/footer.php'); 

?>
