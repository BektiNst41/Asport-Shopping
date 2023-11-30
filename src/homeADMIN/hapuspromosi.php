<?php
require 'funiklan.php';
session_start();

if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '1') {
    // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
    header('location: ../../login.php'); // Sesuaikan dengan nama halaman login Anda.
    exit();
}
$admin_name = $_SESSION['admin_name'];

    $id_promosi = $_GET["id_promosi"];

    if(hapuspromosi($id_promosi) > 0){
        echo "<script>
            alert('Data Berhasil Di hapus!!!');
            document.location.href = 'promosi.php';
        </script>";
    }else{
        echo "<script>
            alert('Data Gagal Di hapus!!!');
            document.location.href = 'promosi.php';
        </script>";
    }
?>