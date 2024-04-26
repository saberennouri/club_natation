<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include 'config.php';

// Vérifier si l'ID de l'heure est passé en paramètre
if(isset($_GET['id'])) {
    $heure_id = $_GET['id'];

    // Requête pour récupérer les détails de l'heure
    $query = "SELECT * FROM heuresentrainement WHERE heure_id = $heure_id";
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
    <title>Détails de l'heure</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Détails de l'heure</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Heure: <?php echo $row['heure']; ?></h5>
                
                <p class="card-text">Equipe: <?php 
                // Requête pour récupérer le nom de l'équipe associée à cette heure
                $query_equipe = "SELECT nom FROM equipe WHERE id_equipe = " . $row['equipe_id'];
                $result_equipe = mysqli_query($conn, $query_equipe);
                if(mysqli_num_rows($result_equipe) > 0) {
                    $row_equipe = mysqli_fetch_assoc($result_equipe);
                    echo $row_equipe['nom'];
                } else {
                    echo "Nom d'équipe non valide";
                }
                ?></p>
                
                <a href="heures.php" class="btn btn-primary">Retour</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        echo "Aucune heure trouvée avec cet ID.";
    }
} else {
    echo "ID de l'heure non spécifié.";
}
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>
