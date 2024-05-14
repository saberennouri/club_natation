<?php
session_start();
//include "./config.php"; 
//$id=$_SESSION['id']; 
//echo $id;
?>

<!-- Sidebar -->
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
                <a class="collapse-item" href="utilisateurs.php">Utilisateurs</a>
                <a class="collapse-item" href="adhesions.php">Adhésions des athlètes</a>
                <a class="collapse-item" href="evenements.php">Evenements</a>
                <a class="collapse-item" href="competitions.php">Compétitions</a>
                <a class="collapse-item" href="commites.php">Commités</a>
                <a href="heures.php" class="collapse-item">Heures_Entrainements</a>
                <a class="collapse-item" href="sessions.php">Session_entrainement</a>
                <a class="collapse-item" href="equipe.php">Equipe</a>
                <a class="collapse-item" href="paiements.php">Paiements</a>

            </div>
        </div>
    </li>




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



    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Paramètres</span>
        </a>
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
                <a class="collapse-item" href="updateUser.php?id=<?php echo $row['utilisateur_id'] ?>">Modifier Profile</a>
                <a class="collapse-item" href="changePassword.php?id=<?php echo $row['utilisateur_id'] ?>">changer Password</a>

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

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter"><?php echo count($notifications); ?></span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>
                        <?php foreach ($notifications as $notification) : ?>
                            <!-- Notification Item -->
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500"><?php echo $notification['timestamp']; ?></div>
                                    <span class="font-weight-bold"><?php echo $notification['message']; ?></span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter"><?php echo count($messages); ?></span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Message Center
                        </h6>
                        <?php foreach ($messages as $message) : ?>
                            <!-- Message Item -->
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <!-- Include message details here -->
                                <div class="font-weight-bold">
                                    <div class="text-truncate"><?php echo $message['message_content']; ?></div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                    </div>
                </li>


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>

                        <?php
                        // Récupération du prénom et du nom administrateur
                        $email = $_SESSION['email_admin'];
                        //echo $email;
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
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->


        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>


        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        <form action="logout.php" method="POST">

                            <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>

                        </form>


                    </div>
                </div>
            </div>
        </div>