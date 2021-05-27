<?php
/**
 * Vue : mot de passe oublié
 */
?>

<?php echo AfficheAlerte($alerte); ?>

<form method="POST" action="">

    <label>Adresse Mail :</label>
    <input type="text"  name="username" required/>

    <button type="submit" name="submit">Envoyer une requête</button>

</form>

<p><a href="index.php">Retour</a></p>