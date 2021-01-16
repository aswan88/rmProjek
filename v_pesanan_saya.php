<?php

@$clik = $_GET['click'];
@$mbayar = $_GET['mbayar'];
if ($clik == 'true') {
    $query = query("SELECT * FROM keranjang RIGHT JOIN produk ON keranjang.id_produk=produk.id_produk WHERE keranjang.id_pelanggan = '$idPelanggan' ");
    if (!empty($query)) {
        $waktu = date("Y-m-d h:i:s");
        $jmlItem = count($query);
        for ($i = 0; $i < $jmlItem; $i++) {
            mysqli_query($conn, "INSERT INTO transaksi 
        VALUES ('','{$query[$i]['id_produk']}', '{$query[$i]['id_pelanggan']}', '{$query[$i]['jumlah_pesan']}','$waktu','$mbayar','0')
        ");
        }
        // hapus data yang sudah di konfirmasi
        for ($i = 0; $i < $jmlItem; $i++) {
            mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang= '{$query[$i]['id_keranjang']}' 
            ");
            // var_dump($query[$i]['id_keranjang']);
        }
    }
}

$transaksi = query("SELECT * FROM transaksi JOIN produk ON transaksi.id_produk = produk.id_produk WHERE transaksi.id_pelanggan= '$idPelanggan' AND transaksi.status != 2 ORDER BY transaksi.id_transaksi DESC");

// die;

?>



<!-- header -->
<?php include('template/header.php'); ?>

<!-- keranjang -->
<section id="keranjang" class="keranjang">

    <div class="container pb-2">
        <div class="row justify-content-center">
            <h5>Pesanan Anda</h5>
        </div>
        <hr>
        <div class="row justify-content-between">
            <div class="col-md-4">
                <a href="v_donload.php" class="btn btn-primary pl-5 pr-5 ">Download Struk</a>
            </div>
            <div class="col-md-4">
                <a href="#" class="viewData btn btn-primary" data-toggle="modal" id="<?= $idPelanggan; ?>" data-target="#BayarModal">Konfirmasi Pembayaran</a>
            </div>
        </div>
        <hr>
        <!-- tabel pesanan makanan -->
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Waktu Pesan</th>
                        <th scope="col">Nama Pesanan</th>
                        <th scope="col">Jumlah Pesan</th>
                        <th scope="col">Harga</th>
                        <th scope="col">TOTAL</th>
                        <th scope="col">Metode Bayar</th>
                        <th scope="col">Status Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1;
                    foreach ($transaksi as $row) :
                    ?>
                        <tr>
                            <th scope="row"><?= $n; ?></th>
                            <td><?= $row['waktu_pesan']; ?></td>
                            <td><?= $row['nama_produk']; ?></td>
                            <td><?= $row['jumlah_pesan']; ?></td>
                            <td>Rp. <?= number_format($row['harga']); ?></td>
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
                                $status = $row['status'];
                                if ($status == '1') {
                                    echo "
                                        <span class='text-warning font-weight-bold' >Di Proses</span>
                                        ";
                                } elseif ($status == '2') {
                                    echo "
                                        <span class='text-success font-weight-bold'>Selesai</span>
                                        ";
                                } else {
                                    echo "
                                        <span class='text-danger font-weight-bold'>Menunggu konfirmasi</span>
                                        ";
                                }
                                ?>

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
                        <?php
                        if (!empty($transaksi)) {
                            echo " <th scope='row' colspan='5' class='text-center text-danger'>TOTAL BAYAR</th>
                                    <th scope='row' colspan='2' class='text-danger'>Rp." . $tBayar . "  </th>";
                        } else {
                            echo "
                                
                                    <th scope='row' colspan='7' class='text-danger text-center'>Data Kosong</th>
                                
                                ";
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="BayarModal" tabindex="-1" role="dialog" aria-labelledby="BayarModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Metode Bayar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="" method="post">
                <div class="modal-body" id="data_item">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="Bayar">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>