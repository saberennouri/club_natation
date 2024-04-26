<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

include 'config.php';

// Vérifier si l'ID du session est passé en paramètre
if(isset($_GET['id'])) {
    $session_id = $_GET['id'];

    // Requête pour récupérer les détails du session
    $query = "SELECT * FROM sessionsentrainement WHERE session_id = $session_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
?>

    <div class="container mt-5">
        <h2 class="mb-4">Détails du session</h2>
        <div class="card">
            <div class="card-body">
                
                <p class="card-text">Date: <?php echo $row['date']; ?></p>
                <p class="card-text">Lieu: <?php echo $row['lieu']; ?></p>
                <a href="sessions.php" class="btn btn-primary">Retour</a>
            </div>
        </div>
    </div>

<?php
    } else {
        echo "Aucun session trouvé avec cet ID.";
    }
} else {
    echo "ID du session non spécifié.";
}
include('includes/scripts.php'); 
include('includes/footer.php'); 

?>
