<?php

$connectionDatabase = new PDO('mysql:host=localhost:8889;dbname=contact_aero','root','root');

$pdoStatFaqSup = $connectionDatabase -> prepare('DELETE FROM faq_aero WHERE id_faq=:id_faq LIMIT 1');

$pdoStatFaqSup -> bindValue(':id_faq', $_GET['id_faq'],PDO::PARAM_INT);

$executeIsOk = $pdoStatFaqSup->execute();

if($executeIsOk){
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
