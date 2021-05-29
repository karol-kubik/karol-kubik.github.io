<?php

$objetPDO = new PDO('mysql:host=localhost:8889;dbname=contact_aero','root','root');
$pdoStatUpdateFAQ = $objetPDO-> prepare('Update faq_aero set question=:question, answer=:answer WHERE id_faq=:id_faq LIMIT 1');

$pdoStatUpdateFAQ -> bindValue(':id_faq',$_POST['id_faq'],PDO::PARAM_INT);

$pdoStatUpdateFAQ-> bindValue(':question', $_POST['question'], PDO::PARAM_STR);
$pdoStatUpdateFAQ-> bindValue(':answer', $_POST['answer'], PDO::PARAM_STR);

$executeIsOk = $pdoStatUpdateFAQ->execute();

if($executeIsOk){
    $message = 'le contact est mis à jour';
}else{
    $message = 'update error';
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Update?</title>
</head>
<body>
<p>
    <?php echo $message ?> </p>
</body>

<a href="../Admin_Panel/AdminPanel.php"> Retour Admin Panel</a>

</html>
