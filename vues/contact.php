<?php
/**
 * Vue : contact de l'admin
 */
?>

<?php echo AfficheAlerte($alerte); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contacter un administrateur</title>
    <link rel="stylesheet" type="text/css" href="contactphp.css">
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
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Statistiques</a></li>
                <li><a href="contact.html">Contact</a></li>

            </ul>
        </div>
    </div>

</header>
    <div class="center">
        <h2>CONTACTER UN ADMINISTRATEUR</h2>
        <form method="POST" action="">
            <div class="txt_field">
                <label>Object :</label>
                <input type="text"  name="subject" /><br>
            </div>
            <div class="txt_field" id="message">
                <label>Message :</label>
                <textarea type="text" name="message" required></textarea><br>
            </div>

            <button type="submit" name="submit">Envoyer une requête</button>

        </form>

        <p><a href="javascript:history.back()">Retour</a></p>
    </div>
<br>
</body>
</html>