<?php

declare(strict_types=1);

require_once __DIR__ . '/crud/task_service.php';

$tasks = get_tasks();
$message = $_GET['message'] ?? '';
$error = $_GET['error'] ?? '';

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project GitHub - Task CRUD</title>
    <style>
        body { font-family: Segoe UI, sans-serif; margin: 24px; background: #f4f7fb; color: #1f2937; }
        .card { background: white; padding: 16px; border-radius: 10px; box-shadow: 0 6px 16px rgba(0,0,0,0.08); margin-bottom: 16px; }
        h1, h2 { margin-top: 0; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        label { display: block; margin-bottom: 6px; font-weight: 600; }
        input, select { width: 100%; padding: 8px; margin-bottom: 10px; }
        button { padding: 8px 12px; border: 0; background: #0f766e; color: white; border-radius: 6px; cursor: pointer; }
        .btn-link { display: inline-block; text-decoration: none; padding: 10px 14px; background: #155e75; color: #fff; border-radius: 8px; font-weight: 600; }
        .danger { background: #b91c1c; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border-bottom: 1px solid #e5e7eb; padding: 8px; text-align: left; }
        .msg { color: #166534; }
        .err { color: #991b1b; }
        @media (max-width: 800px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <h1>Simple Project Management App</h1>
    <p>Mini board task untuk demo Agile + Git Flow.</p>

    <?php if ($message !== ''): ?>
        <p class="msg"><?= e($message) ?></p>
    <?php endif; ?>

    <?php if ($error !== ''): ?>
        <p class="err"><?= e($error) ?></p>
    <?php endif; ?>

    <div class="grid">
        <div class="card">
            <h2>Buat Task</h2>
            <form method="post" action="crud/create.php">
                <label for="title">Judul Task</label>
                <input id="title" name="title" required>

                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="todo">To Do</option>
                    <option value="in-progress">In Progress</option>
                    <option value="done">Done</option>
                </select>

                <button type="submit">Tambah</button>
            </form>
        </div>

        <div class="card">
            <h2>Data API</h2>
            <p>Endpoint read JSON: <a href="crud/read.php">crud/read.php</a></p>
            <p>Total task: <strong><?= count($tasks) ?></strong></p>
            <p>Ingin halaman create yang lebih fokus?</p>
            <a class="btn-link" href="create.php">Buka Halaman Create</a>
        </div>
    </div>

    <div class="card">
        <h2>Daftar Task</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= (int) $task['id'] ?></td>
                    <td><?= e((string) $task['title']) ?></td>
                    <td><?= e((string) $task['status']) ?></td>
                    <td>
                        <form method="post" action="crud/update.php">
                            <input type="hidden" name="id" value="<?= (int) $task['id'] ?>">
                            <input name="title" value="<?= e((string) $task['title']) ?>" required>
                            <select name="status">
                                <option value="todo" <?= $task['status'] === 'todo' ? 'selected' : '' ?>>To Do</option>
                                <option value="in-progress" <?= $task['status'] === 'in-progress' ? 'selected' : '' ?>>In Progress</option>
                                <option value="done" <?= $task['status'] === 'done' ? 'selected' : '' ?>>Done</option>
                            </select>
                            <button type="submit">Simpan</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="crud/delete.php" onsubmit="return confirm('Hapus task ini?')">
                            <input type="hidden" name="id" value="<?= (int) $task['id'] ?>">
                            <button class="danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
