<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle text-light mr-3"><i class="fa fa-bars"></i></a>

    <a class="navbar-brand" href="#"><img src="../img/logoPadang.png" width="80" height="30" class="d-inline-block align-top" alt=""> ADMIN RUMAH MAKAN POKA</a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                    <i class="fa fa-user"></i> Admin(<span class="font-weight-bold text-white"><?= $_SESSION['nama'] ?></span>)
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="logoutAdmin.php">logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="d-flex">
    <nav class="sidebar bg-dark">
        <div class="row justify-content-center pt-4">
            <h4 class="text-white"> NAVIGASI</h4>
        </div>
        <hr>
        <ul class="list-unstyled">
            <li><a href="../admin/index.php"><i class="fa fa-fw fa-home"></i> Dasboard</a></li>
            <li><a href="../admin/v_pelanggan.php"><i class="fa fa-fw fa-users"></i> Kelolah Pelanggan</a></li>
            <li><a href="../admin/v_produk.php"><i class="fa fa-fw fa-utensils"></i> Kelolah Produk</a></li>
            <li><a href="../admin/v_kategori.php"><i class="fa fa-fw fa-list"></i> Kelolah Ketegori</a></li>
            <li><a href="../admin/v_pemesanan.php"><i class="fa fa-fw fa-shopping-cart"></i> Kelolah Pemesanan</a></li>
            <li><a href="../admin/v_transaksi.php"><i class="fa fa-fw fa-handshake"></i> Kelolah Transaksi</a></li>
            <li><a href="../admin/v_admin.php"><i class="fa fa-fw fa-users"></i> Kelolah Admin</a></li>
        </ul>
    </nav>