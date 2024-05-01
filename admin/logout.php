<?php
// Initialiser la session
session_start();

session_unset() ;
// Détruire la session
session_destroy();

// Rediriger vers la page de connexion
header("location: index.php");
exit;

