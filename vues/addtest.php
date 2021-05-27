<?php
/**
 * Vue : ajouter les réslutaltats des tests
 */
?>

<?php echo AfficheAlerte($alerte); ?>

<form method="POST" action="">

    <label>Nom :</label>
    <input type="text"  name="nom" required/><br>

    <label>Prénom :</label>
    <input type="text"  name="prenom" required/><br>

    <label>BPM :</label>
    <input type="text"  name="bpm"/><br>

    <label>Temps de réaction :</label>
    <input type="text"  name="reaction"  /><br>

    <label>Température :</label>
    <input type="text"  name="temp"  /><br>

    <label>Date du test :</label>
    <input type="date"  name="testdate"  /><br>

    <button type="submit" name="submit">Enregistrer</button>

</form>
