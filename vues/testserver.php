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
    <h1>DÉBUTER UN TEST</h1>
    <form method="POST" action="">
        <div class="txt_field">
            <label>Nom :</label>
            <input type="text"  name="nom" required/>
        </div>
        <div class="txt_field">
            <label>Prénom :</label>
            <input type="text"  name="prenom"required/>
        </div>
        <div>
            <label>Choissisez un test :</label>
            <select name="tests" id="tests-select">
                <option value="micro">Test de tonalité</option>
                <option value="bpm">Test cardiaque</option>
                <option value="temp">Test de température</option>
                <option value="reacled">Test de réaction LED</option>
                <option value="reacson">Test de réaction son</option>
            </select>
        </div>

        <button type="submit" name="submit">Lancer le test</button>

    </form>

    <p class="back"><a href="javascript:history.back()">Go Back</a></p>
</div>
</body>
</html>
