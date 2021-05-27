<?php
/**
 * Vue : contact de l'admin
 */
?>

<?php echo AfficheAlerte($alerte); ?>

<form method="POST" action="">

    <label>Object :</label>
    <input type="text"  name="subject" /><br>

    <label>Message :</label>
    <textarea type="text" name="message" required></textarea><br>

    <button type="submit" name="submit">Envoyer une requête</button>

</form>

<p><a href="index.php">Retour</a></p>
