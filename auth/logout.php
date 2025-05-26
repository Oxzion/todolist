<?php
// Mulai sesi PHP
session_start();

// Hapus semua data session
session_unset();

// Hancurkan sesi
session_destroy();

// Arahkan kembali ke halaman utama
header("Location: ../auth/login.php");
exit();
?>