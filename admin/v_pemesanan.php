<?php
require '../sistem/function.php';
session_start();
$idAdmin = $_SESSION['idAdmin'];
if (!$idAdmin) {
    header("Location:loginAdmin.php");
}

$query = query("SELECT * FROM transaksi JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan JOIN produk ON transaksi.id_produk = produk.id_produk WHERE transaksi.status != 2 ORDER BY transaksi.id_transaksi DESC");

// jika update status 

if (isset($_POST['updateStatus'])) {
    $id_transakasi = $_POST['id_transaksi'];
    $status = $_POST['status'];

    $update = mysqli_query($conn, "UPDATE transaksi SET status = '$status' WHERE id_transaksi = '$id_transakasi' ");

    if ($update) {
        echo "
            <script>
                alert('Berhasil di Update');
                window.location.href= 'http://localhost/projekRM/admin/v_transaksi.php';
            </script>
       ";
    }
}

?>

<?php include 'template/header.php' ?>
<?php include 'template/sidebar.php'; ?>
<div class="content p-4">
    <h1 class="display-5 mb-4">Kelolah Transaksi</h1>
    <div class="row">
        <div class="container">
            <table id="table_transaksi" class="display table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">jumlah Pesan</th>
                        <th scope="col">Waktu Transaksi</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Metode Bayar</th>

                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($query as $row) : ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['nama_produk']; ?></td>
                            <td><?= $row['jumlah_pesan']; ?></td>
                            <td><?= $row['waktu_pesan']; ?></td>
                            <td>Rp. <?= number_format($row['harga'] * $row['jumlah_pesan']); ?></td>
                            <td>
                                <?php
                                $mbayar = $row['metode_bayar'];
                                if ($mbayar == 'COD') {
                                    echo "
                                        <span class='text-warning' >COD</span>
                                        ";
                                } elseif ($mbayar = 'Transfer') {
                                    echo "
                                        <span class='text-success' >Transfer</span>
                                        ";
                                }


                                ?>
                            </td>
                            <td>
                                <?php
                                if ($row['status'] == 2) {
                                    echo "
                                    <p class='text-success font-weight-bold'>Selesai</p>
                                    ";
                                } elseif ($row['status'] == 1) {
                                    echo "
                                    <p class='text-warning font-weight-bold'>Di proses</p>
                                    ";
                                } else {
                                    echo "
                                    <p class='text-danger font-weight-bold'>Belum konfirmasi</p>
                                    ";
                                }

                                ?>
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#statusModal<?= $row['id_transaksi']; ?>">Rubah Status</a>
                            </td>
                            <!-- Modal -->
                            <div class="modal fade" id="statusModal<?= $row['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Rubah Status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form role="form" action="" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_transaksi" value="<?= $row['id_transaksi']; ?>">
                                                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="status">
                                                    <option selected disabled>Pilih Status</option>
                                                    <option value="1">Di Proses</option>
                                                    <option value="2">Selesai</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="updateStatus">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include 'template/footer.php'; ?>