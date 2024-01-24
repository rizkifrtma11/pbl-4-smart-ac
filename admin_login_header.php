<?php
session_start();
if (isset($_SESSION['admin_username'])) {
    header("location: dashboardmin.php");
    exit();
}

include("connect.php"); // Make sure to include your connection file (connect.php)

$username = "";
$password = "";
$err = "";

if (isset($_POST['Login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == '' or $password == '') {
        $err .= "Silahkan masukkan username dan password";
    }

    if (empty($err)) {
        $sql1 = "SELECT username, password FROM admin WHERE username = '$username'";
        $q1 = mysqli_query($koneksi, $sql1);
        $r1 = mysqli_fetch_array($q1);

        if ($r1 && md5($password) == $r1['password']) {
            $_SESSION['admin_username'] = $username;
            header("location: dashboardmin.php");
            exit();
        } else {
            $err .= "Akun tidak ditemukan, harap hubungi admin";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart AC</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/ac.png" type="image/x-icon">
</head>
<body>
    <!-- Start navbar -->
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand text-light" href="#">Smart AC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link text-light hover-list" href="features.php">Latar Belakang</a>
                    <a class="nav-link text-light hover-list" href="project_dev.php">Pengembang Project</a>
                    <a class="nav-link text-light hover-list" href="index.php">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- End navbar -->
</body>
</html>
