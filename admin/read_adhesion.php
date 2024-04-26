<?php
// Inclure les fichiers d'en-tête et de navigation
include('includes/header.php');
include('includes/navbar.php');
include('config.php');
$adhesion_id=$_GET['id'];
$sql = "SELECT * FROM adhesion WHERE adhesion_id = $adhesion_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);?>
             <div class="container mt-5">
        <h2 class="mb-4">Détails d'adhésion</h2>
        <div class="card">
            <div class="card-body">                
                <p class="card-text">Date: <?php echo $row["date_debut"]; ?></p>
                <p class="card-text">Lieu: <?php echo $row["date_fin"]; ?></p>
                <p class="card-text">Status: <?php echo $row["statut"]; ?></p>
                <a href="adhesions.php" class="btn btn-primary">Retour</a>
            </div>
        </div>
    </div>
          
        <?php } else {
            echo "Aucune adhésion trouvée avec cet ID.";
    }
include './includes/scripts.php';
include './includes/footer.php';
?>