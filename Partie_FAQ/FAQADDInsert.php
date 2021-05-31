<?php
$connextionDatabase = new PDO('mysql:host=localhost:8889;dbname=contact_aero','root','root');

$pdoStatAdd = $connextionDatabase -> prepare('INSERT INTO faq_aero VALUES (NULL, :question, :answer)' );

$pdoStatAdd-> bindValue(':question',$_POST['question']);
$pdoStatAdd-> bindValue(':answer',$_POST['answer']);

$InsertIsOK = $pdoStatAdd -> execute();

if($InsertIsOK){
    $message = 'insert is oK ';
}else{$message='ERROR';}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmation ajout faq</title>
</head>
<body>
    <h1>Add Faq</h1>
    <p> <?php echo $message ?> </p>

<a href="../Admin_Panel/AdminPanel.php">retour admin panel</a>
</body>
</html>
