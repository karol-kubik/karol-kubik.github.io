<?php
/**
 * Vue : connecter un utilisateur
 */
?>

<?php echo AfficheAlerte($alerte); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connectez-vous</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div class="center">
    <h1>BIENVENUE !</h1>
    <form method="POST" action="">
        <div class="txt_field">
            <input type="text" name="username" required value="<?php if (isset($_COOKIE['mail'])){echo $_COOKIE['mail'];} ?>"/><br>
            <label>Adresse mail</label>
        </div>
        <!--<label>Adresse Mail :</label>
        <input type="text"  name="username" required value="<?php if (isset($_COOKIE['mail'])){echo $_COOKIE['mail'];} ?>"/><br>
-->
        <div class="txt_field">
            <input type="password" name="password"  required value="<?php if (isset($_COOKIE['password'])){echo $_COOKIE['password'];} ?>"/><br>
            <span></span>
            <label>Mot de passe</label>
        </div>
        <!--
        <label>Mot de passe :</label>
        <input class = "pass" type="password"  name="password"  required value="<?php if (isset($_COOKIE['password'])){echo $_COOKIE['password'];} ?>"/><br>
-->
        <button type="submit" name="submit">Se connecter</button>

    </form>



    <p class="pass"><a href="index.php?cible=utilisateurs&fonction=resetmdp">Mot de passe oublié ?</a></p>

    <p class="pass"> <a href="index.php">Retour</a></p>
</div>
</body>
</html>