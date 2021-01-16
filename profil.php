<?php

require 'sistem/function.php';
session_start();
$idPelanggan = $_SESSION['idPelanggan'];
if (!$idPelanggan) {
    header("Location:index.php");
}

$query = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '$idPelanggan'");

$dataPelanggan = mysqli_fetch_assoc($query)
?>


<!-- memanggil teamplate header -->
<?php include('template/header.php'); ?>

<!-- login -->
<section id="profile" class="profile" style="margin-top: 12vh;">
    <div class="container">
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <div class="row">
                <div class="col-md-3">
                    <img src="img/fotoPelanggan/<?= $dataPelanggan['profil']; ?>" alt="foto prifil" width="200">
                </div>
                <div class="col-md-6">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <h4>
                                        <?= $dataPelanggan['nama']; ?>
                                    </h4>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <?= $dataPelanggan['email']; ?>
                                </th>
                            </tr>
                            <tr>
                                <td><?= $dataPelanggan['alamat']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="shadow-sm p-3 bg-white rounded">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                        <h5>Pesanan</h5>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">
                        <h5>Riwayat Transaksi</h5>
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <?php include('v_pesanan_saya.php'); ?>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <?php include('v_transaksi.php'); ?>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
            </div>
        </div>
    </div>

</section>


<?php include('template/footer.php'); ?>