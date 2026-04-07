<?php

declare(strict_types=1);

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
    <title>Create Task - Project GitHub</title>
    <style>
        :root {
            --bg1: #f0f9ff;
            --bg2: #ecfeff;
            --panel: #ffffff;
            --text: #0f172a;
            --muted: #475569;
            --primary: #0f766e;
            --primary-hover: #115e59;
            --danger: #b91c1c;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background: radial-gradient(circle at top right, var(--bg2), var(--bg1));
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .container {
            width: min(680px, 100%);
            background: var(--panel);
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.12);
            overflow: hidden;
        }
        .header {
            padding: 24px;
            background: linear-gradient(135deg, #134e4a, #155e75);
            color: #fff;
        }
        .header h1 {
            margin: 0 0 8px;
            font-size: 1.7rem;
        }
        .header p {
            margin: 0;
            opacity: 0.95;
        }
        .body {
            padding: 22px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        input,
        select {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            margin-bottom: 14px;
            font-size: 1rem;
        }
        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 6px;
        }
        button,
        .back-link {
            border: 0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.95rem;
            text-decoration: none;
            cursor: pointer;
        }
        button {
            background: var(--primary);
            color: #fff;
            font-weight: 600;
        }
        button:hover { background: var(--primary-hover); }
        .back-link {
            background: #e2e8f0;
            color: #1e293b;
        }
        .msg { color: #166534; margin-bottom: 12px; }
        .err { color: var(--danger); margin-bottom: 12px; }
    </style>
</head>
<body>
    <main class="container">
        <section class="header">
            <h1>Create Task</h1>
            <p>Tambahkan task baru dengan tampilan form yang lebih fokus dan nyaman.</p>
        </section>

        <section class="body">
            <?php if ($message !== ''): ?>
                <p class="msg"><?= e($message) ?></p>
            <?php endif; ?>

            <?php if ($error !== ''): ?>
                <p class="err"><?= e($error) ?></p>
            <?php endif; ?>

            <form method="post" action="crud/create.php">
                <label for="title">Judul Task</label>
                <input id="title" name="title" placeholder="Contoh: Setup unit testing" required>

                <label for="status">Status Awal</label>
                <select id="status" name="status">
                    <option value="todo">To Do</option>
                    <option value="in-progress">In Progress</option>
                    <option value="done">Done</option>
                </select>

                <div class="actions">
                    <button type="submit">Simpan Task</button>
                    <a class="back-link" href="index.php">Kembali ke Dashboard</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
