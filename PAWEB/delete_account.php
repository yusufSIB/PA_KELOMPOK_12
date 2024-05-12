<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_account'])) {
    $koneksi = new mysqli("localhost", "root", "", "my_database");

    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    $username = $_SESSION['username'];

    $sql = "DELETE FROM users WHERE username = '$username'";

    if ($koneksi->query($sql) === TRUE) {
        session_unset();
        session_destroy();

        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();
}
?>
