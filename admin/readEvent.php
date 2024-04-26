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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du evenement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Détails du evenement</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nom Complet: <?php echo  $row['nom']; ?></h5>
                <p class="card-text">Date: <?php echo $row['date_evenement']; ?></p>
                <p class="card-text">Lieu: <?php echo $row['lieu']; ?></p>
                <a href="evenements.php" class="btn btn-primary">Retour</a>
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
