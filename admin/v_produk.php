<?php
// manggil function
require '../sistem/function.php';
session_start();
$idAdmin = $_SESSION['idAdmin'];
if (!$idAdmin) {
    header("Location:loginAdmin.php");
}

$produk = query("SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori");

@$id = $_GET['id'];

if (hproduk($id) > 0) {
    echo "
    <script>
    alert('Data Berhasil Di Hapus');
    window.location.href='http://localhost/projekRM/admin/v_produk.php';
    </script>
    ";
}
// else {
//     echo "
//     <script>
//     alert('Data Gagal Di Hapus');
//     window.location.href='http://localhost/projekRM/admin/v_produk.php';
//     </script>
//     ";
// }


?>


<?php include 'template/header.php' ?>
<?php include 'template/sidebar.php'; ?>
<div class="content p-4">
    <h1 class="display-5 mb-4">Kelolah Produk</h1>
    <div class="row">
        <div class="container">
            <a href="t_produk.php" class="btn btn-primary m-3">Tambah Produk</a>
            <table id="table_produk" class="display table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">gambar</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($produk as $row) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td>
                                <img src="../img/fotoProduk/<?= $row['gambar']; ?>" width="70" alt="gambar produk">
                            </td>
                            <td><?= $row['nama_produk']; ?></td>
                            <td><?= $row['nama_kategori']; ?></td>
                            <td><?= $row['harga']; ?></td>
                            <td>
                                <a href="" class="btn btn-warning text-white">Edit</a>
                                <a href="v_produk.php?id=<?= $row['id_produk']; ?>" class="btn btn-danger text-white" onclick="return confirm('Yakin Akan di Hapus.?')">Hapus</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'template/footer.php'; ?>