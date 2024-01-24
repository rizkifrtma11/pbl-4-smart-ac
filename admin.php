<?php
include ('admin_login_header.php');
?>

    <!-- Start form -->
    <div class="container-fluid mt-5">
        <div class="container bg-light rounded-4 p-4">
            <?php
            if ($err) {
                echo "<div class='alert alert-danger'>$err</div>";
            }
            ?>

            <form method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="username" value="<?php echo $username ?>" id="exampleInputEmail1" class="form-control" placeholder="Masukkan Username">
                    <div id="emailHelp" class="form-text">Pastikan anda mengisi username admin yang valid!</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password" id="exampleInputPassword1">
                </div>
                Bukan admin? kembali ke&nbsp;&nbsp;<a class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="index.php">Login</a>
                <br><br>
                <button type="submit" class="btn btn-primary" name="Login">Login</button>
            </form>
        </div>
    </div>
    <!-- End form -->

<?php
include ('login_footer.php');
?>
