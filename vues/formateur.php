<?php
/**
 * Vue : liste des utilisateurs inscrits
 */
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Espace personnel formateur</title>
    <link rel="stylesheet" type="text/css" href="formateur.css">
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
    <div class="entete">
        <h1><?php echo $entete; ?></h1>
    </div>
<?php if(isset($alerte)) { echo AfficheAlerte($alerte);} ?>
    <div class="container">
        <div class="results">
            <h3> Mes élèves :</h3>

            <table>
                <thead>
                <tr>
                    <th>Mail</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Sexe</th>
                    <th>Date de naissance</th>
                    <th>Temp de réaction (en ms)</th>
                    <th>BPM</th>
                    <th>Température</th>
                    <th>Date du dernier test</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($eleves as $element) { ?>

                    <tr>
                        <td>
                            <p><?php echo $element['username']; ?></p>
                        </td>
                        <td>
                            <p><?php echo $element['nom']; ?></p>
                        </td>
                        <td>
                            <p><?php echo $element['prenom']; ?></p>
                        </td>
                        <td>
                            <p><?php if ($element['gender'] == 1) {echo "Homme";} else {echo "Femme";} ?></p>
                        </td>
                        <td>
                            <p><?php echo $element['birth']; ?></p>
                        </td>
                        <td>
                            <p><?php echo $element['reaction']; ?></p>
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
            <p><h3> Mes données personnelles :</h3></p>

            <?php foreach ($liste as $element) { ?>

            <p><label>Adresse mail : <?php echo $element['username']; ?></label></p>

            <p><label>Nom : <?php echo $element['nom']; ?></label></p>

            <p><label>Prénom : <?php echo $element['prenom']; ?></label></p>

            <p><label>Date de naissance : <?php echo $element['birth']; ?></label></p>

            <?php } ?>

            <div class="buttons">
            <p><a href="index.php?cible=utilisateurs&fonction=serverdata">Débuter un test</a></p>

            <p><a href="index.php?cible=utilisateurs&fonction=ajouterGroupe">Ajouter un élève au groupe</a></p>

            <p><a href="index.php?cible=utilisateurs&fonction=retirerEleve">Retirer un élève du groupe</a></p>

            <p><a href="index.php?cible=utilisateurs&fonction=deconnexion">Déconnexion</a></p>

            <p><a href="index.php?cible=utilisateurs&fonction=supprimer">Supprimer mon compte</a></p>

            <p><a href="index.php?cible=utilisateurs&fonction=modifier">Modifier mes données</a></p>

            <p><a href="index.php?cible=utilisateurs&fonction=contact">Contacter un administrateur</a></p>
            </div>
        </div>
    </div>
</body>
</html>


