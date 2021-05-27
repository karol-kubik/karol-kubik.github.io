<?php
/**
 * Vue : modification données utilisateur
 */
?>

session_start();

<?php echo AfficheAlerte($alerte); ?>

<?php foreach ($liste as $element) { ?>

<h2>Modifier mes données personnels :</h2>
<form method="POST" action="">

    <label>Adresse Mail :</label>
    <input type="text"  name="username" value ="<?php echo $element['username']; ?>" required/><br>

    <label>Mot de passe :</label>
    <input type="password"  name="password" value ="<?php echo $element['password']; ?>" required/><br>

    <label>Confirmer le mot de passe :</label>
    <input type="password"  name="confirm"  /><br>

    <label>Nom :</label>
    <input type="text"  name="nom" value ="<?php echo $element['nom']; ?>" required/><br>

    <label>Prénom :</label>
    <input type="text"  name="prenom" value ="<?php echo $element['prenom']; ?>" required/><br>

    <label>Date de naissance :</label>
    <input type="date"  name="birth" value ="<?php echo $element['birth']; ?>" required/><br>

    <button type="submit" name="submit">Modifier</button>

</form>

<?php } ?>

<?php if(isset($alerte)) { echo AfficheAlerte($alerte);} ?>

<p>
    <a href="../karol-kubik.github.io/index.php">Retour</a>
</p>
