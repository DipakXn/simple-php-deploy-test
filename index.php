<?php
require 'config.php';

// Handle Form Submission (Add Task)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task_name'])) {
    $stmt = $pdo->prepare("INSERT INTO tasks (task_name) VALUES (?)");
    $stmt->execute([$_POST['task_name']]);
    header("Location: index.php");
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: index.php");
    exit;
}

// Fetch Tasks
$tasks = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Git Deployment Test</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>🚀 Git Deployment Test</h1>
        <p class="subtitle">If you can see this, your cPanel Git deployment works!</p>

        <form method="POST" class="task-form">
            <input type="text" name="task_name" placeholder="Enter a new task..." required>
            <button type="submit">Add Task</button>
        </form>

        <ul class="task-list">
            <?php if (empty($tasks)): ?>
                <li class="empty">No tasks yet. Add one above!</li>
            <?php else: ?>
                <?php foreach ($tasks as $task): ?>
                    <li>
                        <span><?= htmlspecialchars($task['task_name']) ?></span>
                        <a href="?delete=<?= $task['id'] ?>" class="delete-btn">✕</a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>