<?php
require 'sistem/function.php';
session_start();
$idPelanggan = $_SESSION['idPelanggan'];
if (!$idPelanggan) {
    header("Location:index.php");
}

// $makanan = query("SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori = 'Makanan' ");

$pMakanan = query("SELECT * FROM keranjang RIGHT JOIN produk ON keranjang.id_produk=produk.id_produk WHERE keranjang.id_pelanggan = '$idPelanggan' ");


// hapus pesanan 
if ($_GET['id']) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang = '$id' ");

    echo "
    <script>
    alert('Data Berhasil Di Hapus');
    window.location.href='v_keranjang.php';
    </script>
    ";
}

if (isset($_POST['mBayar'])) {
    $metmetodeBayar = $_POST['metodeBayar'];

    echo "
    <script>
        confirm('transaksi Selesai Silahkan Tunggu Konfirmasi');
        window.location.href= 'profil.php?click=true&mbayar=" . $metmetodeBayar . "';
    </script>
";
}

?>



<!-- navigasi bar -->
<?php include('template/header.php'); ?>

<!-- keranjang -->
<section id="keranjang" class="keranjang mt-5">

    <div class="container pt-5 pb-2">
        <div class="row justify-content-center">
            <h2>Pesanan Anda</h2>
        </div>
        <hr>
        <div class="row justify-content-between">
            <div class="col-md-4">
                <a href="index.php" class="btn btn-primary pl-5 pr-5 ">Beli Lagi </a>
            </div>
            <div class="col-md-4">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#mBayarModal">Konfirmasi Pemesanan</a>
            </div>
        </div>
        <hr>
        <!-- tabel pesanan makanan -->
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Pesanan</th>
                        <th scope="col">Jumlah Pesan</th>
                        <th scope="col">Harga</th>
                        <th scope="col">TOTAL</th>
                        <th scope="col">Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1;
                    foreach ($pMakanan as $row) :
                    ?>
                        <tr>
                            <th scope="row"><?= $n; ?></th>
                            <td><?= $row['nama_produk']; ?></td>
                            <td><?= $row['jumlah_pesan']; ?></td>
                            <td>Rp. <?= number_format($row['harga']); ?></td>
                            <td>Rp. <?= number_format($row['harga'] * $row['jumlah_pesan']); ?></td>
                            <td>
                                <a href="v_keranjang.php?id=<?= $row['id_keranjang']; ?>" class="btn btn-danger text-white" onclick="return confirm('Yakin Akan di Hapus.?')">Hapus Pesanan</a>
                            </td>
                            </td>
                        </tr>
                        <!-- menghitung total bayar -->

                        <?php
                        $total[] = $row['jumlah_pesan'] * $row['harga'];
                        $tBayar = array_sum($total);
                        ?>
                    <?php $n++;
                    endforeach;
                    ?>
                    <tr>
                        <th scope="row" colspan="4" class="text-center text-danger">TOTAL BAYAR</th>
                        <th scope="row" class="text-danger">Rp.
                            <?php
                            if (!empty($pMakanan)) {
                                echo $tBayar;
                            } else {
                                echo 0;
                            }
                            ?>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="mBayarModal" tabindex="-1" role="dialog" aria-labelledby="mBayarModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Metode Bayar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="" method="post">
                <div class="modal-body">
                    <select class="custom-select my-1 mr-sm-2" name="metodeBayar">
                        <option selected disabled>Pilih Metode Bayar</option>
                        <option value="COD">COD</option>
                        <option value="Transfer">Transfer</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="mBayar">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- footer -->
<?php include('template/footer.php'); ?>


?>