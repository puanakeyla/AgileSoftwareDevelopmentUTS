<?php

declare(strict_types=1);

require_once __DIR__ . '/task_service.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);
$title = $_POST['title'] ?? '';
$status = $_POST['status'] ?? 'todo';

try {
    $updated = update_task($id, $title, $status);

    if (!$updated) {
        header('Location: ../index.php?error=' . urlencode('Task tidak ditemukan atau status tidak valid.'));
        exit;
    }
} catch (Throwable $e) {
    header('Location: ../index.php?error=' . urlencode($e->getMessage()));
    exit;
}

header('Location: ../index.php?message=' . urlencode('Task berhasil diupdate.'));
exit;
