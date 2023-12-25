<?php
include ('login_header.php');
?>

    <!-- Start form -->
    <div class="container-fluid mt-5">
        <div class="container bg-light rounded-4 p-4">
            <?php
            if ($err) {
                echo '<div class="alert alert-danger" role="alert">';
                echo "<ul>$err</ul>";
                echo '</div>';
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
                    <label for="captcha" class="form-label">Captcha</label> <br>
                    <img src="captcha.php" alt="Captcha Image" /> <br> <br>
                    <input type="text" name="captcha" class="form-control" placeholder="Enter Captcha Code" id="captcha">
                </div>
                <p>Tidak punya akun? <a href="registrasi.php">Registrasi Sekarang!</a></p>
                <button type="submit" class="btn btn-primary" name="Login">Login</button>
            </form>
        </div>
    </div>
    <!-- End form -->

<?php
include ('login_footer.php');
?>