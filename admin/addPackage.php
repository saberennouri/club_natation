<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $duree = $_POST['duree'];
    $prix = $_POST['prix'];

    $sql = "INSERT INTO packages (nom, duree, prix) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sid", $nom, $duree, $prix);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Erreur: " . $stmt->error;
    }
}
?>

<?php
include "./config.php";
include "./includes/header.php";
include "./includes/navbar.php";
?>
<div class="container mt-5">
    <h1 class="text-center">Ajouter un Package</h1>
    <form action="" method="POST" class="mt-4">
        <div class="form-group">
            <label for="nom">Nom du Package</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="duree">Durée (en mois)</label>
            <input type="number" class="form-control" id="duree" name="duree" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="package.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
include "./includes/scripts.php";
include "./includes/footer.php";
?>
