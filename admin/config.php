<?php

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "club");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}
