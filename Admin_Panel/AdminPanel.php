<?php

$objetPDO = new PDO('mysql:host=localhost:8889;dbname=contact_aero','root','root');




$pdoStatRequest = $objetPDO-> prepare('Select * from contacts');
$pdoStatContact = $objetPDO-> prepare('Select * from utilisateur');
$pdoStatFAQ = $objetPDO->prepare('Select * from faq_aero');


$executeIsOk = $pdoStatRequest->execute();
$executeIsOkContact = $pdoStatContact -> execute();
$executeIsOkFAQ = $pdoStatFAQ -> execute();

$contacts = $pdoStatRequest->fetchAll();
$users = $pdoStatContact -> fetchAll();
$Faq = $pdoStatFAQ -> fetchAll();


?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin panel</title>
</head>
<body>

<h1> Liste utilisateurs</h1>
<ul>
    <?php foreach ($users as $user):?>
    <li>
       <span><?=$user['id_utilisateur']?> <?=$user['first_name']?> <?=$user['last_name']?> <?= $user['age']?> <?= $user['genre']?> <?= $user['tel']?></span>
    </li>
        <a href="../Utilisateur/supprimer.php?id_utilisateur=<?= $user['id_utilisateur']?>" > Suprrimer l'utilisateur </a>
        <a href="../Utilisateur/user_modification.php?id_utilisateur=<?= $user['id_utilisateur']?>"> Modifier l'utilisateur </a>
    <?php endforeach;?>
</ul>

<h1>Panel FAQ</h1>
<ul>
    <?php foreach($Faq as $question):?>
    <li>
        <?= $question['question']?> <?= $question['answer']?>
    </li>

    <a href="../Partie_FAQ/faq_modification.php?id_faq=<?= $question['id_faq']?>">Modifier</a>
    <a href="../Partie_FAQ/faq_supprimer.php?id_faq=<?= $question['id_faq']?>">supprimer</a>

    <?php endforeach;?>

</ul>
</body>
</html>
