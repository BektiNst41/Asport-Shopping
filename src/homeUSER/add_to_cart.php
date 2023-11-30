<?php
session_start();
require '../../koneksi.php';
if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '0') {
    // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
    header('location: ../../login.php'); // Sesuaikan dengan nama halaman login Anda.
    exit();
}


if (isset($_POST['tambah_ke_keranjang'])) {

    $ukuran_terkirim = $_POST['ukuran_produk'];
    echo "Ukuran terkirim: " . $ukuran_terkirim;

    $id_users = $_SESSION['id_users'];
    
    $id_produk = $_POST['id_produk'];
    $qty = 1;

    $timestamp = date('Y-m-d H:i:s');

    $check_query = "SELECT * FROM user_cart WHERE id_produk = '$id_produk' AND users_id = '$id_users'";
    $result = mysqli_query($conn, $check_query);
    if(mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        $qty = $row['qty'] + 1; 
        
        $update_query = "UPDATE user_cart SET qty = '$qty', updated_at = '$timestamp' WHERE id_produk = '$id_produk' AND users_id = '$id_users'";
        mysqli_query($conn, $update_query);

    } else {
        $insert_query = "INSERT INTO user_cart (id_cart, users_id, id_produk, qty, created_at, updated_at) VALUES ('', '$id_users', '$id_produk', '$qty', '$timestamp', '$timestamp')";
        mysqli_query($conn, $insert_query);

    }
    // Redirect kembali ke halaman sebelumnya atau halaman cart.php
    header("Location: cart.php");
    exit();
}
?>
