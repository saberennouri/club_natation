<?php
include 'config.php';
include './includes/header.php';
include './includes/navbar.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM packages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $package = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $duree = $_POST['duree'];
    $prix = $_POST['prix'];

    $sql = "UPDATE packages SET nom = ?, duree = ?, prix = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sidi", $nom, $duree, $prix, $id);

    if ($stmt->execute()) {
        echo "<script>window.location.href='package.php'</script>";
        
    } else {
        echo "Erreur: " . $stmt->error;
    }
}
?>


<div class="container mt-5">
    <h1 class="text-center">Modifier un Package</h1>
    <form action="" method="POST" class="mt-4">
        <input type="hidden" name="id" value="<?php echo $package['id']; ?>">
        <div class="form-group">
            <label for="nom">Nom du Package</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $package['nom']; ?>" required>
        </div>
        <div class="form-group">
            <label for="duree">Durée (en mois)</label>
            <input type="number" class="form-control" id="duree" name="duree" value="<?php echo $package['duree']; ?>" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" value="<?php echo $package['prix']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
        <a href="package.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
include './includes/scripts.php';
include './includes/footer.php';
?>
