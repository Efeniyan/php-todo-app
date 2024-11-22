<?php ob_start(); ?>
<h1>Ajouter une nouvelle tâche </h1>
<form action="/add" method="post">
    <input type="text" name="task" id="task" placeholder="Entrez la tâche">
    <button type="submit">Ajouter</button>
</form>


<?php $content = ob_get_clean(); ?>

<?php include"layout.php"; ?>
