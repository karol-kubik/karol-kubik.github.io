<?php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout Faq</title>
    <link rel="stylesheet" href="CRUDStyle.css">
</head>
<body>
<div class="info-box">
<h2>Ajout d'une FAQ</h2>
<form action="FAQADDInsert.php" method="post">
    <p class="input-box">
        <label for="question">Question</label>
        <input class="text-input" id="question" type="text" name="question">
    </p>
    <p class="input-box">
        <label for="answer">Réponse</label>
        <input class="text-input" id="answer" type="text" name="answer">
    </p>
    <p><input type="submit" value="enregistrer"></p>
</form>
</div>
</body>
</html>
