<?php
// require 'sistem/function.php';


$transaksi = query("SELECT * FROM transaksi JOIN produk ON transaksi.id_produk = produk.id_produk WHERE transaksi.id_pelanggan= '$idPelanggan' AND transaksi.status = 2 ");

// die;

?>



<!-- pemesanan -->
<section id="pemesanan" class="pemesanan mt-5">

    <div class="container pb-2">
        <div class="row justify-content-center">
            <h5>Riwayat Pesanan Anda</h5>
        </div>
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


<!-- footer -->