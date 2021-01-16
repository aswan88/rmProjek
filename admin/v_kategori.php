<?php
include '../sistem/function.php';
session_start();
$idAdmin = $_SESSION['idAdmin'];
if (!$idAdmin) {
    header("Location:loginAdmin.php");
}
// jika simpan
if (isset($_POST['submit'])) {
    if (tKategori($_POST) > 0) {
        echo "
        <script>
        alert('Data Berhasil Di Tambahkan');
        window.location.href='http://localhost/projekRM/admin/v_kategori.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Data Gagal Di Tambahkan');
        window.location.href='http://localhost/projekRM/admin/v_kategori.php';
        </script>
        ";
    }
}
// jika hapus
if (isset($_GET['idkat'])) {
    var_dump($_GET);
    $idkat = $_GET['idkat'];

    $query = mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori='$idkat' ");
    if ($query == true) {
        echo "
        <script>
        alert('Data Berhasil Di Hapus');
        window.location.href='http://localhost/projekRM/admin/v_kategori.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Data Gagal Di Hapus');
        window.location.href='http://localhost/projekRM/admin/v_kategori.php';
        </script>
        ";
    }
}

$dataKategori = query("SELECT * FROM kategori");


?>




<?php include 'template/header.php' ?>
<?php include 'template/sidebar.php'; ?>
<div class="content p-4">
    <h1 class="display-5 mb-4">Kelolah Kategori</h1>
    <div class="row">
        <div class="container">
            <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#kategoriModal">
                Tambah Kategori
            </button>
            <table id="table_pelanggan" class="display table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1; ?>
                    <?php foreach ($dataKategori as $rowKat) : ?>
                        <tr>
                            <th scope="row"><?= $n; ?></th>
                            <td><?= $rowKat['nama_kategori']; ?></td>
                            <td>
                                <a href="" class="btn btn-warning text-white">Edit</a>
                                <a href="v_kategori.php?idkat=<?= $rowKat['id_kategori']; ?>" class="btn btn-danger text-white" onclick="return confirm('yakin akan hapus.!')">Hapus</a>
                            </td>
                        </tr>
                    <?php $n++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- modal tambah kategori -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="kategoriModal" tabindex="-1" role="dialog" aria-labelledby="kategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="kategoriModalLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama_kategori" class="col-sm-4 col-form-label">Kategori Baru</label>
                        <div class="col-sm-8">
                            <input type="text" id="nama_kategori" class="form-control" name="nama_kategori" autofocus>
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