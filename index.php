<?php
    include("login_header.php");
?>

    <!-- Start form -->
    <div class="container-fluid mt-5">
        <div class="container bg-light rounded-4 p-4">
        <?php
        if ($err) {
            echo "<ul>$err</ul>";
        }
        ?>
        <!-- <center><a href="index.php"><img src="img/logo-smart.png" alt="Smart AC Logo" width="300px" class="pb-3 pt-2"></a></center> -->
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
            <p>Tidak punya akun? <a href="registrasi.php">Registrasi Sekarang!</a></p>
            <button type="submit" class="btn btn-primary" name="Login">Login</button> <!-- Anda perlu menambahkan name="Login" pada tombol submit -->
        </form>

        </div>
    </div>
    <!-- End form -->

<?php
    include("login_footer.php");
?>