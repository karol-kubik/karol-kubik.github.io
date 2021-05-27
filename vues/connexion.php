<?php
/**
 * Vue : connecter un utilisateur
 */
?>

<?php echo AfficheAlerte($alerte); ?>

<form method="POST" action="">

    <label>Adresse Mail :</label>
    <input type="text"  name="username" required value="<?php if (isset($_COOKIE['mail'])){echo $_COOKIE['mail'];} ?>"/><br>

    <label>Mot de passe :</label>
    <input type="password"  name="password"  required value="<?php if (isset($_COOKIE['password'])){echo $_COOKIE['password'];} ?>"/><br>

    <button type="submit" name="submit">Se connecter</button>

</form>

<p><a href="index.php?cible=utilisateurs&fonction=resetmdp">Mot de passe oublié ?</a></p>

<p><a href="index.php">Retour</a></p>
