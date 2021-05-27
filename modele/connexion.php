<?php

try{
    $bdd = new PDO('mysql:host=localhost:8889;dbname=mvc;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}