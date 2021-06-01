<?php

$objetPDO = new PDO('mysql:host=localhost:8889;dbname=contact_aero','root','root');

$pdoStatModFAQ = $objetPDO->prepare('Select * From faq_aero Where id_faq = :id_faq');

$pdoStatModFAQ -> bindValue(':id_faq',$_GET['id_faq'],PDO::PARAM_INT);

$executeIsOk = $pdoStatModFAQ->execute();

$faqSelected = $pdoStatModFAQ->fetch();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CRUDStyle.css">
    <title>modification faq</title>
</head>
<body>
<div class="info-box">
<h2>Modifier Faq</h2>
<form action="update_faq.php" method="post">
    <input class="text-input" type="hidden" name="id_faq" value="<?= $faqSelected['id_faq'] ?>" >
    <p class="input-box">
        <label for="question">Question</label>
        <input  class="text-input" type="text" id="question" name="question" value="<?= $faqSelected['question']; ?>">
    </p>
    <p class="input-box">
        <label for="answer">Reponse</label>
        <input class="text-input" type="text" id="answer" name="answer" value="<?= $faqSelected['answer']; ?>">
    </p>
    <p><input type="submit" value="update"> </p>


</form>
</div>
</body>
</html>

