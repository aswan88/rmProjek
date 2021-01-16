<?php
require '../sistem/function.php';

if (isset($_POST['loginAdmin'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // mengambil data berdasarkan Username
    $sql = query("SELECT * FROM admin WHERE username = '$username'");

    if (empty($sql)) {
        echo "
        <script>
        alert('Username Tidak Terdaftar.!');
        window.location.href = 'login.php';
        </script>
        ";
    } else {
        $idAdmin = $sql[0]['id_admin'];
        $passDB = $sql[0]['password'];
        $nama = $sql[0]['nama'];
        $verifikasi = password_verify($password, $passDB);
        if ($verifikasi == true) {
            session_start();
            $_SESSION['nama'] = $nama;
            $_SESSION['idAdmin'] = $idAdmin;
            echo "
            <script>
            alert('login berhasil.!');
            window.location.href = 'index.php';
            </script>
        ";
        } else {
            echo "
            <script>
            alert('login gagal...! Username/password salah.!');
            window.location.href = 'loginAdmin.php';
            </script>
        ";
        }
    }
}



?>



<?php include('template/header.php'); ?>

<!-- login -->
<section id="loginAdmin" class="loginAdmin" style="background-image: url(../img/bg.jpg);height: 95vh; top:0; width:100%;">
    <div class="row justify-content-center ">
        <div class="col-md-3 shadow-sm p-3 mb-5 mt-5 bg-white rounded">
            <h5 class="text-info text-center">login Admin.!</h5>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username" class="font-weight-bold">username</label>
                    <input type="username" class="form-control" id="username" name="username" placeholder="Masukan username">
                </div>
                <div class="form-group">
                    <label for="password" class="font-weight-bold">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" name="loginAdmin" class="btn btn-primary" style="width: 100%;">login.!</button>
            </form>
        </div>
    </div>
</section>


<!-- footer -->
<?php include('template/footer.php'); ?>