<?php
include("connect.php");

$resetMessage = ''; // Initialize reset message

if (isset($_POST['reset'])) {
    $resetUsername = $_POST['reset_username'];
    $resetPassword = $_POST['reset_password'];

    // Validate if the username exists in the database
    $validateQuery = "SELECT * FROM user WHERE username = '$resetUsername'";
    $validateResult = mysqli_query($koneksi, $validateQuery);

    if (mysqli_num_rows($validateResult) > 0) {
        // Username exists, proceed with password reset

        // Validate password using regex
        $password_regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>])[A-Za-z\d!@#$%^&*()\-_=+{};:,<.>.]{8,}$/';
        if (preg_match($password_regex, $resetPassword)) {
            $hashedResetPassword = md5($resetPassword); // Hash password reset

            $resetQuery = "UPDATE user SET password = '$hashedResetPassword' WHERE username = '$resetUsername'";

            if (mysqli_query($koneksi, $resetQuery)) {
                $resetMessage = "Password pengguna berhasil direset!";
            } else {
                $resetMessage = "Gagal mereset password pengguna: " . mysqli_error($koneksi);
            }
        } else {
            $resetMessage = "Password harus memenuhi persyaratan keamanan.";
        }
    } else {
        // Username does not exist
        $resetMessage = "Username tidak ditemukan. Silakan masukkan username yang valid.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Smart AC</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="img/ac.png" type="image/x-icon">
</head>
<body>
<div class="container mt-5">
    <!-- Logo -->
    <div class="container-fluid mt-2 mb-4 text-center">
        <div class="row">
            <div class="col-md">
                <a href="registrasi.php"><img src="img/logo-smart.png" alt="Logo Smart AC" width="200px" class="pt-3"></a>
            </div>
        </div>
    </div>
    <h2>Reset Password</h2>
    <?php
    if (!empty($resetMessage)) {
        // Change class based on success or error
        $alertClass = (strpos($resetMessage, 'berhasil') !== false) ? 'alert-success' : 'alert-danger';
        echo "<div class='alert $alertClass'>$resetMessage</div>";
    }
    ?>
    <form method="post">
        <div class="form-group">
            <label for="reset_username">Username</label>
            <input type="text" name="reset_username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="reset_password">New Password</label>
            <input type="password" name="reset_password" class="form-control" required>
            <small>Password harus terdiri dari minimal 8 karakter dengan kombinasi huruf besar, huruf kecil, angka, dan simbol</small>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-warning" name="reset">Reset Password</button>
            <a href="index.php" class="btn btn-secondary">Back to Login</a>
        </div>
    </form>
</div>

<!-- Tambahkan Bootstrap JS -->
<script src="jQuery/jquery-3.3.1.slim.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
