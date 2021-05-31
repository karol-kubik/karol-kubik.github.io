<?php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout Faq</title>
</head>
<body>
<h1>Ajout d'un FAQ</h1>
<form action="FAQADDInsert.php" method="post">
    <p>
        <label for="question">Question</label>
        <input id="question" type="text" name="question">
    </p>
    <p>
        <label for="answer">Réponse</label>
        <input id="answer" type="text" name="answer">
    </p>
    <p><input type="submit" value="enregistrer"></p>
</form>
</body>
</html>
