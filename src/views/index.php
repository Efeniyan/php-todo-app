<?php ob_start(); ?>
 <!-- Ici tout ce qui est entre ob_start et ob_get_clean sont stockés dans le tampon -->

<h1>Ma Todo List </h1>
<a href="">Ajouter une nouvelle tâche</a>
<ul>
    <li>
        <span>Apprendre HTML</span>
        <a href="">✅</a>
        <a href="">❌</a>
    </li>
</ul>

<?php $content = ob_get_clean(); ?>

<?php //htmlspecialchars($content); ?>

<?php include"layout.php"; ?>
