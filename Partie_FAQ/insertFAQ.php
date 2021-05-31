<?php

$objetPDO = new PDO('mysql:host=localhost:8889;dbname=contact_aero','root','root');

$pdoStatInsertFAQ = $objetPDO ->prepare('INSERT INTO faq_aero VALUES (NULL, :question, :answer )');

$pdoStatInsertFAQ-> bindValue(':question',$_POST['question']);
$pdoStatInsertFAQ-> bindValue(':answer',$_POST['answer']);

$insertIsOKFAQ = $pdoStatInsertFAQ ->execute();

if($insertIsOKFAQ){
    $message = 'Question/Reponse enregistrer';
}else{
    $message = 'echec de l enregistrement';
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reponse enregistrement FAQ</title>
</head>
<body>
<h1>Enregistrement de la réponse:</h1>
<p><?php echo $message?> </p>
</body>
</html>
