<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['question_id'])) {
    $koneksi = new mysqli("localhost", "root", "", "my_database");

    $question_id = $koneksi->real_escape_string($_POST['question_id']);
    $delete_query = "DELETE FROM questions WHERE id='$question_id'";

    if ($koneksi->query($delete_query) === TRUE) {
        header("Location: homepage.php"); 
        exit;
    } else {
        echo "Error: " . $koneksi->error;
    }

    $koneksi->close();
} else {
    header("Location: homepage.php"); 
    exit;
}
?>
