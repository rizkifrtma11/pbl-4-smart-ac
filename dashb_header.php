<?php
session_start();

// Mengecek apakah pengguna sudah login atau belum
if (!isset($_SESSION['user_username'])) {
    header("Location: index.php"); // Jika belum, redirect ke halaman login
    exit();
}

// Koneksi ke database
include("connect.php");

// Mengambil nama pengguna dari database
$username = $_SESSION['user_username'];
$query = "SELECT nama FROM user WHERE username = '$username'";
$result = mysqli_query($koneksi, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nama_pengguna = $row['nama'];
} else {
    // Handle jika data nama tidak ditemukan
    $nama_pengguna = "Pengguna"; // Default
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart AC System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="fontawesome/css/all.css" />
    <link rel="shortcut icon" href="img/ac.png" type="image/x-icon">
</head>
<body>

<!-- Start navbar -->
<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container">
        <a class="navbar-brand text-light" href="">Smart AC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link text-light hover-list" href="dashboard.php">Dashboard</a>
                <a class="nav-link text-light hover-list" href="remote_ac.php">Remote AC</a>
                <a class="nav-link text-light hover-list" href="esp_database/index.html">Riwayat Penggunaan</a>
                <a class="nav-link text-light hover-list" href="logout.php">Logout</a>
            </div>
            
            <!-- Menampilkan nama pengguna di navbar -->
            <div class="navbar-nav ms-auto">
                <span class="nav-item nav-link text-light">Selamat Datang, <?php echo $nama_pengguna; ?></span>
            </div>
        </div>
    </div>
</nav>
<!-- End navbar -->

<!-- Bootstrap JS -->
<script src="jQuery/jquery-3.3.1.slim.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
