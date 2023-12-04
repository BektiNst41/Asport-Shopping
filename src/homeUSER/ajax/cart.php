<?php
session_start();
require '../../../koneksi.php';

if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '0') {
    // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
    header('location: ../../login.php');
    exit();
}

$total_harga_semua_produk = 0;

$id_users = $_SESSION['id_users'];
$keyword = $_GET["keyword"];
$query_select = "SELECT uc.id_cart, uc.qty, uc.created_at, p.id_produk, p.foto_produk, p.nama_produk, jp.nama_jenis, kp.nama_kategori, p.harga_produk, p.ukuran_produk
          FROM user_cart uc
          INNER JOIN produk p ON uc.id_produk = p.id_produk
          INNER JOIN jenis jp ON p.id_jenis = jp.id_jenis
          INNER JOIN kategori kp ON p.id_kategori = kp.id_kategori
          WHERE uc.users_id = '$id_users'
<<<<<<< HEAD
          AND (p.nama_produk LIKE '%$keyword%' OR p.ukuran_produk LIKE '%$keyword%' OR kp.nama_kategori LIKE '%$keyword%')
=======
          AND (p.nama_produk LIKE '%$keyword%' OR p.ukuran_produk LIKE '%$keyword%')
>>>>>>> aa4b3fe6a53bc52a2cc392c69ebd46d2bd9f21ff
          ORDER BY p.id_produk DESC";
          
$result_select = mysqli_query($conn, $query_select);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../font.css">
    <script src="https://kit.fontawesome.com/6f0d2c27b1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../font.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200">
    <div class="container flex flex-wrap gap-x-16 gap-y-5">
        <?php if(mysqli_num_rows($result_select)) : ?>
        <?php while ($row = $result_select->fetch_assoc()) : ?>
        <div
<<<<<<< HEAD
        class="group w-96 h-auto bg-white p-2 border rounded-lg hover:shadow-lg hover:bg-gray-600 hover:scale-105 transition-all duration-150 ease-in-out">
            <div class="flex">
                <img src="../homeADMIN/image/<?php echo $row['foto_produk']; ?>" alt="Produk"
                    class="w-32 h-auto mr-5 rounded-md">
                <div>
                    <h2
                        class="text-2xl font-bold mb-8 mt-2 group-hover:text-white transition-all duration-150 ease-in-out">
=======
            class="group w-96 h-auto p-4 bg-white border rounded-lg hover:shadow-lg hover:bg-gray-600 hover:scale-105 transition-all duration-150 ease-in-out">
            <div class="flex">
                <img src="../homeADMIN/image/<?php echo $row['foto_produk']; ?>" alt="Produk"
                    class="w-32 h-32 mr-5 rounded-md">
                <div>
                    <h2
                        class="text-2xl font-bold mb-8 group-hover:text-white transition-all duration-150 ease-in-out">
>>>>>>> aa4b3fe6a53bc52a2cc392c69ebd46d2bd9f21ff
                        <?php echo ucwords($row['nama_produk']); ?></h2>
                    <p
                        class="text-gray-600 mb-1 font-semibold text-sm group-hover:text-white transition-all duration-150 ease-in-out">
                        <?php echo $row['nama_kategori']; ?> | <?php echo $row['nama_jenis']; ?></p>
                    <p
                        class="text-gray-600 font font-semibold text-sm group-hover:text-white transition-all duration-150 ease-in-out">
                        Jumlah : <?php echo $row['qty']; ?></p>
                    <p
                        class="text-red-600 font font-semibold text-md group-hover:text-white transition-all duration-150 ease-in-out">
                        Harga :
                        <?php echo "Rp " . number_format($row['harga_produk'] * $row['qty'], 0, ',', ','); ?>
                    </p>
                </div>
            </div>
        </div>
        <?php 
            $total_harga_produk = $row['harga_produk'] * $row['qty'];
            $total_harga_semua_produk += $total_harga_produk;
        ?>
        <?php endwhile; ?>
    </div>
    <?php else : ?>
<<<<<<< HEAD
    <p>Produk Tidak Ada Dalam Keranjang.</p>
=======
    <p>Keranjang belanja Anda kosong.</p>
>>>>>>> aa4b3fe6a53bc52a2cc392c69ebd46d2bd9f21ff
    <?php endif; ?>
            </div>
    </body>
</html>