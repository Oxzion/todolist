<?php
session_start();
include '../../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM tasks WHERE id = $id AND user_id = $user_id";
$result = mysqli_query($conn, $query);
$task = mysqli_fetch_assoc($result);

if (!$task) {
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $query = "UPDATE tasks SET title='$title', description='$desc', due_date='$due_date', status='$status' WHERE id=$id";
    mysqli_query($conn, $query);
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../../css/style.css" />
    <title>Edit Tugas</title>
</head>
<body>
    <div class="login-container">
        <h2>Edit Tugas</h2>
        <form method="post">
            <label>Judul</label>
            <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>

            <label>Deskripsi</label>
            <textarea name="description"><?= htmlspecialchars($task['description']) ?></textarea>

            <label>Tanggal Jatuh Tempo</label>
            <input type="date" name="due_date" value="<?= $task['due_date'] ?>">

            <label>Status</label>
            <select name="status">
                <option value="pending" <?= $task['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="completed" <?= $task['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
            </select>

            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>