<?php 
session_start();
include './config.php';

// Récupération des informations de l'entraîneur
$entr = "SELECT * FROM entraineurs";
$query_entr = mysqli_query($conn, $entr);
$res_entr = mysqli_fetch_assoc($query_entr);

if ($res_entr) {
    $entraineur_id = $res_entr['entraineur_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord de l'entraîneur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../home.php">Dashboard Entraineur</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="takedate.php">Ajouter RDV</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="liste_rdv.php">Lister RDV</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo htmlspecialchars($res_entr['nom']); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="editprofile.php?id=<?php echo urlencode($res_entr['entraineur_id']); ?>">Modifier Profile</a>
                    <a class="dropdown-item" href="logout.php">Déconnexion</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2>Bienvenue sur votre tableau de bord</h2>
    <div class="col-md-6">
        <h3>Vos athlètes</h3>
        <form method="POST">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom de l'athlète</th>
                        <th>Absent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Récupération des athlètes de l'entraîneur
                    $sql = "SELECT * FROM athletes WHERE entraineur_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $entraineur_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($athlete = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($athlete['nom']) . "</td>";
                            echo "<td><input type='checkbox' name='absent[" . htmlspecialchars($athlete['athlete_id']) . "]'></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>Aucun athlète n'est attribué à cet entraîneur.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Enregistrer les absences</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
} else {
    // Afficher un message si aucun entraîneur n'est trouvé
    echo "Aucun entraîneur trouvé.";
}
?>
