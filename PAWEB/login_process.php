<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $koneksi = new mysqli("localhost", "root", "", "my_database");
    if ($koneksi->connect_error) {
        $_SESSION['error'] = "Gagal terhubung ke database.";
        header("Location: login.php");
        exit();
    }
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username=? AND password=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();   
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: homepage.php");
        exit(); 
    } else {
        $_SESSION['error'] = "Username atau password salah.";
        header("Location: login.php");
        exit(); 
    }
    $koneksi->close();
}
?>
