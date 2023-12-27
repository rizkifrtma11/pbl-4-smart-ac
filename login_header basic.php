<?php
session_start();
$err = "";

// Function to limit login attempts
function limit_login_attempts($username) {
    $max_attempts = 3; // Jumlah maksimal percobaan login
    $lockout_time = 5; // Waktu dalam detik untuk mengunci akun setelah melebihi batas percobaan

    if (!isset($_SESSION['login_attempts'][$username])) {
        $_SESSION['login_attempts'][$username] = 0;
    }

    $_SESSION['login_attempts'][$username]++;

    if ($_SESSION['login_attempts'][$username] > $max_attempts) {
        // Blokir atau tunda akses ke akun untuk jangka waktu tertentu
        $_SESSION['login_blocked'][$username] = time() + $lockout_time;
        // Mungkin Anda ingin memberikan pesan kesalahan kepada pengguna di sini
    }
}

if (isset($_SESSION['admin_username'])) {
    header("location: dashboard.php");
    exit();
}

include("connect.php");

$username = "";
$password = "";

// Check if user is blocked
if (isset($_SESSION['login_blocked'][$username]) && $_SESSION['login_blocked'][$username] > time()) {
    $err .= "<li>Akun Anda terkunci. Coba lagi dalam 1 menit.</li>";
} else {
    // Validate login attempts
    limit_login_attempts($username);

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
                // Reset login attempts upon successful login
                $_SESSION['login_attempts'][$username] = 0;
                header("location: dashboard.php");
                exit();
            } else {
                $err .= "<li>Akun tidak ditemukan, harap hubungi admin.</li>";
            }
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
