<! doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout question</title>
    <link rel="stylesheet" href="CRUDStyle.css">
</head>
<body>
<h1>Ajouter une question à la FAQ</h1>
<div class="info_box">
<form  action="insertFAQ.php" method="post">
    <p class="input-box">
        <label for="question">question</label>
        <input id="question" type="text" name="question" class="text-input">
    </p>
    <p class="input-box">
        <label for="answer">answer</label>
        <input id="answer" type="text" name="answer" class="text-input">
    </p>
    <span> <input type="submit" value="Save"> </span>
</form>
</div>
</body>
</html>
