<?php
//memasukkan koneksi database
require_once("sistem/function.php");

//jika berhasil/ada post['id'], jika tidak ada ya tidak dijalankan
if ($_POST['id']) {
    //membuat variabel id berisi post['id']
    $id = $_POST['id'];
    //query standart select where id
    $view = query("SELECT * FROM transaksi JOIN produk ON transaksi.id_produk = produk.id_produk WHERE transaksi.id_pelanggan= '$id' AND transaksi.status != 2 AND transaksi.metode_bayar='Transfer' ORDER BY transaksi.id_transaksi DESC");
    // var_dump($view);
    // die;
    echo "
    <table class='table table-hover'>
    <thead>
    <tr>
    <th scope='data'>Pilih</th>
    <th scope='row'>Nama Pesanan</th>
    <th scope='row'>Jumlah Pesan</th>
    <th scope='row'>Harga</th>
    </tr>
    </thead>
    <tbody>";
    foreach ($view as $data) {
        echo "
            <tr>
                <th scope='row'>
                <input type='checkbox' class='form-check-input' id='exampleCheck1' name='tandai'>
                </th>
                <td>" . $data['nama_produk'] . "</td>  
                <td>" . $data['jumlah_pesan'] . "</td>
                <td>" . number_format($data['harga'] * $data['jumlah_pesan']) . "</td>
                
            </tr>
            ";

        $total[] = $data['jumlah_pesan'] * $data['harga'];
        $tBayar = array_sum($total);
    }
    echo "
    <tr>";

    if (!empty($view)) {
        echo " <th scope='row' colspan='2' class='text-center text-danger'>TOTAL BAYAR</th>
                                    <th scope='row' colspan='2' class='text-danger'>Rp." . $tBayar . "  </th>";
    } else {
        echo "
                                
                                    <th scope='row' class='text-danger text-center'>Data Kosong</th>
                                
                                ";
    }
    echo "
                    </tr>
    ";
    echo "
        </tbody>
    </table>";
}
