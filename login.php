<?php
require 'sistem/function.php';

if (isset($_POST['login'])) {
    login();
}



?>



<?php include('template/header.php'); ?>

<!-- login -->
<section id="login" class="login mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <h4>Login!</h4>
        </div>
        <hr>
        <div class="row justify-content-center ">
            <div class="col-md-4 shadow-sm p-3 mb-5 bg-white rounded">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukan email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <button type="submit" name="login" class="btn btn-primary" style="width: 100%;">Login.!</button>
                </form>
                <small class="form-text text-muted float-right">Belum Punya Akun.! <a href="daftar.php">Daftar.</a></small>
            </div>
        </div>
    </div>

</section>


<!-- footer -->
<?php include('template/footer.php'); ?>