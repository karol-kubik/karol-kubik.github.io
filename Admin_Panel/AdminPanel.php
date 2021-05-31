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
    <script src="https://kit.fontawesome.com/c4ed8ae3a6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="StyleAdminPanel.css">
</head>
<body>
<header>
    <h1 class="titre">BACK OFFICE AEROPEX</h1>
</header>

<h1> <i class="fas fa-users"></i> Liste utilisateurs <i class="fas fa-users"></i> </h1>

<ul>
    <?php foreach ($users as $user):?>
    <li>
       <span><?=$user['id_utilisateur']?>       <?=$user['first_name']?> <?=$user['last_name']?>     <?= $user['age']?> <?= $user['genre']?>    <?= $user['tel']?></span>
    </li>
        <a onclick="confirmationModUser()" href="../Utilisateur/user_modification.php?id_utilisateur=<?= $user['id_utilisateur']?>"> <i class="fas fa-user-edit"></i> </a>
        <a onclick="confirmationDelUser()" href="../Utilisateur/supprimer.php?id_utilisateur=<?= $user['id_utilisateur']?>" > <i class="fas fa-user-slash"></i> </a>

    <?php endforeach;?>
</ul>

<h1> <i class="fas fa-comments"></i>  Panel FAQ <i class="fas fa-comments"></i> </h1>
<a href="../Partie_FAQ/faq_add.php"> <i class="fas fa-comment-medical"></i> Ajout d'une Faq</a>
<ul>

    <?php foreach($Faq as $question):?>
    <li>
        <?= $question['question']?> <br/> <?= $question['answer']?>
    </li>

    <a onclick="confirmationModFaq()" href="../Partie_FAQ/faq_modification.php?id_faq=<?= $question['id_faq']?>"> <i class="fas fa-pen-square"></i> </a>
    <a onclick="confirmationDelFaq()" href="../Partie_FAQ/faq_supprimer.php?id_faq=<?= $question['id_faq']?>"> <i class="fas fa-trash-alt"></i> </a>

    <?php endforeach;?>


</ul>
<script>
    function confirmationModUser(){
        return confirm("Voulez-vous modifier cet utilisateur?");
    }
    function confirmationDelUser(){
        return confirm("Voulez-vous supprimer cet utilisateur?");
    }
    function confirmationModFaq(){
        return confirm("Voulez-vous modifier cet Faq?");
    }
    function confirmationDelFaq(){
        return confirm("Voulez-vous modifier cet utilisateur?");
    }
</script>

</body>
</html>
