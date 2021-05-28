<?php

session_start();

// Activation des erreurs
ini_set('display_errors', 1);

// Appel des fonctions du contrôleur
include("controleurs/fonctions.php");
// Appel des fonctions liées à l'affichage
include("vues/fonctions.php");

// On identifie le contrôleur à appeler dont le nom est contenu dans cible passé en GET
if(isset($_GET['cible']) && !empty($_GET['cible'])) {
    // Si la variable cible est passé en GET
    $url = $_GET['cible']; //user, sensor, etc.
    
} else {
    // Si aucun contrôleur défini en GET, on bascule sur utilisateurs
    $url = 'utilisateurs';
}

// On appelle le contrôleur
include('controleurs/' . $url . '.php');
