<?php
 $objetPDo = new PDO('mysql:host=localhost:8889;dbname=contact_aero','root','root');

$pdoStat = $objetPDo -> prepare('DELETE FROM utilisateur WHERE id_utilisateur=:id_utilisateur LIMIT 1');

$pdoStat->bindValue(':id_utilisateur', $_GET['id_utilisateur'],PDO::PARAM_INT);

$excuteIsOK = $pdoStat-> execute();

if($excuteIsOK){
    $message = "le contact a été supprimer";
}else{
    $message = "echec de la suppression";
};
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>suppression</title>
</head>
<body>
<h1>suppression</h1>
<p><?= $message ?></p>

<a href="../Admin_Panel/AdminPanel.php">retour au panel</a>
</body>
</html>