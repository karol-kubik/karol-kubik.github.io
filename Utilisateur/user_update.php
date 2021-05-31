<?php


$connectionDatabase = new PDO('mysql:host=localhost:8889;dbname=contact_aero','root','root');
$pdoStatUpdateUser = $connectionDatabase -> prepare('UPDATE utilisateur  SET     first_name=:first_name, 
                                                                                        last_name=:last_name, 
                                                                                        age=:age, 
                                                                                        genre=:genre, 
                                                                                        tel=:tel 
                                                                                        WHERE id_utilisateur=:id_utilisateur LIMIT 1');


$pdoStatUpdateUser -> bindValue(':id_utilisateur',      $_POST['id_utilisateur'],PDO::PARAM_INT);

$pdoStatUpdateUser -> bindValue(':first_name',  $_POST['first_name'], PDO::PARAM_STR);
$pdoStatUpdateUser -> bindValue(':last_name',   $_POST['last_name'], PDO::PARAM_STR);
$pdoStatUpdateUser -> bindValue(':age',         $_POST['age'], PDO::PARAM_INT);
$pdoStatUpdateUser -> bindValue(':genre',       $_POST['genre'], PDO::PARAM_STR);
$pdoStatUpdateUser -> bindValue(':tel',         $_POST['tel'], PDO::PARAM_INT);

$executeIsOk = $pdoStatUpdateUser -> execute();

if($executeIsOk){
    $message = 'l utilisateur est mis à jour';
}else{
    $message = 'update error';
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Update</title>
</head>
<body>
<h1>Update de l'utilisateur</h1>
<p>
    <?php echo $message ?>
</p>

<a href="../Admin_Panel/AdminPanel.php">Retour au admin panel</a>
</body>
</html>
