<?php
include("connect.php");

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    if (isset($_POST['update'])) {
        $newUsername = $_POST['new_username'];
        $newPassword = $_POST['new_password']; // Tambahkan input untuk password baru
        $hashedPassword = md5($newPassword); // Hash password baru

        $query = "UPDATE user SET username = '$newUsername', password = '$hashedPassword' WHERE id = $userId";
        if (mysqli_query($koneksi, $query)) {
            $message = "Data pengguna berhasil diperbarui!";

            // Setelah berhasil menyunting, arahkan kembali ke halaman data.php
            header("Location: data.php");
            exit();
        } else {
            $message = "Gagal memperbarui data pengguna: " . mysqli_error($koneksi);
        }
    }

    $query = "SELECT id, username, password FROM user WHERE id = $userId";
    $result = mysqli_query($koneksi, $query);
    $userData = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Smart AC</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="img/ac.png" type="image/x-icon">
</head>
<body>
<div class="container mt-5">
    <h2>Edit User</h2>
    <?php
    if (isset($message)) {
        echo "<div class='alert alert-success'>$message</div>";
    }
    ?>
    <form method="post">
        <div class="form-group">
            <label for="new_username">New Username</label>
            <input type="text" name="new_username" class="form-control" value="<?php echo $userData['username']; ?>">
        </div>
        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" name="new_password" class="form-control">
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary" name="update">Update</button>
            <a href="data.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<!-- Tambahkan Bootstrap JS -->
<script src="jQuery/jquery-3.3.1.slim.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
