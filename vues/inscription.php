<?php 
/**
* Vue : inscrire un nouvel utilisateur
*/
?>

<?php echo AfficheAlerte($alerte); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Inscrivez-vous</title>
        <link rel="stylesheet" type="text/css" href="inscription.css">
    </head>
    <body>
        <div class="center">
            <h1>INSCRIPTION</h1>
            <form method="POST" action="">
                <div class="txt_field">
                    <label>Adresse Mail :</label>
                    <input type="text"  name="username" required/><br>
                </div>
                <div class="txt_field">
                    <label>Mot de passe :</label>
                    <input type="password"  id="mdp" name="password" required/><br>
                </div>

                <div class="txt_field">
                    <label>Confirmer le mot de passe :</label>
                    <input type="password"  name="confirm"  required/><br>
                </div>

                <div class="txt_field">
                    <label>Nom :</label>
                    <input type="text"  name="nom" required/><br>
                </div>

                <div class="txt_field">
                    <label>Prénom :</label>
                    <input type="text"  name="prenom"  required/><br>
                </div>

                <label>Sexe :</label>
                    <input type="radio" id="homme" name="gender" value="1" checked>
                <label for="homme">Homme</label>

                <input type="radio" id="femme" name="gender" value="0" checked>
                <label for="femme">Femme</label><br>

                <div class="txt_field">
                    <p>Date de naissance :</p>
                    <!--<label>Date de naissance :</label>-->
                    <input id="birth" type="date"  name="birth"  required/><br>
                </div>

                <label>Type :</label>
                <input type="radio" id="eleve" name="instructor" value="0" checked>
                <label for="eleve">Élève</label>

                <input type="radio" id="formateur" name="instructor" value="1">
                <label for="formateur">Formateur</label><br>

                <button type="submit" name="submit">S'inscrire</button>
            </form>
            <p class="back"><a href="index.php">Retour</a></p>
        </div>
    </body>
</html>