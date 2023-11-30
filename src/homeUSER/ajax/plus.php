<?php
require '../../../koneksi.php';


session_start();
if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '0') {
    // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
    header('location: ../../login.php');
    exit();
}
$id_users = $_SESSION['id_users'];

$keyword = $_GET["keyword"];
$order_select = "SELECT user_pay.*, produk.foto_produk, nama_produk, status.nama_status FROM user_pay
                INNER JOIN produk ON user_pay.id_produk = produk.id_produk
                INNER JOIN status ON user_pay.id_status = status.id_status
                WHERE users_id = '$id_users' 
                AND (produk.nama_produk LIKE '%$keyword%' OR produk.ukuran_produk LIKE '%$keyword%')
                ORDER BY produk.id_produk DESC";

$result = mysqli_query($conn, $order_select);

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
<div class=" flex flex-wrap justify-center pt-44 gap-5">
            <?php $i = 1 ;?>
            <?php foreach( $result as $row ) :?>
            <div class="w-11/12 px-6 py-6 rounded-md bg-white text-black shadow-lg">
            <div class="flex justify-between">
            <div class="flex">
            <p class="mr-20 ml-4 flex items-center my-auto font-bold mb-4 w-4"><?= $i ?>.</p>
            <img src="../homeADMIN/image/<?php echo $row['foto_produk'] ?>" class="w-16 h-16 rounded-md">    
            </div>
            
            <div class="flex items-center">
                <p class="text-2xl font-bold mb-2 w-48"><?= ucwords($row['nama_produk']); ?></p>
            </div>

            <div class="flex items-center font-semibold left-0">
                <?= "Rp. ".number_format($row['total_harga'],0,',',','); ?>
            </div>
            <div class="px-5 rounded-md text-white flex items-center justify-end  right-0 <?php echo ($row['id_status'] == 1) ? 'bg-red-500' : (($row['id_status'] == 2) ? 'bg-green-500' : ''); ?>">
                <p class="font-semibold"><?= $row['nama_status']; ?></p>
            </div>
            </div>
            
        </div>
        <?php $i++ ;?>
    <?php endforeach; ?>
    </body>
</html>