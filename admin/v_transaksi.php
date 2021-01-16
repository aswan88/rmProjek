<?php
require '../sistem/function.php';
session_start();
$idAdmin = $_SESSION['idAdmin'];
if (!$idAdmin) {
    header("Location:loginAdmin.php");
}

$query = query("SELECT * FROM transaksi JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan JOIN produk ON transaksi.id_produk = produk.id_produk WHERE transaksi.status = 2 ORDER BY transaksi.id_transaksi DESC");

?>

<?php include 'template/header.php' ?>
<?php include 'template/sidebar.php'; ?>
<div class="content p-4">
    <h1 class="display-5 mb-4">Data Transaksi</h1>
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
                        <th scope="col">Total Pembayaran</th>

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
                            <td>
                                Rp. <?= number_format($row['harga'] * $row['jumlah_pesan']); ?>
                            </td>
                        </tr>
                        <?php
                        $total[] = $row['jumlah_pesan'] * $row['harga'];
                        $tBayar = array_sum($total);
                        ?>
                    <?php $no++;
                    endforeach; ?>
                    <div class="row justify-content-end">
                        <div class="col-md-4">
                            <h4>Total Transaksi RP. <span class="text-info"><?= number_format($tBayar); ?></span></h4>
                        </div>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include 'template/footer.php'; ?>