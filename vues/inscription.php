<?php 
/**
* Vue : inscrire un nouvel utilisateur
*/
?>

<?php echo AfficheAlerte($alerte); ?>

<form method="POST" action="">
	
	<label>Adresse Mail :</label>
	<input type="text"  name="username" required/><br>
	
	<label>Mot de passe :</label>
	<input type="password"  id="mdp" name="password" required/><br>

    <label>Confirmer le mot de passe :</label>
    <input type="password"  name="confirm"  required/><br>

    <label>Nom :</label>
    <input type="text"  name="nom" required/><br>

    <label>Prénom :</label>
    <input type="text"  name="prenom"  required/><br>

    <label>Sexe :</label>
    <input type="radio" id="homme" name="gender" value="1"
           checked>
    <label for="homme">Homme</label>

    <input type="radio" id="femme" name="gender" value="0"
           checked>
    <label for="femme">Femme</label><br>

    <label>Date de naissance :</label>
    <input type="date"  name="birth"  required/><br>

    <label>Type :</label>
    <input type="radio" id="eleve" name="instructor" value="0"
           checked>
    <label for="eleve">Élève</label>

    <input type="radio" id="formateur" name="instructor" value="1">
    <label for="formateur">Formateur</label><br>

    <button type="submit" name="submit">S'inscrire</button>

</form>

<p><a href="index.php">Retour</a></p>