<?php

class Admin {
    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    public function deleteUser($userId) {
        $query = "DELETE FROM user WHERE id = $userId";
        if (mysqli_query($this->koneksi, $query)) {
            return "Pengguna berhasil dihapus!";
        } else {
            return "Gagal menghapus pengguna: " . mysqli_error($this->koneksi);
        }
    }

    public function getUserData() {
        $query = "SELECT id, nama, username, password, tgl_buat FROM user";
        $result = mysqli_query($this->koneksi, $query);
        $userData = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $userData[] = $row;
        }

        return $userData;
    }
}

// Membuat objek Admin dan menyertakan koneksi
$admin = new Admin($koneksi);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User - Smart AC</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="img/ac.png" type="image/x-icon">
</head>
<body>
<div class="container mt-5">
    <h2>Data User</h2>
    <?php
    if (isset($message)) {
        echo "<div class='alert alert-success'>$message</div>";
    }
    ?>
    <p>Tambahkan <a href="tambah_user.php">user baru</a></p>
    <table class="table">
        <thead>
            <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Password</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $userData = $admin->getUserData();
            
            foreach ($userData as $row) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['tgl_buat'] . "</td>";
                echo "<td>
                        <div class='btn-group btn-group-horizontal'>
                            <a href='edit_user.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>
                            <form method='post' onsubmit='return confirmDelete()'>
                                <input type='hidden' name='user_id' value='" . $row['id'] . "'>
                                <button type='submit' class='btn btn-danger' name='delete'>Delete</button>
                            </form>
                        </div>
                    </td>";
                echo "</tr>";
            }            
            ?>
        </tbody>
    </table>
    
    <script>
    // Fungsi untuk konfirmasi sebelum menghapus
    function confirmDelete() {
        return confirm("Anda yakin ingin menghapus pengguna ini?");
    }
    </script>

    <!-- Tambahkan Bootstrap JS -->
    <script src="jQuery/jquery-3.3.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
