<?php
require 'sistem/function.php';

if (isset($_POST['register'])) {
    if (daftar() > 0) {
        echo "
            <script>
            alert('pendaftaran berhasil..!!');
            window.location.href='login.php';
            </script>
        ";
    } else {
        var_dump(mysqli_error($conn));
        die;
        // echo "
        //     <script>
        //     alert('pendaftaran gagal..!!');
        //     </script>
        // ";
    }
}



?>
<!-- memanggil teamplate header -->
<?php include('template/header.php'); ?>

<!-- login -->
<section id="daftar" class="daftar mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <h4>Daftar!</h4>
        </div>
        <hr>
        <div class="row justify-content-center ">
            <div class="col-md-4 shadow-sm p-3 mb-5 bg-white rounded">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukan email" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Lenkap</label>
                        <textarea name="alamat" id="alamat" class="form-control" require></textarea>
                    </div>
                    <div class="form-group">
                        <label for="profil">Foto Profil</label>
                        <input type="file" class="form-control" id="profil" name="profil" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="password2">Ulangi Password</label>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;" name="register">Daftar.!</button>
                </form>
                <small class="form-text text-muted float-right">Sudah Punya Akun.! <a href="login.php">Login.</a></small>
            </div>
        </div>
    </div>

</section>


<?php include('template/footer.php'); ?>