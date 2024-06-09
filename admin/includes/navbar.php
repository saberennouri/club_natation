<?php
session_start();

?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->


    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->

    <!-- Sidebar  modifier 26-05-2024 -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">USS</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="admin_dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Admin_Panel</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Administration</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">USS composantes:</h6>
                    <!-- Add your menu items here -->
                    <a class="collapse-item" href="utilisateurs.php">Utilisateurs</a>
                    <a class="collapse-item" href="performances.php">Performances</a>
                    <a class="collapse-item" href="evenements.php">Evenements</a>
                    <a class="collapse-item" href="competitions.php">Compétitions</a>
                    <a class="collapse-item" href="commites.php">Commités</a>
                    <a href="heures.php" class="collapse-item">Heures_Entrainements</a>
                    <a class="collapse-item" href="sessions.php">Session_entrainement</a>
                    <a class="collapse-item" href="paiements.php">Paiements</a>
                </div>
            </div>
        </li>

        <!-- Other navigation items -->
        <li class="nav-item">
            <a class="nav-link" href="parents.php">
                <i class="fas fa-fw fa-users"></i>
                <span>Gestion des parents</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="athletes.php">
                <i class="fas fa-fw fa-users"></i>
                <span>Gestion des athlètes</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="coachs.php">
                <i class="fas fa-fw fa-users"></i>
                <span>Gestion des entraineurs</span></a>
        </li>


        <!-- Nav Item - Equipes Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEquipes" aria-expanded="true" aria-controls="collapseEquipes">
                <i class="fas fa-fw fa-users"></i>
                <span>Equipes</span>
            </a>
            <div id="collapseEquipes" class="collapse" aria-labelledby="headingEquipes" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gérer équipe:</h6>
                    <!-- Add your menu items here -->
                    <a class="collapse-item" href="equipe.php">Liste des équipe</a>
                    <a class="collapse-item" href="athleteEquipe.php">listes des athlètes par équipe</a>
                    <a class="collapse-item" href="affiliations.php">Affiliation athlète</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Paramètres Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseParametres" aria-expanded="true" aria-controls="collapseParametres">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Paramètres</span>
            </a>
            <div id="collapseParametres" class="collapse" aria-labelledby="headingParametres" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gérer Profile:</h6>
                    <?php
                    include './config.php';
                    $email = $_SESSION['email_admin'];
                    $sql = "select * from utilisateurs where email='$email'";
                    $result = mysqli_query($conn, $sql);
                    $row = $result->fetch_assoc();
                    // echo $row['utilisateur_id'];              


                    ?>
                    <a class="collapse-item" href="updateUser.php?id=<?php echo $row['utilisateur_id'] ?>">Modifier Profile</a>
                    <a class="collapse-item" href="changePassword.php?id=<?php echo $row['utilisateur_id'] ?>">changer Password</a>
                    <a class="collapse-item" href="package.php">Packages</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <!-- Add your topbar content here -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <!-- Add your footer content here -->

    </div>
    <!-- End of Content Wrapper -->





    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">

        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Géer Profile:</h6>
                <?php
                include './config.php';
                $email = $_SESSION['email_admin'];
                $sql = "select * from utilisateurs where email='$email'";
                $result = mysqli_query($conn, $sql);
                $row = $result->fetch_assoc();
                // echo $row['utilisateur_id'];              


                ?>




                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>




            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">

                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>


                <?php

                // Function to retrieve notifications for the current user
                function getNotifications($userId, $conn)
                {
                    $notifications = array();
                    $query = "SELECT * FROM notifications WHERE utilisateur_id = ? ORDER BY timestamp DESC";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $userId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        $notifications[] = $row;
                    }
                    $stmt->close();
                    return $notifications;
                }

                // Function to retrieve messages for the current user
                function getMessages($userId, $conn)
                {
                    $messages = array();
                    $query = "SELECT * FROM messages WHERE utilisateur_id = ? ORDER BY timestamp DESC";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $userId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        $messages[] = $row;
                    }
                    $stmt->close();
                    return $messages;
                }

                // Get the current user ID (you may need to modify this based on your authentication method)
                $userId = 1;

                // Retrieve notifications and messages for the current user
                $notifications = getNotifications($userId, $conn);
                $messages = getMessages($userId, $conn);
                ?>


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>

                        <?php
                        // Récupération du prénom et du nom administrateur
                        $email = $_SESSION['email_admin'];
                   
                        $query = "SELECT * FROM utilisateurs WHERE email='$email'";
                        $res = mysqli_query($conn, $query);
                        if (mysqli_num_rows($res) > 0) {
                            $row = mysqli_fetch_assoc($res);
                            echo $row['nom'];
                            //echo $row['utilisateur_id'];

                        }
                        ?>

                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                        <a class="dropdown-item" href="updateUser.php?id='<?php echo $row['utilisateur_id']; ?>'">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="log.php">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                       
                        <a class="dropdown-item" href="logout.php">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->