<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<!-- Begin Page Content -->
<div class="container">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">USS</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a>
  </div>

  <!-- Notification for user added -->
  <?php if (isset($_GET['user_added']) && $_GET['user_added'] == 'true') { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      User added successfully!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php } ?>

  <!-- Content Row -->
  <div class="row">

    <!-- Total Registered User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered User</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <h4><a href="utilisateurs.php">Total User:</a>
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
                    echo $totalUsers;
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

    <!-- Total Registered Parents Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Parents</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <h4><a href="parents.php">Total Parents:</a>
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
                    echo $totalParents;
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

    <!-- Total Registered Athletes Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Athletes</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <h4><a href="athletes.php">Total Athlete:</a>
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
                    echo $totalAthletes;
                  } else {
                    echo "No registered athletes found.";
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

    <!-- Total Registered Entraineurs Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Entraineurs</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <h4><a href="coachs.php">Total Entraineurs:</a>
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
                    echo $totalEntraineur;
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

    <!-- Paiement (Annuel) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Paiement (Annuel)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <h4>Total Paiement: 
                  <?php
                  // Include the database connection file
                  include 'config.php';

                  // Initialiser la somme totale des paiements à zéro
                  $totalPaiement = 0;

                  // Requête SQL pour sélectionner tous les paiements
                  $sql = "SELECT montant FROM paiements";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    // Parcourir chaque paiement et accumuler les montants
                    while ($row = $result->fetch_assoc()) {
                      $montant = $row['montant'];
                      $totalPaiement += $montant;
                    }

                    // Afficher la somme totale des paiements
                    echo $totalPaiement;
                  } else {
                    echo "Aucun paiement enregistré.";
                  }

                  // Fermer la connexion à la base de données
                  $conn->close();
                  ?>
                </h4>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tasks Card Example -->
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

  <?php
  include('includes/scripts.php');
  include('includes/footer.php');
  ?>
</div>
v