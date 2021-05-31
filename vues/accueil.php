<?php 
/**
* Vue : accueil
*/
?>

<?php echo AfficheAlerte($alerte); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connectez-vous</title>
    <link rel="stylesheet" type="text/css" href="connexion-inscription.css">
</head>
<body>
    <div class = "container">
        <p>S'inscrire sur le site : <a href="index.php?cible=utilisateurs&fonction=inscription">Lien</a></p>
        <!--<p>Liste des utilisateurs : <a href="index.php?cible=utilisateurs&fonction=liste">lien</a></p>-->
        <p>Se connecter : <a href="index.php?cible=utilisateurs&fonction=connexion">Lien</a></p>
        <p><a href="..\karol-kubik.github.io\index.html">Retour à l'accueil</a></p>
    </div>
</body>

</html>

