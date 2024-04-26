<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

include 'config.php';

// Vérifier si l'ID du parent est passé en paramètre
if(isset($_GET['id'])) {
    $coach_id = $_GET['id'];

    // Requête pour récupérer les détails du parent
    $query = "SELECT * FROM entraineurs WHERE entraineur_id = $coach_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
?>

    <div class="container mt-5">
        <h2 class="mb-4">Détails d'entraineur</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nom Complet: <?php echo $row['prenom'] . ' ' . $row['nom']; ?></h5>
                <p class="card-text">Email: <?php echo $row['email']; ?></p>
                <p class="card-text">Télèphone: <?php echo $row['numero_telephone']; ?></p>
                <a href="coachs.php" class="btn btn-primary">Retour</a>
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
