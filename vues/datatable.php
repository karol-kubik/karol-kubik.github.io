<?php
/**
 * Vue : liste des utilisateurs inscrits
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Espace personnel de l'élève</title>
    <link rel="stylesheet" type="text/css" href="datatable.css">
</head>

<body>
    <header>
        <div class="main">
            <div class="logo">
                <a href= "index.html"><img src="logo.png" alt="logo aeropex" /></a>
            </div>
            <div class = "menu">
                <ul>
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="a-propos.html">A propos de nous</a></li>
                    <li><a href="FAQ.html">FAQ</a></li>
                    <li><a href="#">Statistiques</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>

    </header>
    <!--<div class="entete">
        <h1><?php echo $entete; ?></h1>
    </div>-->
    <div class="container">
        <div class="results">
            <h3> Mes derniers test effectués :</h3>
            <table>
                <thead>
                <tr>
                    <th>Temp de réaction test visuel(en ms)</th>
                    <th>Temp de réaction test auditif(en ms)</th>
                    <th>BPM</th>
                    <th>Température</th>
                    <th>Date du dernier test</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($liste as $element) { ?>

                <tr>
                    <td>
                        <p><?php echo $element['reaction']; ?></p>
                    </td>
                    <td>
                        <p>247</p>
                    </td>
                    <td>
                        <p><?php echo $element['bpm']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $element['temp']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $element['testdate']; ?></p>
                    </td>
                </tr>


            <?php } ?>

                </tbody>
            </table>
        </div>
        <div class="myaccount">
            <h3>Mes données personnelles :</h3>

            <p><label>Adresse mail : <?php echo $element['username']; ?></label></p>

            <p><label>Nom : <?php echo $element['nom']; ?></label></p>

            <p><label>Prénom : <?php echo $element['prenom']; ?></label></p>

            <p><label>Date de naissance : <?php echo $element['birth']; ?></label></p>


            <?php if(isset($alerte)) { echo AfficheAlerte($alerte);} ?>


            <div class="buttons">
                <p><a href="index.php?cible=utilisateurs&fonction=deconnexion">Déconnexion</a></p>

                <p><a href="index.php?cible=utilisateurs&fonction=supprimer">Supprimer mon compte</a></p>

                <p><a href="index.php?cible=utilisateurs&fonction=modifier">Modifier mes données</a></p>

                <p><a href="index.php?cible=utilisateurs&fonction=contact">Contacter un administrateur</a></p>
            </div>
        </div>
    </div>
</body>
</html>
