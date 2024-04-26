<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>



<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered User</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

                <h4>Total User:
                  <?php
                  // Include the database connection file
                  include 'config.php';

                  // SQL query to count the number of registered users
                  $sql = "SELECT COUNT(*) AS total_users FROM utilisateurs";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    // Fetch the result as an associative array
                    $row = $result->fetch_assoc();
                    $totalUsers = $row['total_users'];
                    echo  $totalUsers;
                  } else {
                    echo "No registered users found.";
                  }

                  // Close the database connection
                  $conn->close();
                  ?>
                </h4>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Parents</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

                <h4>Total Parents:
                  <?php
                  // Include the database connection file
                  include 'config.php';

                  // SQL query to count the number of registered parents
                  $sql = "SELECT COUNT(*) AS total_parent FROM parents";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    // Fetch the result as an associative array
                    $row = $result->fetch_assoc();
                    $totalParents = $row['total_parent'];
                    echo  $totalParents;
                  } else {
                    echo "No registered parents found.";
                  }

                  // Close the database connection
                  $conn->close();
                  ?>
                </h4>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Athlètes</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

                <h4>Total Athlete:
                  <?php
                  // Include the database connection file
                  include 'config.php';

                  // SQL query to count the number of registered athletes
                  $sql = "SELECT COUNT(*) AS total_athletes FROM athletes";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    // Fetch the result as an associative array
                    $row = $result->fetch_assoc();
                    $totalAthletes = $row['total_athletes'];
                    echo  $totalAthletes;
                  } else {
                    echo "No registered athlètes found.";
                  }

                  // Close the database connection
                  $conn->close();
                  ?>
                </h4>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
 <!-- Earnings (Monthly) Card Example -->
 <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Entraineurs</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

                <h4>Total Entraineurs:
                  <?php
                  // Include the database connection file
                  include 'config.php';

                  // SQL query to count the number of registered entraineurs
                  $sql = "SELECT COUNT(*) AS total_entraineur FROM entraineurs";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    // Fetch the result as an associative array
                    $row = $result->fetch_assoc();
                    $totalEntraineur = $row['total_entraineur'];
                    echo  $totalEntraineur;
                  } else {
                    echo "No registered entraineur found.";
                  }

                  // Close the database connection
                  $conn->close();
                  ?>
                </h4>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->

  <!--- content heures entrainement --->

  <div class="container mt-5">
    <h2 style='text-align:center'>Emploi du temps des séances pour la semaine</h2>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Heure</th>
          <th>Lundi</th>
          <th>Mardi</th>
          <th>Mercredi</th>
          <th>Jeudi</th>
          <th>Vendredi</th>
          <th>Samedi</th>
          <th>Dimanche</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Connexion à la base de données
        include 'config.php';

        // Requête SQL pour récupérer tous les noms d'équipes
        $sqlEquipes = "SELECT * FROM equipe";
        $resultEquipes = $conn->query($sqlEquipes);

        // Tableau pour stocker les noms des équipes
        $equipes = array();

        // Récupérer les noms des équipes
        if ($resultEquipes->num_rows > 0) {
          while ($rowEquipe = $resultEquipes->fetch_assoc()) {
            $equipes[$rowEquipe['id_equipe']] = $rowEquipe['nom'];
          }
        }

        // Date de début de la semaine (lundi)
        $startOfWeek = date('Y-m-d', strtotime('monday this week'));

        // Date de fin de la semaine (dimanche)
        $endOfWeek = date('Y-m-d', strtotime('sunday this week'));

        // Requête SQL pour récupérer les séances d'entraînement de natation pour la semaine avec les détails de l'entraîneur et de l'équipe
        $sql = "SELECT sessionsentrainement.*, heuresentrainement.heure as heure , equipe.nom as nom_equipe,
                    entraineurs.nom as nom_entraineur , entraineurs.prenom as prenom_entraineur              
                    FROM sessionsentrainement
                    INNER JOIN heuresentrainement ON sessionsentrainement.session_id = heuresentrainement.session_id
                    INNER JOIN equipe ON heuresentrainement.equipe_id=equipe.id_equipe
                    INNER JOIN entraineurs ON entraineurs.entraineur_id=sessionsentrainement.entraineur_id
                    WHERE sessionsentrainement.activite = 'Natation'
                    AND sessionsentrainement.date BETWEEN '$startOfWeek' AND '$endOfWeek'
                    ORDER BY sessionsentrainement.date, heuresentrainement.heure";

        $result = $conn->query($sql);

        // Initialisation du tableau pour stocker les séances d'entraînement par jour et par heure
        $emploiDuTemps = array();
        $joursSemaine = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

        // Initialiser le tableau avec des cellules vides pour chaque heure et chaque jour
        for ($heure = 8; $heure <= 20; $heure++) {
          for ($jour = 0; $jour < 7; $jour++) {
            $emploiDuTemps[$heure][$jour] = '';
          }
        }

        // Remplir le tableau avec les séances d'entraînement
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $date = date('N', strtotime($row['date'])); // Récupérer le numéro du jour de la semaine (1 pour lundi, 2 pour mardi, etc.)
            $heure = intval(substr($row['heure'], 0, 2)); // Récupérer l'heure en tant que nombre entier

            // Construire le contenu du popover
            $content = "
                    <b>Date:</b> {$row['date']}<br><b>Entraîneur:</b> {$row['prenom_entraineur']} {$row['nom_entraineur']}
                    <br><b>Lieu:</b> {$row['lieu']}<br>";

            // Ajouter la séance d'entraînement au tableau avec popover
            $emploiDuTemps[$heure][$date - 1] = "<div class='seance' data-toggle='popover' data-placement='top'
                     data-html='true' data-content='$content' style='background-color:green'>" . $row['nom_equipe'] . "</div>
                     ";
          }
        }

        // Afficher le contenu du tableau dans le tableau HTML
        for ($heure = 8; $heure <= 20; $heure++) {
          echo "<tr>";
          echo "<td style='background-color:red; color:black;'><b>$heure:00</b></td>";
          for ($jour = 0; $jour < 7; $jour++) {
            echo "<td >" . $emploiDuTemps[$heure][$jour] . "</td>";
          }
          echo "</tr>";
        }
        ?>

      </tbody>
    </table>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      // Activer les popovers au survol de la classe 'seance'
      $('.seance').popover({
        html: true
      });

      // Cacher les autres popovers lorsqu'on survole une case
      $('.seance').mouseenter(function() {
        // Masquer tous les popovers, sauf celui sur lequel on survole
        $('.seance').not(this).popover('hide');
      });

      // Gestionnaire d'événement pour le bouton de modification
      $(document).on('click', '.btn-primary', function() {
        // Insérez le code pour la modification ici
        console.log('Bouton de modification cliqué');
      });

      // Gestionnaire d'événement pour le bouton de suppression
      $(document).on('click', '.btn-danger', function() {
        // Insérez le code pour la suppression ici
        console.log('Bouton de suppression cliqué');
      });

    });
  </script>

  <!-- end content --->






  <?php
  include('includes/scripts.php');
  include('includes/footer.php');
  ?>