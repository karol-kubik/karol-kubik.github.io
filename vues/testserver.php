<?php
/**
 * Vue : ajout d'un élève au groupe
 */
?>

<?php echo AfficheAlerte($alerte); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Réalisation test</title>
    <link rel="stylesheet" type="text/css" href="ajoutEleve.css">
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
    <h1>REALISATION TEST</h1>
    <form method="POST" action="">
        <div class="txt_field">
            <label>Nom :</label>
            <input type="text"  name="nom" required/>
        </div>
        <div class="txt_field">
            <label>Prénom :</label>
            <input type="text"  name="prenom"required/>
        </div>

        <button type="submit" name="submit">Réaliser un test</button>

    </form>

    <p class="back"><a href="javascript:history.back()">Go Back</a></p>
</div>
</body>
</html>
