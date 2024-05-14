<?php 
session_start();
include './config.php';


$entr="SELECT * FROM entraineurs";
$query_entr=mysqli_query($conn,$entr);
$res_entr=mysqli_fetch_assoc($query_entr);

if($res_entr) { // Vérifie si l'entraîneur existe
    $entraineur_id=$res_entr['entraineur_id'];
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
  <a class="navbar-brand" href="../home.php">Dashboard Parent</a>
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
     
 
    <form class="form-inline my-2 my-lg-0">
    
    <div class="sl-user__mobile-menu">
      <div class="sl-user__image-wrapper sl-user__image-wrapper--active">
        <img class="sl-user__select__image" src="https://blob.sololearn.com/avatars/c0f5aea3-dde1-46a8-8df0-68fd1de11023.jpg" alt="user-avatar"></div><div class="sl-user-settings__name"><span class="sl-user-settings__name__title">Ennouri Saber</span><p class="sl-user-settings__name__goto"
    >Go to profile</p></div></div>
      <li class="nav-item dropdown right">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php 
          
          $sql="select * from entraineurs";
          $result=mysqli_query($conn,$sql);
          $row=mysqli_fetch_array($result);
          echo $row['nom']; 
          //echo $row['entraineur_id'];?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="editprofile.php?id='<?php echo $row['entraineur_id'];?>'">Modifier Profile</a>
          <a class="dropdown-item" href="logout.php">Déconnexion</a>
          
        </div>
      </li>
      
    </ul>
      
    </form>
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
                                <!-- Ajoutez d'autres en-têtes de colonnes si nécessaire -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Exemple de récupération des athlètes de l'entraîneur à partir de la base de données
                            $sql = "SELECT * FROM athletes WHERE entraineur_id = $entraineur_id";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($athlete = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $athlete['nom'] . "</td>";
                                    echo "<td><input type='checkbox' name='absent[" . $athlete['athlete_id'] . "]'></td>";
                                    // Ajoutez d'autres cellules de données si nécessaire
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
    </div>
</body>
</html>

<?php 
} else {
    // Afficher un message si aucun entraîneur n'est trouvé
    echo "Aucun entraîneur trouvé.";
}
?>
