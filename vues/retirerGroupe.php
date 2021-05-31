<?php
/**
 * Vue : retirer un élève de son groupe
 */
?>

<?php echo AfficheAlerte($alerte); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Retirer un élève</title>
    <script>
        function confirmation() {
            alert("Voulez-vous vraiment retirer cet élève de votre groupe ?");
        }
    </script>
    <link rel="stylesheet" type="text/css" href="retirerGroupe.css">
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
        <h2>RETIRER UN ELEVE</h2>
        <form method="POST" action="">
            <div class="txt_field">
                <label>Nom :</label>
                <input type="text"  name="nom" required/>
            </div>

            <div class="txt_field">
                <label>Prénom :</label>
                <input type="text"  name="prenom" required/>
            </div>

            <button type="submit" onclick="confirmation()" name="submit">Retirer un élève</button>

        </form>

        <p><a href="javascript:history.back()">Retour</a></p>
    </div>
</body>
</html>