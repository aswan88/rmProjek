<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/my_asset/mycss.css">


    <title>RM || Poka</title>
</head>

<body>
    <!-- Navigasi bar -->
    <!-- Image and text -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm p-3 bg-white rounded">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/logoPadang.png" width="80" height="30" class="d-inline-block align-top" alt="">
                RM POKA
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#makanan">Makanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#minuman">Minuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Galery</a>
                    </li>
                    <?php
                    if (!@$_SESSION['idPelanggan']) {
                        echo "
                        <li class='nav-item'>
                            <a class='login' href='login.php'>Login</a>
                        </li>
                        <li class='nav-item'>
                            <a class='daftar' href='daftar.php'>Daftar</a>
                        </li>
                        
                        ";
                    } else {
                        $pelanggan = query("SELECT * FROM pelanggan WHERE id_pelanggan = '$idPelanggan' ");
                        foreach ($pelanggan as $dataPelanggan) {
                            echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='v_keranjang.php'>keranjang</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='profil.php'>Daftar Pesanan</a>
                    </li>
                    <li class='nav-item'>
                        
                        <div class='dropdown'>
                        <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        <img src='img/fotoPelanggan/" . $dataPelanggan['profil'] . "' width='30' >
                        </a>

                        <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                            <a class='dropdown-item' href='profil.php'>Profil</a>
                            <a class='dropdown-item' href='logout.php'>logouut</a>
                        </div>
                        </div>
                    </li>
                    ";
                        }
                    }

                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navigasi bar -->