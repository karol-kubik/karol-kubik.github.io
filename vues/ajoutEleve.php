<?php
/**
 * Vue : ajout d'un élève au groupe
 */
?>

<?php echo AfficheAlerte($alerte); ?>

<form method="POST" action="">

    <label>Nom :</label>
    <input type="text"  name="nom" required/>

    <label>Prénom :</label>
    <input type="text"  name="prenom"required/>

    <button type="submit" name="submit">Ajouter un élève</button>

</form>

<p><a href="index.php">Retour</a></p>
