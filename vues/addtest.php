<?php
/**
 * Vue : ajouter les réslutaltats des tests
 */
?>

<?php echo AfficheAlerte($alerte); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter des tests</title>
    <link rel="stylesheet" type="text/css" href="addtest.css">
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
        <form method="POST" action="">
            <div class="txt_field">
                <label>Nom :</label>
                <input type="text"  name="nom" required/><br>
            </div>
            <div class="txt_field">
                <label>Prénom :</label>
                <input type="text"  name="prenom" required/><br>
            </div>
            <div class="txt_field">
                <label>BPM :</label>
                <input type="text"  name="bpm"/><br>
            </div>
            <div class="txt_field">
                <label>Temps de réaction :</label>
                <input type="text"  name="reaction"  /><br>
            </div>
            <div class="txt_field">
                <label>Température :</label>
                <input type="text"  name="temp"  /><br>
            </div>
            <div class="txt_field">
                <label>Date du test :</label>
                <input type="date"  name="testdate"  /><br>
            </div>

            <button type="submit" name="submit">Enregistrer</button>

        </form>
    </div>
</body>
</html>