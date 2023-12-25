<?php
session_start();
$err = "";

if (isset($_SESSION['admin_username'])) {
    header("location: dashboard.php");
    exit();
}

include("connect.php");

$username = "";
$password = "";

if (isset($_POST['Login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userCaptcha = $_POST['captcha'];

    if ($username == '' or $password == '' or $userCaptcha == '') {
        $err .= "<li>Silahkan masukkan username, password, dan captcha</li>";
    }

    // Validate captcha
    if ($userCaptcha !== $_SESSION['code']) {
        $err .= "<li>Captcha salah</li>";
    }

    if (empty($err)) {
        $sql1 = "select * from user where username = '$username'";
        $q1 = mysqli_query($koneksi, $sql1);
        $r1 = mysqli_fetch_array($q1);

        if ($r1 && $r1['password'] == md5($password)) {
            $_SESSION['admin_username'] = $username;
            header("location: dashboard.php");
            exit();
        } else {
            $err .= "<li>Password atau username salah</li>";
            $err .= "<li>Akun tidak ditemukan, harap hubungi admin</li>";
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
