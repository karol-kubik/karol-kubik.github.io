<?php
$connectionDatabase = new PDO('mysql:host=localhost:8889;dbname=contact_aero','root','root');
$pdoStatModUser = $connectionDatabase -> prepare('SELECT * FROM utilisateur WHERE id_utilisateur = :id_utilisateur');
$pdoStatModUser -> bindValue(':id_utilisateur', $_GET['id_utilisateur'], PDO::PARAM_INT);
$executeIsOk = $pdoStatModUser -> execute();
$UserSelected = $pdoStatModUser -> fetch();
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User modification</title>
    <link rel="stylesheet" href="../Partie_FAQ/CRUDStyle.css">
</head>
<body>
<div class="info-box">
<h2>Modifier un Utilisateur</h2>
<form action="user_update.php" method="post">
    <input type="hidden" name="id_utilisateur" value="<?= $UserSelected['id_utilisateur'] ?> ">
    <p class="input-box">
        <label for="first_name"> Prénom </label>
        <input class="text-input" type="text" id="first_name" name="first_name" value="<?= $UserSelected['first_name'] ?>">
    </p>
    <p class="input-box">
        <label for="last_name"> Nom </label>
        <input class="text-input" type="text" id="last_name" name="last_name" value="<?= $UserSelected['last_name'] ?>">
    </p>
    <p class="input-box">
        <label for="age"> Age </label>
        <input class="text-input" type="text" id="age" name="age" value="<?= $UserSelected['age'] ?>">
    </p>
    <p class="input-box">
        <label for="genre"> Genre </label>
        <input class="text-input" type="text" id="genre" name="genre" value="<?= $UserSelected['genre'] ?>">
    </p>
    <p class="input-box">
        <label for="tel"> Tel </label>
        <input class="text-input" type="text" id="tel" name="tel" value="<?= $UserSelected['tel'] ?>">
    </p>
    <p><input type="submit" value="update"> </p>

</form>
</div>
</body>
</html>
