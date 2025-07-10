<?php
if (!file_exists("tasks.txt")) {
    file_put_contents("tasks.txt", "");
}

if (isset($_POST['task']) && !empty(trim($_POST['task']))) {
    $task = trim($_POST['task']) . "\n";
    file_put_contents("tasks.txt", $task, FILE_APPEND);
}

if (isset($_GET['delete'])) {
    $lines = file("tasks.txt", FILE_IGNORE_NEW_LINES);
    unset($lines[$_GET['delete']]);
    file_put_contents("tasks.txt", implode("\n", $lines));
}

$tasks = file("tasks.txt", FILE_IGNORE_NEW_LINES);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma liste de tâches</title>
</head>
<body>
    <h1>Ma liste de tâches</h1>

    <form method="POST">
        <input type="text" name="task" placeholder="Nouvelle tâche">
        <button type="submit">Ajouter</button>
    </form>

    <ul>
        <?php foreach ($tasks as $index => $task): ?>
            <li>
                <?= htmlspecialchars($task) ?>
                <a href="?delete=<?= $index ?>" onclick="return confirm('Supprimer cette tâche ?')">🗑</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
