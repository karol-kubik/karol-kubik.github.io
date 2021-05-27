<?php
/**
 * Vue : liste des utilisateurs inscrits
 */
?>

session_start();

<p><h1><?php echo $entete; ?></h1></p>

<?php if(isset($alerte)) { echo AfficheAlerte($alerte);} ?>

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
                <?php echo $element['username']; ?>
            </td>
            <td>
                <?php echo $element['nom']; ?>
            </td>
            <td>
                <?php echo $element['prenom']; ?>
            </td>
            <td>
                <?php echo $element['gender']; ?>
            </td>
            <td>
                <?php echo $element['birth']; ?>
            </td>
            <td>
                <?php echo $element['reaction']; ?>
            </td>
            <td>
                <?php echo $element['bpm']; ?>
            </td>
            <td>
                <?php echo $element['temp']; ?>
            </td>
            <td>
                <?php echo $element['testdate']; ?>
            </td>
        </tr>



    <?php } ?>

    </tbody>
</table>

<p><h3> Mes données personnelles :</h3></p>

<?php foreach ($liste as $element) { ?>

<p><label>Adresse mail : <?php echo $element['username']; ?></label></p>

<p><label>Nom : <?php echo $element['nom']; ?></label></p>

<p><label>Prénom : <?php echo $element['prenom']; ?></label></p>

<p><label>Date de naissance : <?php echo $element['birth']; ?></label></p>

<?php } ?>

<p><a href="index.php?cible=utilisateurs&fonction=ajoutTest">Ajouter des résultats de test</a></p>

<p><a href="index.php?cible=utilisateurs&fonction=ajouterGroupe">Ajouter un élève au groupe</a></p>

<p><a href="index.php?cible=utilisateurs&fonction=retirerEleve">Retirer un élève du groupe</a></p>

<p><a href="index.php?cible=utilisateurs&fonction=deconnexion">Déconnexion</a></p>

<p><a href="index.php?cible=utilisateurs&fonction=supprimer">Supprimer mon compte</a></p>

<p><a href="index.php?cible=utilisateurs&fonction=modifier">Modifier mes données</a></p>

<p><a href="index.php?cible=utilisateurs&fonction=contact">Contacter un administrateur</a></p>


