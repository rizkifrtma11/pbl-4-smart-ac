<?php
session_start();
$err = "";

// Batas percobaan login user
function limit_login_attempts($username) {
    $max_attempts = 3; // Jumlah maksimal percobaan login 3 kali
    $lockout_time = 60; // Waktu dalam detik untuk mengunci akun setelah melebihi batas percobaan

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
    $err .= "<li>Anda memasukkan password salah. Coba lagi dalam 1 menit.</li>";
} else {
    // memvalidasi percobaan login
    limit_login_attempts($username);

    if (isset($_POST['Login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userCaptcha = $_POST['captcha'];

        if ($username == '' or $password == '' or $userCaptcha == '') {
            $err .= "<li>Silahkan masukkan username, password, dan captcha</li>";
        }

        // Validasi captcha
        if ($userCaptcha !== $_SESSION['code']) {
            $err .= "<li>Captcha salah</li>";
        }

        if (empty($err)) {
            $sql1 = "select * from user where username = '$username'";
            $q1 = mysqli_query($koneksi, $sql1);
            $r1 = mysqli_fetch_array($q1);

            if ($r1 && $r1['password'] == md5($password)) {
                $_SESSION['admin_username'] = $username;
                // Mereset login limit saat login sukses
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
                    <a class="nav-link text-light hover-list" href="features.php">Features</a>
                    <a class="nav-link text-light hover-list" href="project_dev.php">Project Developer</a>
                    <a class="nav-link text-light hover-list" href="index.php">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- End navbar -->

    <!-- Start form -->
    <div class="container-fluid mt-5">
        <div class="container bg-light rounded-4 p-4">
            <?php
            if ($err) {
                echo "<ul>$err</ul>";
            }
            ?>

            <form method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="username" value="<?php echo $username ?>" id="exampleInputEmail1" class="form-control" placeholder="Masukkan Username">
                    <div id="emailHelp" class="form-text">Pastikan anda mengisi dengan username yang sudah teregistrasi!</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="captcha" class="form-label">Masukkan Captcha dibawah ini</label> <br>
                    <img src="captcha.php" alt="Captcha Image" /> <br> <br>
                    <input type="text" name="captcha" class="form-control" placeholder="Enter Captcha Code" id="captcha">
                </div>
                <p>Tidak punya akun? <a href="registrasi.php">Registrasi Sekarang!</a></p>
                <button type="submit" class="btn btn-primary" name="Login">Login</button>
            </form>
        </div>
    </div>
    <!-- End form -->
