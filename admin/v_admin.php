<?php
include '../sistem/function.php';

session_start();
$idAdmin = $_SESSION['idAdmin'];
if (!$idAdmin) {
    header("Location:loginAdmin.php");
}

// jika simpan
if (isset($_POST['submit'])) {
    $nama_admin = htmlspecialchars($_POST['nama_admin']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);

    if ($password !== $password2) {
        echo "
                <script>
                alert('assword dan konfirmasi password tidak sama..!!');
                </script>
            ";
    } else {
        // enkripsi assword 
        $encPassword = password_hash($password, PASSWORD_DEFAULT);


        $query = "INSERT INTO admin 
            VALUES ('', '$nama_admin', '$username', '$encPassword')
    ";
        $insert = mysqli_query($conn, $query);
        if ($insert == true) {
            echo "
        <script>
        alert('Data Berhasil Tambahkan');
        window.location.href='http://localhost/projekRM/admin/v_admin.php';
        </script>
        ";
        } else {
            echo "
        <script>
        alert('Data Gagal Tambahkan');
        window.location.href='http://localhost/projekRM/admin/v_admin.php';
        </script>
        ";
        }
    }
}
// jika hapus
if (isset($_GET['idAdm'])) {
    // var_dump($_GET);
    $idAdm = $_GET['idAdm'];

    $query = mysqli_query($conn, "DELETE FROM admin WHERE id_admin='$idAdm' ");
    if ($query == true) {
        echo "
        <script>
        alert('Data Berhasil Di Hapus');
        window.location.href='http://localhost/projekRM/admin/v_admin.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Data Gagal Di Hapus');
        window.location.href='http://localhost/projekRM/admin/v_admin.php';
        </script>
        ";
    }
}

$dataAdmin = query("SELECT * FROM admin");


?>




<?php include 'template/header.php' ?>
<?php include 'template/sidebar.php'; ?>
<div class="content p-4">
    <h1 class="display-5 mb-4">Kelolah admin</h1>
    <div class="row">
        <div class="container">
            <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#adminModal">
                Tambah admin
            </button>
            <table id="table_pelanggan" class="display table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama admin</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1; ?>
                    <?php foreach ($dataAdmin as $rowAdm) : ?>
                        <tr>
                            <th scope="row"><?= $n; ?></th>
                            <td><?= $rowAdm['nama']; ?></td>
                            <td><?= $rowAdm['username']; ?></td>
                            <td><?= $rowAdm['password']; ?></td>
                            <td>
                                <a href="v_admin.php?idAdm=<?= $rowAdm['id_admin']; ?>" class="btn btn-danger text-white" onclick="return confirm('yakin akan hapus.!')">Hapus</a>
                            </td>
                        </tr>
                    <?php $n++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- modal tambah admin -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="adminModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="adminModalLabel">Tambah admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama_admin" class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" id="nama_admin" class="form-control" name="nama_admin" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-4 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" id="username" class="form-control" name="username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" id="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password2" class="col-sm-4 col-form-label">Ulangi Password</label>
                        <div class="col-sm-8">
                            <input type="password" id="password2" class="form-control" name="password2">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'template/footer.php'; ?>