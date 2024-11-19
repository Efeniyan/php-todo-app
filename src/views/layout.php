<?php $content = '<h1>Ma Todo List </h1>
<a href="">Ajouter une nouvelle tâche</a>
<ul>
    <li>
        <span>Apprendre HTML</span>
        <a href="">✅</a>
        <a href="">❌</a>
    </li>
</ul>'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
</head>
<body>
    <div class="container">
        <?= $content ?>

    </div>
</body>
</html>