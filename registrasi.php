<?php
include("connect.php"); // Pastikan Anda sudah memasukkan file koneksi (connect.php)

$username = "";
$password = "";
$err = "";
$message = ""; // Inisialisasi pesan pemberitahuan

if (isset($_POST['Register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Regex untuk memeriksa aturan password
    $password_regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>])[A-Za-z\d!@#$%^&*()\-_=+{};:,<.>.]{8,}$/';

    if ($username == '' or $password == '') {
        $err .= "<li>Silakan masukkan username dan password</li>";
    }

    if (!preg_match($password_regex, $password)) {
        $err .= "<li>Password harus terdiri dari minimal 8 karakter dengan kombinasi huruf besar, huruf kecil, angka, dan simbol.</li>";
    }

    if (empty($err)) {
        $sql1 = "SELECT * FROM user WHERE username = '$username'";
        $q1 = mysqli_query($koneksi, $sql1);
        $r1 = mysqli_fetch_array($q1);

        if (!$r1) { // Jika username belum ada dalam database
            // Mengenkripsi password dengan MD5
            $hashedPassword = md5($password);

            $query = "INSERT INTO user (username, password) VALUES ('$username', '$hashedPassword')";

            if (mysqli_query($koneksi, $query)) {
                $message = "Registrasi berhasil!";
            } else {
                $err = "Registrasi gagal: " . mysqli_error($koneksi);
            }
        } else {
            $err = "Username sudah digunakan. Silakan gunakan username lain.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Smart AC</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/ac.png" type="image/x-icon">
</head>
<body>
    <!-- Form -->
    <div class="container-fluid mt-5">
        <div class="container bg-light rounded-4 p-4">
        <?php
        if ($err) {
            echo "<ul>$err</ul>";
        }
        if ($message) {
            echo "<div class='alert alert-success'>$message</div>";
        }
        ?>
        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" value="<?php echo $username ?>" class="form-control" placeholder="Masukkan Username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
            </div>
            <p>Back to <a href="index.php">Login</a></p>
            <button type="submit" class="btn btn-primary" name="Register">Daftar</button>
        </form>
        </div>
    </div>

    <!-- Logo -->
    <div class="container-fluid mt-5 text-center">
        <div class="row">
            <div class="col-md">
                <a href="registrasi.php"><img src="img/logo-smart.png" alt="Logo Smart AC" width="300px" class="pt-3"></a>
            </div>
        </div>
    </div>

<?php
    include("login_footer.php");
?>