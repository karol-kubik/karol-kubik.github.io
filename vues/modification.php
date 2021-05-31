<?php
/**
 * Vue : modification données utilisateur
 */
?>



<?php echo AfficheAlerte($alerte); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier mes données</title>
    <script>
        function confirmation() {
            alert("Voulez-vous vraiment modifier vos données ?");
        }
    </script>
    <link rel="stylesheet" type="text/css" href="modification.css">
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
    <?php foreach ($liste as $element) { ?>

        <h2>Modifier mes données personnels :</h2>
        <form method="POST" action="">
            <div class="txt_field">
                <label></label>
                <input type="text"  name="username" value ="<?php echo $element['username']; ?>" required/><br>
            </div>

            <div class="txt_field">
                <label></label>
                <input type="password"  name="password" value ="<?php echo $element['password']; ?>" required/><br>
            </div>

            <div class="txt_field">
                <label>Confirmer le mot de passe :</label>
                <input type="password"  name="confirm"  /><br>
            </div>

            <div class="txt_field">
                <label></label>
                <input type="text"  name="nom" value ="<?php echo $element['nom']; ?>" required/><br>
            </div>

            <div class="txt_field">
                <label></label>
                <input type="text"  name="prenom" value ="<?php echo $element['prenom']; ?>" required/><br>
            </div>

            <div class="txt_field">
                <p>Date de naissance</p>
                <!--<label>Date de naissance :</label>-->
                <input type="date"  name="birth" value ="<?php echo $element['birth']; ?>" required/><br>
            </div>


            <button type="submit" onclick="confirmation()" name="submit">Modifier</button>

        </form>

        <?php } ?>

        <?php if(isset($alerte)) { echo AfficheAlerte($alerte);} ?>

        <p>
            <a href="../index.php">Retour</a>
        </p>
    </div>
    <br>
</body>
</html>
