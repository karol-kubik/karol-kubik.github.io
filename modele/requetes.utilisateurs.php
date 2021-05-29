<?php


//on définit le nom de la table
$table = "users";
include("modele/connexion.php");

/**
 * Recherche un utilisateur en fonction du nom passé en paramètre
 * @param PDO $bdd
 * @param string $nom
 * @return array
 */
function rechercheParNom(PDO $bdd, string $nom, string $mdp): array {
    
    $statement = $bdd->prepare('SELECT * FROM  users WHERE username = :username AND password = :password');
    $statement->bindParam(":username", $nom);
    $statement->bindParam(":password", $mdp);
    $statement->execute();
    
    return $statement->fetchAll();
    
}

function rechercheGroupid(PDO $bdd, string $mail){

    $statement = $bdd->prepare('SELECT groupid FROM users WHERE username = :username');
    $statement->bindParam(":username", $mail);
    $statement->execute();

    return $statement->fetchAll();
}

function rechercheGroupidParNom(PDO $bdd, string $nom, string $prenom){

    $statement = $bdd->prepare('SELECT groupid FROM users WHERE nom = :nom AND prenom = :prenom');
    $statement->bindParam(":nom", $nom);
    $statement->bindParam(":prenom", $prenom);
    $statement->execute();

    return $statement->fetchAll();
}

function rechercheID(PDO $bdd, string $mail){

    $statement = $bdd->prepare('SELECT id FROM users WHERE username = :username');
    $statement->bindParam(":username", $mail);
    $statement->execute();

    return $statement->fetchAll();

}

function rechercheIDparNomPrenom(PDO $bdd, string $nom, string $prenom){

    $statement = $bdd->prepare('SELECT id FROM users WHERE nom = :nom AND prenom = :prenom');
    $statement->bindParam(":nom", $nom);
    $statement->bindParam(":prenom", $prenom);
    $statement->execute();

    return $statement->fetchAll();

}

function rechercheMail(PDO $bdd, string $mail){

    $statement = $bdd->prepare('SELECT id FROM  users WHERE username = :username');
    $statement->bindParam(":username", $mail);
    $statement->execute();

    return $statement->fetchAll();

}

function rechercheNom(PDO $bdd, string $nom){

    $statement = $bdd->prepare('SELECT nom FROM  users WHERE nom = :nom');
    $statement->bindParam(":nom", $nom);
    $statement->execute();

    return $statement->fetchAll();

}

function recherchePrenom(PDO $bdd, string $prenom){

    $statement = $bdd->prepare('SELECT prenom FROM  users WHERE prenom = :prenom');
    $statement->bindParam(":prenom", $prenom);
    $statement->execute();

    return $statement->fetchAll();

}

function recupNomAvecMail(PDO $bdd, string $username){

    $statement = $bdd->prepare('SELECT nom FROM  users WHERE username = :username');
    $statement->bindParam(":username", $username);
    $statement->execute();
    return $statement->fetchAll();

}

function recupPrenomAvecMail(PDO $bdd, string $username){

    $statement = $bdd->prepare('SELECT prenom FROM  users WHERE username = :username');
    $statement->bindParam(":username", $username);
    $statement->execute();

    return $statement->fetchAll();

}

function connectUser(PDO $bdd, string $mail, string $password){

    $statement = $bdd->prepare('SELECT COUNT(1) AS BIT FROM users WHERE password = :password AND username = :username');
    $statement->bindParam(":username", $mail);
    $statement->bindParam(":password", $password);
    $statement->execute();

    return $statement->fetchAll();

}

/**
 * Récupère tous les enregistrements de la table users
 * @param PDO $bdd
 * @return array
 */
function recupereTousUtilisateurs(PDO $bdd): array {
    $query = 'SELECT * FROM users';
    return $bdd->query($query)->fetchAll();
}

function supprimerUtilisateur(PDO $bdd, string $id){
    
    $query = ' DELETE FROM users WHERE id = :id';
    $donnees = $bdd->prepare($query);
    $donnees->bindParam(":id", $id, PDO::PARAM_STR);
    return $donnees->execute();
}

/**
 * Ajoute un nouvel utilisateur dans la base de données
 * @param array $utilisateur
 */
function ajouteUtilisateur(PDO $bdd, array $utilisateur) {
    
    $query = ' INSERT INTO users (username, password, nom, prenom, gender, birth, idrole,groupid) VALUES (:username, :password, :nom, :prenom, :gender, :birth, :idrole,0)';
    $donnees = $bdd->prepare($query);
    $donnees->bindParam(":username", $utilisateur['username'], PDO::PARAM_STR);
    $donnees->bindParam(":password", $utilisateur['password']);
    $donnees->bindParam(":nom", $utilisateur['nom']);
    $donnees->bindParam(":prenom", $utilisateur['prenom']);
    $donnees->bindParam(":gender", $utilisateur['gender']);
    $donnees->bindParam(":birth", $utilisateur['birth']);
    $donnees->bindParam(":idrole", $utilisateur['instructor']);
    return $donnees->execute();
    
}

function modifierUtilisateur(PDO $bdd, array $utilisateur , int $id) {

    $query = ' UPDATE users SET username = :username, password = :password, nom = :nom, prenom = :prenom, birth = :birth WHERE id = :id';
    $donnees = $bdd->prepare($query);
    $donnees->bindParam(":id", $id, PDO::PARAM_STR);
    $donnees->bindParam(":username", $utilisateur['username'], PDO::PARAM_STR);
    $donnees->bindParam(":password", $utilisateur['password']);
    $donnees->bindParam(":nom", $utilisateur['nom']);
    $donnees->bindParam(":prenom", $utilisateur['prenom']);
    $donnees->bindParam(":birth", $utilisateur['birth']);
    return $donnees->execute();

}

function ajoutTest(PDO $bdd, array $data , int $id) {

    $query = ' UPDATE users SET bpm = :bpm, reaction = :reaction, temp = :temp, testdate = :testdate WHERE id = :id';
    $donnees = $bdd->prepare($query);
    $donnees->bindParam(":id", $id, PDO::PARAM_STR);
    $donnees->bindParam(":bpm", $data['bpm'], PDO::PARAM_STR);
    $donnees->bindParam(":reaction", $data['reaction']);
    $donnees->bindParam(":temp", $data['temp']);
    $donnees->bindParam(":testdate", $data['testdate']);
    return $donnees->execute();

}

function mdpProvisoire(PDO $bdd, string $id, int $mdp) {
    $query = ' UPDATE users SET password = :password WHERE id = :id';
    $donnees = $bdd->prepare($query);
    $donnees->bindParam(":id", $id, PDO::PARAM_STR);
    $donnees->bindParam(":password", $mdp);
    return $donnees->execute();
}

function estFormateur(PDO $bdd, string $mail){

    $statement = $bdd->prepare('SELECT idrole FROM  users WHERE username = :username');
    $statement->bindParam(":username", $mail);
    $statement->execute();

    return $statement->fetchAll();

}

function elevesGroupe(PDO $bdd, int $groupid): array {

    $statement = $bdd->prepare('SELECT * FROM  users WHERE groupid = :groupid');
    $statement->bindParam(":groupid", $groupid);
    $statement->execute();

    return $statement->fetchAll();

}

function modifierGroupe(PDO $bdd, int $groupid , int $id) {

    $query = ' UPDATE users SET groupid = :groupid WHERE id = :id';
    $donnees = $bdd->prepare($query);
    $donnees->bindParam(":id", $id, PDO::PARAM_STR);
    $donnees->bindParam(":groupid", $groupid, PDO::PARAM_STR);
    return $donnees->execute();

}



?>