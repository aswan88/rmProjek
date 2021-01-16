<?php

use function PHPSTORM_META\type;

$host = "localhost";
$username = "root";
$password = "";
$db = "db_rm";
$conn = mysqli_connect($host, $username, $password, $db);
// fungsi menampilkan data
function query($query)
{
    global $conn;
    $resault = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($resault)) {
        $rows[] = $row;
    }
    return $rows;
}
// fungsi upload foro produk
function upload()
{
    global $conn;
    $nama_foto = $_FILES['foto_produk']['name'];
    $foto_tmp = $_FILES['foto_produk']['tmp_name'];
    $x = explode('.', $nama_foto);
    $extensiFoto = strtolower(end($x));
    $extensiBenar = array('jpg', 'jpeg', 'png');

    $penyimpanan = "../img/fotoProduk/" . $nama_foto;
    if (in_array($extensiFoto, $extensiBenar) == true) {
        if (move_uploaded_file($foto_tmp, $penyimpanan)) {
            return $nama_foto;
        } else {
            echo "<script>
            alert('upload gagal');
            </script>";
        }
    } else {
        echo "
        <script>
        alert('bukan gamabar hanya boleh format jpg/jpeg/png);
        </script>
        ";
    }
}

// fungsi tambah produk
function tproduk($data)
{
    global $conn;
    $kategori = htmlspecialchars($data['kategori']);
    $nama_produk = htmlspecialchars($data['nama_produk']);
    $keterangan = htmlspecialchars($data['keterangan']);
    $harga = htmlspecialchars($data['harga']);
    $foto_produk = upload();
    if (!$foto_produk) {
        return false;
    } else {
        $query = "INSERT INTO produk
            VALUES
            ('','$kategori','$nama_produk','$harga', '$keterangan','$foto_produk')
        ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
}
// fungsi hapus produk
function hproduk($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM produk WHERE id_produk = '$id' ");
    return mysqli_affected_rows($conn);
}
// fungsi tambah kategori
function tKategori($data)
{
    global $conn;
    $nama_kategori = htmlspecialchars($data['nama_kategori']);

    mysqli_query($conn, "INSERT INTO kategori VALUES ('', '$nama_kategori') ");
    return mysqli_affected_rows($conn);
}
// fungsi upload foto profile pelanggan
function uploadProfil()
{
    global $conn;
    $nama_foto = $_FILES['profil']['name'];
    $foto_tmp = $_FILES['profil']['tmp_name'];
    $x = explode('.', $nama_foto);
    $extensiFoto = strtolower(end($x));
    $extensiBenar = array('jpg', 'jpeg', 'png');
    $angakaRandom = rand();
    $namaFotoBaru = $angakaRandom . $nama_foto;

    $penyimpanan = "img/fotoPelanggan/" . $namaFotoBaru;
    if (in_array($extensiFoto, $extensiBenar) == true) {
        if (move_uploaded_file($foto_tmp, $penyimpanan)) {
            return $namaFotoBaru;
        } else {
            echo "<script>
            alert('upload gagal');
            </script>";
        }
    } else {
        echo "
        <script>
        alert('bukan gamabar hanya boleh format jpg/jpeg/png);
        </script>
        ";
    }
}

// funsi daftar pelanggan
function daftar()
{
    global $conn;
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $profil = uploadProfil();
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);

    if ($password !== $password2) {
        echo "
                <script>
                alert('assword dan konfirmasi password tidak sama..!!');
                </script>
            ";
    } else {
        // enkripsi assword 
        $encPassword = password_hash($password, PASSWORD_DEFAULT);

        // upload file
        if (!$profil) {
            return false;
        } else {
            $query = "INSERT INTO pelanggan 
            VALUES ('', '$nama', '$email','$alamat', '$profil', '$encPassword')
    ";
            mysqli_query($conn, $query);

            return mysqli_affected_rows($conn);
        }
    }
}



// fungsi login
function login()
{
    global $conn;
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // mengambil data berdasarkan email
    $sql = query("SELECT * FROM pelanggan WHERE email = '$email'");

    if (empty($sql)) {
        echo "
        <script>
        alert('Email Tidak Terdaftar.!');
        window.location.href = 'login.php';
        </script>
        ";
    } else {
        $idPelanggan = $sql[0]['id_pelanggan'];
        $passDB = $sql[0]['password'];
        $emailDB = $sql[0]['email'];
        $verifikasi = password_verify($password, $passDB);
        if ($verifikasi == true) {
            session_start();
            $_SESSION['email'] = $emailDB;
            $_SESSION['idPelanggan'] = $idPelanggan;
            echo "
            <script>
            alert('login berhasil.!');
            window.location.href = 'index.php';
            </script>
        ";
        } else {
            echo "
            <script>
            alert('login gagal...! email/password salah.!');
            window.location.href = 'login.php';
            </script>
        ";
        }
    }
}

// fungsi pesan

function pesan()
{
    global $conn;
    $idP = htmlspecialchars($_POST['idP']);
    $idPelanggan = htmlspecialchars($_POST['idPelanggan']);
    if (empty($idPelanggan)) {
        return false;
    }
    $jPesan = htmlspecialchars($_POST['jPesan']);
    // cek jika ada data yang sama
    $query = query("SELECT * FROM keranjang WHERE id_produk = '$idP' AND id_pelanggan = '$idPelanggan'");
    if (!empty($query)) {
        $jPesanSebelum = $query[0]['jumlah_pesan'];
        $jPesanBaru = $jPesanSebelum + $jPesan;
        mysqli_query($conn, "UPDATE keranjang SET jumlah_pesan= '$jPesanBaru' WHERE id_produk= '$idP' AND id_pelanggan= '$idPelanggan'");
    } else {

        mysqli_query($conn, "INSERT INTO keranjang VALUES ('', '$idPelanggan', '$idP', '$jPesan')");
    }

    return mysqli_affected_rows($conn);
}
