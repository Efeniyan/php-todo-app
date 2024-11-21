
<?php ob_start(); ?>
<h1>Modifier la tâche</h1>
<form action="/update?id=<?= htmlspecialchars($todoEdit['id']); ?>" method="post">
    <input type="text" name="task" id="task" value="<?= htmlspecialchars($todoEdit['task']); ?>" placeholder="Modifier la tâche" required>
    <label>
        <input type="checkbox" name="done" <?= $todoEdit['done'] ? 'checked' : ''; ?>>
        Marquer comme terminé
    </label>
    <button type="submit">Mettre à jour</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php include "layout.php"; ?>

