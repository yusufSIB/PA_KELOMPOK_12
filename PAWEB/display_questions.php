<?php
$host = 'localhost'; 
$user = 'root'; 
$password = ''; 
$database = 'my_database'; 

$koneksi = new mysqli($host, $user, $password, $database);
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$query = "SELECT * FROM questions";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    echo "<h2>Daftar Pertanyaan</h2>";
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["question"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Tidak ada pertanyaan yang ditemukan.";
}
$koneksi->close();
?>
