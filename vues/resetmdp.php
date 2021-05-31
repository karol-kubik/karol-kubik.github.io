<?php
/**
 * Vue : mot de passe oublié
 */
?>

<?php echo AfficheAlerte($alerte); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
    <script>
        function confirmation() {
            alert("Veuillez consulter votre boite mail. Dès que vous avez accès à votre compte, veuillez changer de mot de passe.");
        }
    </script>

    <link rel="stylesheet" type="text/css" href="resetmdp.css">
</head>
<body>
    <div class="center">
        <form method="POST" action="">
            <div class="txt_field">
                <label>Adresse Mail :</label>
                <input type="text"  name="username" required/>
            </div>

            <button type="submit" onclick="confirmation()" name="submit">Envoyer une requête</button>

        </form>

        <p><a href="index.php">Retour</a></p>
    </div>
</body>
</html>