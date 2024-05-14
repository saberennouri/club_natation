
<?php 
include('includes/header.php'); 
include('includes/navbar.php');
include 'config.php';

// Vérifier si l'ID de la session est passé en paramètre
if(isset($_GET['id'])) {
    $session_id = $_GET['id'];

    // Requête pour récupérer les détails de la session
    $query = "SELECT * FROM sessionsentrainement WHERE session_id = $session_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Vérifier si le formulaire de suppression a été soumis
        if(isset($_POST['supprimer'])) {
            // Requête pour supprimer la session
            $delete_query = "DELETE FROM sessionsentrainement WHERE session_id=$session_id";
            $delete_result = mysqli_query($conn, $delete_query);
            if(!$delete_result) {
                die("Erreur de suppression de la session: " . mysqli_error($conn));
            }
            header("Location: sessions.php");
            exit(); // Terminer le script après la redirection
        }
?>

<div class="container mt-5">
    <h2 class="mb-4">Supprimer la session</h2>
    <div class="card">
        <div class="card-body">
            <p>Êtes-vous sûr de vouloir supprimer cette session?</p>
            <p><strong>Date de la session:</strong> <?php echo $row['date']; ?></p>
            <p><strong>Équipe:</strong> <?php echo getNomEquipe($conn, $row['equipe_id']); ?></p>
           
            <form method="POST">
                <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                <a href="sessions.php" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>

<?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>
<?php
    } else {
        echo "Aucune session trouvée avec cet ID.";
    }
} else {
    echo "ID de la session non spécifié.";
}

// Fonction pour récupérer le nom de l'équipe à partir de son ID
function getNomEquipe($conn, $equipe_id) {
    $query = "SELECT nom FROM equipe WHERE id_equipe = $equipe_id";
    $result = mysqli_query($conn, $query);
    if($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['nom'];
    } else {
        return "Nom d'équipe non valide";
    }
}
?>
