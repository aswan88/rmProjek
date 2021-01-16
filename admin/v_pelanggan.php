<?php
require '../sistem/function.php';
session_start();
$idAdmin = $_SESSION['idAdmin'];
if (!$idAdmin) {
    header("Location:loginAdmin.php");
}


$data = query("SELECT * FROM pelanggan");



?>


<?php include 'template/header.php' ?>
<?php include 'template/sidebar.php'; ?>
<div class="content p-4">
    <h1 class="display-5 mb-4">Kelolah Pelanggan</h1>
    <div class="row">
        <div class="container">
            <table id="table_pelanggan" class="display table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">password</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row) : ?>
                        <tr>
                            <th scope="row">1</th>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['email']; ?>/td>
                            <td><?= $row['password']; ?></td>
                            <td>
                                <a href="?id=<?= $row['id_pelanggan']; ?>" class="btn btn-danger text-white">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'template/footer.php'; ?>