<?php
$host = "localhost";
$username = "root";
$password = ""; // biasanya kosong di XAMPP
$database = "todo_app";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>