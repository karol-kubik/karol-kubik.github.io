<?php

if (isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['phone']) and isset($_POST['mail']) and isset($_POST['message']))
{
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];
    $contenu = $_POST['message'];
    $subject = "Nouveau message de : $mail";
    $headers = "From : $mail";
    $message = "Un visiteur vous a envoyé un message ! \n\n Nom : $nom \n Prénom : $prenom \n Numéro de téléphone : $phone \n Adresse mail : $mail \n\n Message : \n\n $contenu";
    mail('aeropextech@gmail.com', $subject,$message,$headers);
    $vue = "accueil";
    $title = "Connexion";
    $alerte = "Mail envoyé";
    include ('contact.html');

}