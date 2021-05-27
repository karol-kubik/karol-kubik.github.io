<?php
/**
 * Vue : retirer un élève de son groupe
 */
?>

<?php echo AfficheAlerte($alerte); ?>

<form method="POST" action="">

    <label>Nom :</label>
    <input type="text"  name="nom" required/>

    <label>Prénom :</label>
    <input type="text"  name="prenom" required/>

    <button type="submit" name="submit">Retirer un élève</button>

</form>

<p><a href="index.php">Retour</a></p>