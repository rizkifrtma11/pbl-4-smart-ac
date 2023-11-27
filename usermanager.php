<?php

class UserManager
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function deleteUser($userId)
    {
        $query = "DELETE FROM user WHERE id = $userId";
        if (mysqli_query($this->koneksi, $query)) {
            return "Pengguna berhasil dihapus!";
        } else {
            return "Gagal menghapus pengguna: " . mysqli_error($this->koneksi);
        }
    }

    public function getUsers()
    {
        $query = "SELECT id, username, password, tgl_buat FROM user";
        $result = mysqli_query($this->koneksi, $query);
        $users = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }

        return $users;
    }
}

include("connect.php");

$userManager = new UserManager($koneksi);

if (isset($_POST['delete'])) {
    $userId = $_POST['user_id'];
    $message = $userManager->deleteUser($userId);
}

$users = $userManager->getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User - Smart AC</title>
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
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Tanggal Dibuat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $row) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
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
    function confirmDelete() {
        return confirm("Anda yakin ingin menghapus pengguna ini?");
    }
    </script>

    <script src="jQuery/jquery-3.3.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>