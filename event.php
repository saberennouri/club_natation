<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <meta name = "format-detection" content = "telephone=no" />
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <link rel="stylesheet" href="css/bootstrap.css" >
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fonts/font-awesome.css">
    <link rel="stylesheet" href="css/camera.css">
    <link rel="stylesheet" href="css/touchTouch.css">
    
	<script src="js/jquery.js"></script>
    <script src="js/jquery-migrate-1.2.1.js"></script>
    <script  src="js/touchTouch.jquery.js"></script>
    <script src="js/superfish.js"></script>
    <script src="js/jquery.mobilemenu.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.ui.totop.js"></script>
    <script src="js/jquery.touchSwipe.min.js"></script>
    <script src="js/jquery.equalheights.js"></script>
    
    <script src='js/camera.js'></script>
    <!--[if (gt IE 9)|!(IE)]><!-->
        <script src="js/jquery.mobile.customized.min.js"></script>
    <!--<![endif]-->
    
    <script>	
        $(window).load( function(){	
            
    	   jQuery('.camera_wrap').camera();	 
        
            // Initialize the gallery
            $('.thumb').touchTouch();
           	 
        });
    </script>
    
      <!--[if lt IE 9]>
        <div style='text-align:center'><a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div>  
      <![endif]-->
      <!--[if lt IE 9]><script src="../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    
      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
  
</head>

<body>
<!--==============================header=================================-->
<header id="header" class="pagesheader">
    <hr>
    <article class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h1 class="navbar-brand navbar-brand_"><a href="index.html"><img alt="SATlO" src="img/logo.png"></a></h1> 
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <p class="headeraddress1">
                    <a href="#">
                        <img src="img/page1_icon1.png" alt=""> 
                        <span>Devenir Membre</span>
                    </a>
                </p> 
            </div>
        </div>
    </article>
    <article class="container">
        <div class="menuheader">
        <div class="menuheader">
            <nav class="navbar navbar-default navbar-static-top tm_navbar" role="navigation">
                <ul class="nav sf-menu">
                  <li><a href="index.html">Home</a></li>
                  
                  <li class="active"><a href="#">Club<em class="indicator1"></em></a>
                    <ul>
                      <li><a href="index-1.html">Apropos</a></li>
                      <li><a class="last" href="commite.php">Commités</a></li>
                      <li><a class="last" href="event.php">Evenements</a></li>
                      <li><a href="index-2.html">Entraineurs</a></li>
                      <li><a class="last" href="parents.php">Espace parent</a></li>
                    </ul>
                  </li>
                  <li><a href="resultat.php">Résultats</a></li>
                  <li><a href="index-3.html">Munimas</a></li>
                  <li class="last"><a href="index-4.html">Contacts</a></li>
                </ul>
            </nav>
        </div>
        </div>
    </article>
  </header>
<body>

<div class="container mt-5">
    <h2>Liste des Événements</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Date</th>
                <th>Lieu</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
           require_once 'config.php';

        // Requête SQL pour sélectionner les données des événements
        $sql = "SELECT * FROM evenements";
        $result = $conn->query($sql);

        // Vérifier s'il y a des résultats
        if ($result->num_rows > 0) {
            // Afficher les données des événements dans une boucle
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nom"] . "</td>";
                echo "<td>" . $row["date_evenement"] . "</td>";
                echo "<td>" . $row["lieu"] . "</td>";
                
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Aucun événement trouvé.</td></tr>";
        }
        // Fermer la connexion à la base de données
        $conn->close();
        ?>
        </tbody>
    </table>
</div>


<!--==============================footer=================================-->
<footer>
    <section class="footerrow1">
        <div class="container">
            <div class="row">
                <article class="col-lg-3 col-md-4 col-sm-6 col-xs-6 colfooterrow1">
                    <p class="footeraddress1"><img src="img/footericon1.png" alt=""> <span>Sfax swimming club SSC<br>Route Manzel Chaker<br>Sfax,klm 9 avant la rocade à droite</span></p>
                
                </article>
                <article class="col-lg-offset-1 col-lg-3 col-md-4 col-sm-6 col-xs-6 colfooterrow1">
                    <p class="footeraddress2"><img src="img/footericon2.png" alt=""> <span>Telephone: +216 97 618 929</span><br>E-mail:<a href="#"> walid.bahri@gmail.com</a></p>
                </article>
                <article class="col-lg-offset-1 col-lg-4 col-md-4 col-sm-12 col-xs-12 colfooterrow1">
                    <p class="footerpriv"><a href="index.html">SSC </a> &copy; <span id="copyright-year"></span> <img src="img/linefooter.jpg" alt=""> <strong><a class="privacylink" href="index-5.html">Privacy Policy</a></strong></p>
                    <ul class="social2 clearfix">
                         <li><a href="https://www.facebook.com/clubelmajdnation"><img src="img/social_icon1.png" alt=""></a></li>
                         
                    </ul> 
               </article>
            </div>
        </div>
    </section>
</footer>
<script src="js/bootstrap.min.js"></script>
<script src="js/tm-scripts.js"></script>
<!-- Ajouter les liens vers les fichiers JavaScript de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>