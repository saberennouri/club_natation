<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="btn btn-outline-primary" href="parent_dashboard.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <p style="margin-right: 2px;" class="btn btn-outline-success">
                            <?php
                            // Récupération du prénom et du nom du parent
                            $email = $_SESSION['email_parent'];
                           //echo $email;
                            $parent_query = "SELECT * FROM utilisateurs WHERE email='$email'";
                            $resParent = mysqli_query($conn, $parent_query);
                            if (mysqli_num_rows($resParent) > 0) {
                                $rowParent = mysqli_fetch_assoc($resParent);
                                echo $rowParent['nom'];
                            }
                            ?>
                        </p>
                    </li>
                    <li class="nav-item">
                        <form method="post" action="logout.php">
                            <button type="submit" name="logout" class="btn btn-outline-danger">Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>