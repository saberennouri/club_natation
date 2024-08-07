<?php
//session_start();
include('./includes/navTrainer.php');
include('./includes/header.php');

include 'config.php';

// Vérifier si l'email de l'entraîneur est défini en session
if (isset($_SESSION['email_entraineur'])) {
    $email_entraineur = $_SESSION['email_entraineur'];

    // Requête pour récupérer les détails de l'entraîneur
    $query = "SELECT * FROM entraineurs WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email_entraineur);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si la requête a retourné des résultats
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the trainer details
        //echo $row['numero_telephone'];
    } else {
        echo "Aucun entraîneur trouvé avec cet email.";
        exit; // Arrêter l'exécution si aucun entraîneur n'est trouvé
    }
} else {
    header("Location: login.php");
    exit; // Rediriger vers la page de connexion si l'entraîneur n'est pas connecté
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Profil de l'Entraîneur</h2>
    <form method="post">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($row['nom']); ?>" >
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($row['prenom']); ?>" >
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" >
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone :</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo htmlspecialchars($row['numero_telephone']); ?>" >
        </div>

        <!-- Ajoutez d'autres champs selon les besoins -->

        <a href="modifier_profil.php?id=<?php echo $row['entraineur_id']; ?>" class="btn btn-primary">Modifier Profil</a>
    </form>
<?php
include('./includes/scripts.php');
include('./includes/footer.php');
?>
</div>

