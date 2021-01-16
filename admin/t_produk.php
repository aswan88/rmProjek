<?php
// memanggil koneksi/ function
require '../sistem/function.php';
session_start();
$idAdmin = $_SESSION['idAdmin'];
if (!$idAdmin) {
    header("Location:loginAdmin.php");
}


// mengecek tombol simpan

if (isset($_POST['submit'])) {
    if (tproduk($_POST) > 0) {
        echo "
        <script>
        alert('Data Berhasil Di Tambahkan');
        window.location.href='http://localhost/projekRM/admin/v_produk.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Data Gagal Di Tambahkan');
        </script>
        ";
    }
}

// tampil data
$datakat = query("SELECT * FROM kategori");


?>


<?php include 'template/header.php' ?>
<?php include 'template/sidebar.php'; ?>
<div class="content p-4">
    <h1 class="display-5 mb-4">Tambah Produk</h1>
    <div class="row">
        <div class="container">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="kategori" name="kategori">
                            <option value="" disabled="disabled">Pilih Kategori</option>
                            <?php foreach ($datakat as $rowkat) : ?>
                                <option value="
                                <?= $rowkat['id_kategori']; ?>">
                                    <?= $rowkat['nama_kategori']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Makanan/Minuman" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="00000" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Deskripsi Produk</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" id="keterangan" cols="6" rows="6" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="foto_produk" class="col-sm-2 col-form-label">Foto Produk</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control-file" id="foto_produk" name="foto_produk" placeholder="Foto Makanan/Minuman" required>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary mb-2 float-right">Simpan </button>
            </form>


        </div>
    </div>
</div>
<?php include 'template/footer.php';
