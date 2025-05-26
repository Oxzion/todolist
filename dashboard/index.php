<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM tasks WHERE user_id = $user_id ORDER BY due_date ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../css/style.css" />
    <title>To-Do List</title>
</head>
<body>
    <div class="container">
        <h2>Halo, <?php echo $_SESSION['username']; ?>!</h2>
        <a href="../auth/logout.php" class="logout-btn">Logout</a>
    </a>
        <a href="task/create.php" class="btn btn-primary">➕ Tambah Tugas Baru</a>
        
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Jatuh Tempo</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($task = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= htmlspecialchars($task['title']) ?></td>
                    <td><?= htmlspecialchars($task['description']) ?></td>
                    <td><?= $task['due_date'] ?></td>
                    <td><?= ucfirst($task['status']) ?></td>
                    <td>
                        <a href="task/edit.php?id=<?= $task['id'] ?>">Edit</a>
                        <a href="task/delete.php?id=<?= $task['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>