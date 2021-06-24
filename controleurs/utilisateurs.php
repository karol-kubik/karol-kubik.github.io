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
        $title = false;
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
                    $title = false;
                    $vue = 'accueil';
                } else {
                    $alerte = "L'inscription n'a pas fonctionné";
                }
            }
        }
        $title = false;
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
        $title = false;
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
                $title = false;
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
                    $title = false;
                    $vue = "formateur";
                }
                else {
                    $entete = false;
                    $title = false;
                    $vue = "datatable";
                }
            }
        }
        break;

    case 'resetmdp':
    // Envoi d'un mdp provisoire

        $vue = "resetmdp";
        $title = false;
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
                $title = false;
            }
            else {
                $alerte = "Cet email n'est associé à aucun compte.";
            }

        }

        break;

    case 'contact':
        // Contact de l'administrateur

        $vue = "contact";
        $title = false;
        $alerte = false;
        $mail = $_SESSION["sessionusername"];
        $nom = json_encode(recupNomAvecMail($bdd, $mail));
        $prenom = json_encode(recupPrenomAvecMail($bdd, $mail));

        if (isset($_POST['subject']) and isset($_POST['message']))
        {
            if (isset($_SESSION['sessiongroupid'])){
                $type = "utilisateur";
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
            $title = false;
            $alerte = "Mail envoyé";

        }

        break;


    case 'supprimer':

        $vue = "connexion";
        $title = false;
        $alerte = "Reconnectez-vous afin de supprimer votre compte";
        $mail = $_SESSION["sessionusername"];
        $password = $_SESSION["sessionpassword"];
        $liste = rechercheParNom($bdd, $mail, $password);
        $idtemp = json_encode(rechercheID($bdd, $mail));
        $id = $idtemp[8];
        supprimerUtilisateur($bdd, $id);
        $vue = "accueil";
        $alerte = "Compte supprimé !";

        break;

    case 'modifier':
        $vue = "modification";
        $title = false;
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

            } else if( !estUneDateCorrect($_POST['birth'])) {
                $alerte = "Date de naissance incorrect";

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
                    $title = false;
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
        $title = false;


        break;

    case 'ajouterGroupe' :
        $vue = "ajoutEleve";
        $title = false;
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
                $title = false;
            }


        }

        break;

    case 'retirerEleve' :

        $vue = "retirerGroupe";
        $title = false;
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
                $title = false;
            }


        }

        break;

    case 'ajoutTest' :

        $vue = "addtest";
        $title = false;
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
                    $title = false;
                }
                else{
                    $alerte = "Cet élève n'existe pas ou ne fait pas partie de votre groupe.";
                }

            }
        }

        break;

    case 'serverdata' :

        $vue = "testserver";
        $title = false;
        $alerte = false;
        $groupid = $_SESSION["sessiongroupid"];
        if(isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['tests']))
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
                $test = $_POST['tests'];
                $idtemp = json_encode(rechercheIDparNomPrenom($bdd, $nom, $prenom));
                $id = $idtemp[8];

                $groupidtemp = json_encode(rechercheGroupidParNom($bdd, $nom, $prenom));
                $groupideleve = $groupidtemp[13];

                if ($groupideleve == $groupid){

                    $ch = curl_init();
                    curl_setopt(
                        $ch,
                        CURLOPT_URL,
                        "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=G7Cb");
                    curl_setopt($ch, CURLOPT_HEADER, FALSE);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    $data = curl_exec($ch);
                    curl_close($ch);

                    $data_tab = $data;

                    $trame = $data_tab;

                    //$trame = "1G7Cy130112340000ba20210615154058"; //1 G7Cy 1 3 01 1234 0000 ba 2021 06 15 15 40 58

                    // décodage avec des substring
                    $t = substr($trame,0,1); //type de trame (1 = longeur fixe, 2 = longeur variable)
                    $o = substr($trame,1,4); //numéro objet (ici G7Cy)
                    $r = substr($trame,4,1); //type requête (1 = récup une valeur du capteur, 2 = envoyer une commande)
                    $c = substr($trame,5,1); //type de capteur
                    $n = substr($trame,6,2); //numéro capteur
                    $v = substr($trame,8,4); //valeur du test
                    $a = substr($trame,12,4); //numéro de trame
                    $x = substr($trame,16,2); //checksum
                    $year = substr($trame,18,4); //année
                    $month = substr($trame,22,2); //mois
                    $day = substr($trame,24,2); //jour
                    $hour = substr($trame,26,2); //heures
                    $min = substr($trame,28,2); //minutes
                    $sec = substr($trame,30,2); //secondes
                    // décodage avec sscanf
                    list($t, $o, $r, $c, $n, $v, $a, $x, $year, $month, $day, $hour, $min, $sec) =
                        sscanf($trame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
                    echo("<br />$t,$o,$r,$c,$n,$v,$a,$x,$year,$month,$day,$hour,$min,$sec<br />");
                    /*switch($test) {
                        case 'temp' :
                            $temp = $v;
                            $testdate = "{$year}-{$month}-{$day}";
                            $values = [
                                'temp' => $temp,
                                'testdate' => $testdate
                            ];
                            ajoutTemp($bdd, $values,$id);
                            break;

                        case 'bpm' :
                            $bpm = $v;
                            $testdate = "{$year}-{$month}-{$day}";
                            $values = [
                                'temp' => $bpm,
                                'testdate' => $testdate
                            ];
                            ajoutBPM($bdd, $values,$id);
                            break;

                        case 'reacled' :
                            $reaction = $v;
                            $testdate = "{$year}-{$month}-{$day}";
                            $values = [
                                'temp' => $reaction,
                                'testdate' => $testdate
                            ];
                            ajoutReac($bdd, $values,$id);
                            break;
                    }*/

                    $testdate = "{$year}-{$month}-{$day}";

                    $values = [
                        'temp' => 0,
                        'bpm' => 0,
                        'reaction' => $v,
                        'testdate' => $testdate
                    ];
                    ajoutTest($bdd, $values,$id);

                    $eleves = elevesGroupe($bdd, $_SESSION["sessiongroupid"]);
                    $liste = rechercheParNom($bdd, $_SESSION["sessionusername"], $_SESSION["sessionpassword"]);
                    $vue = "formateur";
                    $alerte = "Données de test ajouté !";
                    $entete = false;
                    $title = false;
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
        $title = false;
        $message = "Erreur 404 : la page recherchée n'existe pas.";
}

include ('vues/header.php');
include ('vues/' . $vue . '.php');
include ('vues/footer.php');
