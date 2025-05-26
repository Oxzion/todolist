<?php
session_start();
include '../../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO tasks (user_id, title, description, due_date, status)
              VALUES ('$user_id', '$title', '$desc', '$due_date', '$status')";

    if (mysqli_query($conn, $query)) {
        header("Location: ../index.php");
        exit();
    } else {
        die("Gagal menyimpan tugas: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../../css/style.css" />
    <title>Tambah Tugas</title>
</head>
<body>
    <div class="login-container">
        <h2>Tambah Tugas</h2>
        <form method="post">
            <label>Judul</label>
            <input type="text" name="title" required>

            <label>Deskripsi</label>
            <textarea name="description"></textarea>

            <label>Tanggal Jatuh Tempo</label>
            <input type="date" name="due_date">

            <label>Status</label>
            <select name="status">
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>

            <button type="submit" name="submit">Simpan</button>
        </form>
    </div>
</body>
</html>