<?php

$objetPDo = new PDO('mysql:host=localhost:8889;dbname=contact_aero','root','root');

$pdoStat = $objetPDo -> prepare('INSERT INTO contacts VALUES (NULL ,:first_name,:last_name,:email,:request)');

$pdoStat->bindValue(':first_name',$_POST['prenom']);
$pdoStat->bindValue(':last_name',$_POST['nfamille']);
$pdoStat->bindValue(':email',$_POST['mail']);
$pdoStat->bindValue(':request',$_POST['demande']);

$insertisOK = $pdoStat->execute();

if($insertisOK){
    $message = 'le demande a été envoyé';
}else{
    $message = 'echec de l enregistrement';
}
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <h1>Contact admin</h1>
        <p> <?php echo $message ?></p>
    </body>

</html>

