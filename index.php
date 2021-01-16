<?php
require 'sistem/function.php';
session_start();

@$idPelanggan = $_SESSION['idPelanggan']; // mengambil id user yang login


// jika tombol pesan di tekan

if (isset($_POST['pesan'])) {
    if (pesan() > 0) {
        echo "
            <script>
            alert('Pesanan Anda Berhasil di tambahkan');
            window.location.href = 'v_keranjang.php';
            </script>
        ";
    } else {
        echo "
            <script>
            confirm('Gagal Memesan anda harus login');
            window.location.href = 'login.php';
            </script>
        ";
    }
}

$makanan = query("SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori = 'Makanan' ");
$minuman = query("SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori = 'Minuman' ");



?>


<?php include('template/header.php'); ?>

<!-- baner Jumbotron -->
<div class="jumbotron jumbotron-fluid">
    <div class="gradient">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-5 col-sm-12">

                    <h1 class="display-4">RM Poka</h1>
                    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
                </div>
                <div class="col-md-5 col-sm-12">
                    <img src="img/logoPadang.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end baner jumbotron -->
<div class="container">
    <section id="content">
        <!-- content header -->
        <section id="header" class="header">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-4 col-sm-12">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos voluptatem, nobis, cum quae dolorum ea veniam eveniet officiis eaque pariatur vitae, eum facere repellendus harum sunt ab asperiores assumenda obcaecati!
                    </div>
                    <div class="col-md-4 col-sm-12">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni labore sit repellendus corporis, sed mollitia, cumque praesentium perspiciatis sint, nemo nam minus vero molestiae sequi excepturi laborum! Necessitatibus, magni libero?
                    </div>
                </div>
            </div>
        </section>
        <!-- end content header -->
        <!-- CONTENT MAKANAN -->`
        <section id="makanan" class="makanan">
            <div class="row justify-content-center">
                <h2>Makanan</h2>
            </div>
            <div class="row">
                <?php foreach ($makanan as $row) : ?>
                    <div class="col-md-4">
                        <form action="" method="post">
                            <input type="hidden" name="idP" value="<?= $row['id_produk']; ?>">
                            <input type="hidden" name="idPelanggan" value="<?= $idPelanggan; ?>">
                            <div class="card">
                                <img src="img/fotoProduk/<?= $row['gambar']; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['nama_produk']; ?></h5>
                                    <p class="card-text"><?= $row['keterangan']; ?></p>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            <p class="text-danger">Jumlah Pesan</p>
                                        </div>
                                        <div class="col">
                                            <input type="number" name="jPesan" min="1" max="20" step="1" value="1">
                                        </div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col">
                                            <h5 class="text-success">Rp. <?= $row['harga']; ?></h5>
                                        </div>
                                        <div class="col">
                                            <button type="submit" name="pesan" class="btn btn-primary btn-rounded pl-5 pr-5 mt-1">PESAN</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <!-- end content makanan -->
        <!-- content Minuman -->
        <section id="makanan" class="makanan">
            <div class="row justify-content-center">
                <h2>Makanan</h2>
            </div>
            <div class="row">
                <?php foreach ($minuman as $row) : ?>
                    <div class="col-md-4">
                        <form action="" method="post">
                            <input type="hidden" name="idP" value="<?= $row['id_produk']; ?>">
                            <input type="hidden" name="idPelanggan" value="<?= $idPelanggan; ?>">
                            <div class="card">
                                <img src="img/fotoProduk/<?= $row['gambar']; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['nama_produk']; ?></h5>
                                    <p class="card-text"><?= $row['keterangan']; ?></p>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            <p class="text-danger">Jumlah Pesan</p>
                                        </div>
                                        <div class="col">
                                            <input type="number" name="jPesan" min="1" max="20" step="1" value="1">
                                        </div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col">
                                            <h5 class="text-success">Rp. <?= $row['harga']; ?></h5>
                                        </div>
                                        <div class="col">
                                            <button type="submit" name="pesan" class="btn btn-primary btn-rounded pl-5 pr-5 mt-1">PESAN</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <!-- end content minuman -->

        <!-- content Galery -->
        <section id="gallery" class="gallery mt-5">
            <div class="row justify-content-center mt-5 pt-3 pb-5">
                <h2>Gallery</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="gallery-makanan">
                        <div class="makanan-group3">
                            <div class="makanan-group3-item">
                                <img src="img/makanan2.jpg" alt="">
                            </div>
                            <div class="makanan-group3-item">
                                <img src="img/makanan3.jpg" alt="">
                            </div>
                        </div>
                        <div class="makanan-group2">
                            <img src="img/makanan1.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="gallery-minuman">
                        <div class="minuman-group2">
                            <img src="img/minuman1.jpg" alt="">
                        </div>
                        <div class="minuman-group3">
                            <div class="minuman-group3-item">
                                <img src="img/minuman2.jpg" alt="">
                            </div>
                            <div class="minuman-group3-item">
                                <img src="img/minuman3.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end content galery -->

        <!-- Ga -->
    </section>
</div>

<?php include('template/footer.php') ?>