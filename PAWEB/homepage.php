<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['question_id'])) {
    $koneksi = new mysqli("localhost", "root", "", "my_database");
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    $question_id = $_POST['question_id'];

    $sql = "DELETE FROM questions WHERE id = $question_id";

    if ($koneksi->query($sql) === TRUE) {
        echo "Pertanyaan berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['jawaban'])) {
    $koneksi = new mysqli("localhost", "root", "", "my_database");
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    $question_id = $_POST['question_id'];
    $jawaban = $koneksi->real_escape_string($_POST['jawaban']); 

    if (empty($jawaban)) {
        header("Location: homepage.php");
        exit;
    }

    $sql = "INSERT INTO answers (answer, question_id) VALUES ('$jawaban', '$question_id')";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: homepage.php");
        exit; 
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Home</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&family=Sedan+SC&display=swap" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="style2.css" rel="stylesheet">
    </head>
    <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light d-md-flex p-3" id="navbar">
        <h2>
        <img src="pict/LOGO.png" alt="Logo" class="logo">
        PREDIKSI
    </h2>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <span class="navbar-text">Welcome, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>!</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#sec2">Tabel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#streamlit">Streamlit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#answer">Pertanyaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">logout</a>
                </li>
            </ul>
        </div>
    </nav>


    <section class="container col text-center p-5" id="sec1">
        <div class="p-5">
            <h2>Selamat datang di web prediksi</h2>
            <p>"Tetaplah terhubung dengan pengetahuan yang tak terbatas!"<br>
            Selamat datang di PREDIKSI, portal pendidikan dari Sekolah Portugal
            . Di sini, kami mengundang Anda untuk menjelajahi beragam topik, mulai dari 
            ilmu pengetahuan hingga menggali pengetahuan yang mendalam serta memperluas wawasan Anda
            . Bersama-sama, mari kita temukan potensi dan menciptakan masa depan yang lebih cerah melalui 
            pengetahuan yang diperoleh di PREDIKSI!
            </p>

        <video id="video-background" controls>
                <source src="pict/2.mp4" type="video/mp4">
            </video>
        </div>
    </section>



    <section class="container col text-center p-5" id="sec2">
        <div class="p-5">
            <h2>Tabel Prediksi</h2>
            <p>Disini hanya menampilkan beberapa tabel prediksi jika ingin melihatnya secara lengkap dan terperinci bisa mengunjingi di link streamlit
            </p>
            <img src="pict/Screenshot 2024-05-10 125640.png" class="mt-5">
            <p>di atas adalah untuk perbandingan banyak gender F untuk perempuan dan M untuk laki laki</p>
            <img src="pict/Screenshot 2024-05-10 125655.png" class="mt-5">
            <p>Dan untuk tabel yang ini untuk melihat rentang umur dari siswa dan siswi</p>
        </div>
    </section>

    <section class="container col text-center " id="streamlit">
        <div class="p-5">
            <h2> Prediksi Prestasi Nilai Siswa</h2>
            <p> Prediksi Prestasi Nilai Siswa di protugal, Kami mendata Nilai dari Siswa dan Siswi dari kisaran umur 15 sampai dengan 20 tahun di beberapa Sekolah di portugal</p>
            <p>Jika Anda tertarik untuk mengunjungi, silakan kunjungi halaman berikut:</p>
            <a href="https://prediksi-prestasi-nilaisiswa.streamlit.app" target="_blank" class="btn btn-primary">Kunjungi</a>
        </div>
    </section>

    <video id="video-background" autoplay muted loop>
                <source src="pict/3.mp4" type="video/mp4">
            </video>
        </div>

    <!-- Pertanyaan Section -->
    <section class="container col text-center" id="ask">
    <div class="p-5">
        <h2>BUAT PERTANYAAN </h2>
        <div class="accordion mt-4" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingAsk">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                         data-target="#collapseAsk" aria-expanded="false" aria-controls="collapseAsk">
                            Tanyakan Pertanyaan Baru
                        </button>
                    </h5>
                </div>
                <div id="collapseAsk" class="collapse" aria-labelledby="headingAsk" data-parent="#accordionExample">
                    <div class="card-body">
                        <!-- Form untuk menyimpan pertanyaan -->
                        <form method="post" action="save_question.php">
                            <div class="form-group">
                                <label for="questions">Pertanyaan Anda:</label>
                                <textarea class="form-control" id="questions" name="questions" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim Pertanyaan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Form pencarian -->
<section class="container col text-center mt-5" id="answer">
    <form class="mt-4" method="GET">
        <div class="form-group">
            <input type="text" class="form-control" id="search" name="search" 
            placeholder="Search questions..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        </div>
    </form>
    <div id="searchResults"></div>
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
    if(isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $query .= " WHERE question LIKE '%$search%'";
    }

    $query .= " ORDER BY created_at DESC"; 

    $result = $koneksi->query($query);

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="pertanyaan">';
            echo '<p>Pertanyaan : ' . $row["question"] . '</p>';

            // Menampilkan jawaban jika ada
            $question_id = $row["id"];
            $query_check_answer = "SELECT * FROM answers WHERE question_id = $question_id";
            $result_check_answer = $koneksi->query($query_check_answer);

            if ($result_check_answer && $result_check_answer->num_rows > 0) {
                while($row_jawaban = $result_check_answer->fetch_assoc()) {
                    echo '<div class="jawaban">';
                    echo '<p>Jawaban: ' . $row_jawaban["answer"] . '</p>';
                    echo '</div>';
                }
            }

            // Form untuk mengirim jawaban
            echo '<form action="homepage.php" method="POST">';
            echo '<input type="hidden" name="question_id" value="' . $question_id . '">';
            echo '<div class="form-group">';
            echo '<label for="jawaban">Jawaban Anda:</label>';
            echo '<textarea class="form-control" id="jawaban" name="jawaban" rows="3"></textarea>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Kirim Jawaban</button>';
            echo '</form>';

            echo '</div>';
        }
    } else {
        echo "Tidak ada pertanyaan yang ditemukan.";
    }
    ?>
</section>

    <!-- Contact Section -->
    <section id="contact" class="mt-5">
        <div class="container">
            <h2>Contact Us</h2>
            <div class="mt-4">
                <a href="#" target="_blank" rel="noopener noreferrer">
                    <img src="pict/Gmail.png" alt="#" width="50" height="50">
                </a>
                <a href="https://www.instagram.com/tasisportugal/" target="_blank" rel="noopener noreferrer">
                    <img src="pict/IG.jpeg" alt="#" width="50" height="50">
                </a>
                <a href="#" target="_blank" rel="noopener noreferrer">
                    <img src="pict/WA.jpeg" alt="#" width="50" height="50">
                </a>
            </div>
            <hr class="middle-line">
            <div class="p-4 mt-2">
                <a href="#" target="_blank" rel="noopener noreferrer">
                    <span class="copy-right">&copy;</span> <span class="contact-info">kelompok 12</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and other scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
