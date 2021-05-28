<?php

/**
 * Le contrôleur :
 * - définit le contenu des variables à afficher
 * - identifie et appelle la vue
 */ 

/**
 * Contrôleur de l'utilisateur
 */

// on inclut le fichier modèle contenant les appels à la BDD
include('./modele/requetes.utilisateurs.php');

// si la fonction n'est pas définie, on choisit d'afficher l'accueil
if (!isset($_GET['fonction']) || empty($_GET['fonction'])) {
    $function = "accueil";
} else {
    $function = $_GET['fonction'];
}

session_start();

switch ($function) {
    
    case 'accueil':
        //affichage de l'accueil
        $alerte = false;
        $vue = "accueil";
        $title = "Connexion à votre compte";
        break;

    case 'inscription':
    // inscription d'un nouvel utilisateur
        $vue = "inscription";
        $alerte = false;
        
        // Cette partie du code est appelée si le formulaire a été posté
        if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['confirm']) and isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['gender']) and isset($_POST['birth']) and isset($_POST['instructor'])) {
            
            if( !estUneChaine($_POST['username'])) {
                $alerte = "Le nom d'utilisateur doit être une chaîne de caractère.";
                
            } else if( !estUnMotDePasse($_POST['password'])) {
                $alerte = "Le mot de passe n'est pas correct.";

            } else if(rechercheMail($bdd, $_POST['username'])) {
                $alerte = "Cet email est déjà utilisé";

            } else if(rechercheNom($bdd, $_POST['nom']) AND recherchePrenom($bdd, $_POST['prenom'])) {
                $alerte = "Ces nom et prénom sont déjà utilisés";

            } else if( !estUneDateCorrect($_POST['birth'])) {
                $alerte = "Date de naissance incorrect";

            }
            else if($_POST['password'] != $_POST['confirm']){
                $alerte = "Les mots de passes ne correspondent pas.";
            } else {
                // Tout est ok, on peut inscrire le nouvel utilisateur

                // 
                $values = [
                    'username' => $_POST['username'],
                    //'password' => crypterMdp($_POST['password']),
                    'password' => $_POST['password'], // on crypte le mot de passe
                    'nom' => $_POST['nom'],
                    'prenom' => $_POST['prenom'],
                    'gender' => $_POST['gender'],
                    'birth' => $_POST['birth'],
                    'instructor' => $_POST['instructor']
                ];

                // Appel à la BDD à travers une fonction du modèle.
                $retour = ajouteUtilisateur($bdd, $values);
                
                if ($retour) {
                    $entete = "Inscription réussie";
                    $title = 'Connexion';
                    $vue = 'accueil';
                } else {
                    $alerte = "L'inscription n'a pas fonctionné";
                }
            }
        }
        $title = "Inscription";
        break;


    case 'liste':
    // Liste des utilisateurs déjà enregistrés
        $vue = "liste";
        $title = "Liste des utilisateurs inscrits";
        $entete = "Voici la liste :";
        
        $liste = recupereTousUtilisateurs($bdd);
        
        if(empty($liste)) {
            $alerte = "Aucun utilisateur inscrit pour le moment";
        }
        
        break;

    case 'connexion':
    // Connexion de l'utilisateur

        $vue = "connexion";
        $title = "Connexion";
        $alerte = false;
        if (isset($_POST['username']) and isset($_POST['password']))
        {
            $mail = $_POST['username'];
            $password = $_POST['password'];
            setcookie('mail',$mail,time() + 60*60*24*30);
            setcookie('password',$password,time() + 60*60*24*30);
            $liste = rechercheParNom($bdd, $mail, $password);
            if(empty($liste))
            {
                $vue = "connexion";
                $title = "Connexion";
                $alerte = "Erreur de connexion";
            }
            else
            {
                $_SESSION["sessionusername"]=$mail;
                $_SESSION["sessionpassword"]=$password;
                $entete = 'Bienvenue !';

                $instructortemp = json_encode(estFormateur($bdd, $mail));
                $instructor = $instructortemp[12];

                if($instructor == 1){
                    $groupidtemp = json_encode(rechercheGroupid($bdd, $mail));
                    $_SESSION["sessiongroupid"] = $groupidtemp[13];
                    $eleves = elevesGroupe($bdd, $_SESSION["sessiongroupid"]);
                    $entete = false;
                    $title = "Bienvenue !";
                    $vue = "formateur";
                }
                else {
                    $entete = false;
                    $title = "Bienvenue !";
                    $vue = "datatable";
                }
            }
        }
        break;

    case 'resetmdp':
    // Envoi d'un mdp provisoire

        $vue = "resetmdp";
        $title = "Envoi d'un mot de passe provisoire";
        $alerte = false;
        $subject = "Aeropex : Mot de passe provisoire";
        $headers = "From: admin@aeropex.fr";

        if (isset($_POST['username']))
        {
            if(rechercheMail($bdd, $_POST['username']))
            {
                $resetmdp = rand(100000, 999999);
                $mail = $_POST['username'];
                $idtemp = json_encode(rechercheID($bdd, $mail));
                $id = $idtemp[8];
                mdpProvisoire($bdd, $id, $resetmdp);

                $message = $resetmdp;
                mail($mail, $subject,$message,$headers);
                $alerte = "Mail envoyé";
                $vue = "accueil";
                $title = "Connexion";
            }
            else {
                $alerte = "Cet email n'est associé à aucun compte.";
            }

        }

        break;

    case 'contact':
        // Contact de l'administrateur

        $vue = "contact";
        $title = "Contacter l'administrateur";
        $alerte = false;
        $mail = $_SESSION["sessionusername"];
        $nom = json_encode(recupNomAvecMail($bdd, $mail));
        $prenom = json_encode(recupPrenomAvecMail($bdd, $mail));

        if (isset($_POST['subject']) and isset($_POST['message']))
        {
            if (isset($_SESSION['sessiongroupid'])){
                $type = "formateur";
            }
            else {
                $type = "élève";
            }
            $object = $_POST['subject'];
            $contenu = $_POST['message'];
            $subject = "Nouveau message de : $mail";
            $headers = "From : $mail";
            $message = "Un $type vous a envoyé un message ! \n\n Nom : $nom \n Prénom : $prenom \n Adresse mail : $mail \n\n Object de la demande : $object \n\n $contenu";
            mail('aeropextech@gmail.com', $subject,$message,$headers);
            $vue = "accueil";
            $title = "Connexion";
            $alerte = "Mail envoyé";

        }

        break;


    case 'supprimer':

        $vue = "connexion";
        $title = "Connexion";
        $alerte = "Reconnectez-vous afin de supprimer votre compte";
        $mail = $_SESSION["sessionusername"];
        $password = $_SESSION["sessionpassword"];
        $liste = rechercheParNom($bdd, $mail, $password);
        $idtemp = json_encode(rechercheID($bdd, $mail));
        $id = $idtemp[8];
        supprimerUtilisateur($bdd, $id);
        $vue = "accueil";
        $title = "Compte supprimé !";

        break;

    case 'modifier':
        $vue = "modification";
        $title = "Modification du compte";
        $alerte = false;
        $mail = $_SESSION["sessionusername"];
        $password = $_SESSION["sessionpassword"];
        $liste = rechercheParNom($bdd, $mail, $password);
        if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['birth']))
        {
            if( !estUneChaine($_POST['username'])) {
                $alerte = "Le nom d'utilisateur doit être une chaîne de caractère.";

            } else if( !estUnMotDePasse($_POST['password'])) {
                $alerte = "Le mot de passe n'est pas correct.";

            } else if($_POST['password'] != $_POST['confirm']){
                $alerte = "Les mots de passes ne correspondent pas.";

            } else {
                // Tout est ok, on peut modifier l'utilisateur
                $values = [
                    'username' => $_POST['username'],
                    'password' => $_POST['password'],
                    //'password' => crypterMdp($_POST['password']), // on crypte le mot de passe
                    'nom' => $_POST['nom'],
                    'prenom' => $_POST['prenom'],
                    'birth' => $_POST['birth']
                ];

                $idtemp = json_encode(rechercheID($bdd, $mail));
                $id = $idtemp[8];
                $retour = modifierUtilisateur($bdd, $values, $id);

                if ($retour) {
                    $alerte = "Modification réussite";
                    $vue = "connexion";
                    $title = "Connexion";
                } else {
                    $alerte = "Erreur de modification";
                }
            }
        }

        break;


    case 'deconnexion' :
        session_destroy();
        $alerte = "Déconnecté !";
        $vue = "accueil";
        $title = "Connexion";


        break;

    case 'ajouterGroupe' :
        $vue = "ajoutEleve";
        $title = "Ajouter un élève au groupe";
        $alerte = false;
        $mail = $_SESSION["sessionusername"];
        $password = $_SESSION["sessionpassword"];

        if(isset($_POST['nom']) and isset($_POST['prenom'])){
            if( !estUneChaine($_POST['nom'])) {
                $alerte = "Le nom d'utilisateur doit être une chaîne de caractère.";
            }

            else if( !estUneChaine($_POST['nom'])) {
                $alerte = "Le nom d'utilisateur doit être une chaîne de caractère.";
            }

            else{
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $idtemp = json_encode(rechercheIDparNomPrenom($bdd, $nom, $prenom));
                $id = $idtemp[8];
                modifierGroupe($bdd, $_SESSION["sessiongroupid"], $id);
                $eleves = elevesGroupe($bdd, $_SESSION["sessiongroupid"]);
                $liste = rechercheParNom($bdd, $mail, $password);
                $vue = "formateur";
                $alerte = "Eleve ajouté !";
                $entete = false;
                $title = "Bienvenue !";
            }


        }

        break;

    case 'retirerEleve' :

        $vue = "retirerGroupe";
        $title = "Retirer un élève du groupe";
        $alerte = false;
        $mail = $_SESSION["sessionusername"];
        $password = $_SESSION["sessionpassword"];

        if(isset($_POST['nom']) and isset($_POST['prenom'])){
            if( !estUneChaine($_POST['nom'])) {
                $alerte = "Le nom d'utilisateur doit être une chaîne de caractère.";
            }

            else if( !estUneChaine($_POST['prenom'])) {
                $alerte = "Le prénom d'utilisateur doit être une chaîne de caractère.";
            }

            else{
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $idtemp = json_encode(rechercheIDparNomPrenom($bdd, $nom, $prenom));
                $id = $idtemp[8];
                modifierGroupe($bdd, 0, $id);
                $eleves = elevesGroupe($bdd, $_SESSION["sessiongroupid"]);
                $liste = rechercheParNom($bdd, $mail, $password);
                $vue = "formateur";
                $alerte = "Eleve retiré du groupe !";
                $entete = false;
                $title = "Bienvenue !";
            }


        }

        break;

    case 'ajoutTest' :

        $vue = "addtest";
        $title = "Ajouter un test";
        $alerte = false;
        $groupid = $_SESSION["sessiongroupid"];
        if(isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['bpm']) and isset($_POST['reaction']) and isset($_POST['temp'] )and isset($_POST['testdate']))
        {
            if( !estUneChaine($_POST['nom'])) {
                $alerte = "Le nom d'utilisateur doit être une chaîne de caractère.";
            }

            else if( !estUneChaine($_POST['prenom'])) {
                $alerte = "Le prénom d'utilisateur doit être une chaîne de caractère.";
            }

            else{
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $idtemp = json_encode(rechercheIDparNomPrenom($bdd, $nom, $prenom));
                $id = $idtemp[8];

                $groupidtemp = json_encode(rechercheGroupidParNom($bdd, $nom, $prenom));
                $groupideleve = $groupidtemp[13];

                if ($groupideleve == $groupid){
                    $values = [
                        'bpm' => $_POST['bpm'],
                        'temp' => $_POST['temp'],
                        'reaction' => $_POST['reaction'],
                        'testdate' => $_POST['testdate']
                    ];
                    ajoutTest($bdd, $values,$id);
                    $eleves = elevesGroupe($bdd, $_SESSION["sessiongroupid"]);
                    $liste = rechercheParNom($bdd, $_SESSION["sessionusername"], $_SESSION["sessionpassword"]);
                    $vue = "formateur";
                    $alerte = "Données de test ajouté !";
                    $entete = false;
                    $title = "Bienvenue !";
                }
                else{
                    $alerte = "Cet élève n'existe pas ou ne fait pas partie de votre groupe.";
                }

            }
        }

        break;


    default:
        // si aucune fonction ne correspond au paramètre function passé en GET
        $vue = "erreur404";
        $title = "Error 404";
        $message = "Erreur 404 : la page recherchée n'existe pas.";
}

include ('vues/header.php');
include ('vues/' . $vue . '.php');
include ('vues/footer.php');
