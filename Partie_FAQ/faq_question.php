<! doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout question</title>
</head>
<body>
<h1>Ajouter une question à la FAQ</h1>
<form action="insertFAQ.php" method="post">
    <p>
        <label for="question">question</label>
        <input id="question" type="text" name="question">
    </p>
    <p>
        <label for="answer">answer</label>
        <input id="answer" type="text" name="answer">
    </p>
    <span> <input type="submit" value="Save"> </span>
</form>
</body>
</html>
