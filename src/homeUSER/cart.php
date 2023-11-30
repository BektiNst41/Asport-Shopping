<?php
session_start();
require '../../koneksi.php';

if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '0') {
    // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
    header('location: ../../login.php');
    exit();
}

$email = $_SESSION['admin_email'];
$id_users = $_SESSION['id_users'];

$total_harga_semua_produk = 0;

if(isset($_POST['hapus_cart'])){
    $delete = "DELETE FROM user_cart WHERE users_id = $id_users";
    $delete_result = mysqli_query($conn, $delete);

    if ($delete_result){
        header("Location: cart.php");
        exit();
    }else{
        echo "<script>
        alert('Produk Gagal Di Hapus');
        document.location.href='cart.php'
        </script>";
    }
}

$query_select = "SELECT uc.id_cart, uc.qty, uc.created_at, p.id_produk, p.foto_produk, p.nama_produk, jp.nama_jenis, kp.nama_kategori, p.harga_produk, p.ukuran_produk
          FROM user_cart uc
          INNER JOIN produk p ON uc.id_produk = p.id_produk
          INNER JOIN jenis jp ON p.id_jenis = jp.id_jenis
          INNER JOIN kategori kp ON p.id_kategori = kp.id_kategori
          WHERE uc.users_id = '$id_users'";

$result_select = mysqli_query($conn, $query_select);

if (!$result_select) {
    die("Kueri bermasalah: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../font.css">
    <script src="https://kit.fontawesome.com/6f0d2c27b1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Your Cart</title>
</head>

<body class="bg-gray-200">

    <!-- NAVBARR -->
    <div>
        <header class="">
            <nav class=" bg-white shadow-md fixed top-0 w-full z-20">
                <div class="container mx-auto items-center p-5">
                    <ul class="flex items-center space-x-4 ">
                        <li><img src="../../image/logo type b.png" width="20%" class="mr-80"></li>
                        <li><a href="../../index.php"
                                class="font-semibold text-black border-b-2 border-black px-3 py-2">Home</a></li>
                        <li class="relative group">
                            <a href="men.php"
                                class="font-semibold text-black px-3 py-2 rounded-md hover:bg-black hover:text-white transition-all duration-150 ease-in-out">Men</a>
                            <ul
                                class="absolute -right-10 hidden bg-white text-black shadow-lg mt-2 w-44 z-10 group-hover:block">
                                <?php
                                    $tampilKategori = "SELECT * FROM kategori ORDER BY id_kategori DESC";
                                    $resultKategori = mysqli_query($conn, $tampilKategori);
                                    while ($rowKategori = mysqli_fetch_assoc($resultKategori)) {
                                    $kategoriId = $rowKategori["id_kategori"];
                                    $kategoriNama = $rowKategori["nama_kategori"];
                                ?>
                                <a href="men.php?kategori_id=<?php echo $kategoriId; ?>">
                                    <li
                                        class="block px-6 py-3 text-sm hover:text-lg hover:py-4 hover:bg-black hover:text-white transition-all duration-150">
                                        <button class="kategori-button">
                                            <?php echo $kategoriNama; ?>
                                        </button>
                                    </li>
                                </a>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="relative group">
                            <a href="women.php"
                                class="font-semibold text-black px-3 py-2 rounded-md hover:bg-black hover:text-white transition-all duration-150 ease-in-out">Women</a>
                            <ul
                                class="absolute -right-10 hidden bg-white text-black shadow-lg mt-2 w-44 z-10 group-hover:block">
                                <?php
                                    $tampilKategori = "SELECT * FROM kategori ORDER BY id_kategori DESC";
                                    $resultKategori = mysqli_query($conn, $tampilKategori);
                                    while ($rowKategori = mysqli_fetch_assoc($resultKategori)) {
                                    $kategoriId = $rowKategori["id_kategori"];
                                    $kategoriNama = $rowKategori["nama_kategori"];
                                ?>
                                <a href="women.php?kategori_id=<?php echo $kategoriId; ?>">
                                    <li
                                        class="block px-6 py-3 text-sm hover:text-lg hover:py-4 hover:bg-black hover:text-white transition-all duration-150">
                                        <button class="kategori-button">
                                            <?php echo $kategoriNama; ?>
                                        </button>
                                    </li>
                                </a>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="relative group">
                            <a href="kids.php"
                                class="font-semibold text-black px-3 py-2 rounded-md hover:bg-black hover:text-white transition-all duration-150 ease-in-out">Kids</a>
                            <ul
                                class="absolute -right-10 hidden bg-white text-black shadow-lg mt-2 w-44 z-10 group-hover:block">
                                <?php
                                    $tampilKategori = "SELECT * FROM kategori ORDER BY id_kategori DESC";
                                    $resultKategori = mysqli_query($conn, $tampilKategori);
                                    while ($rowKategori = mysqli_fetch_assoc($resultKategori)) {
                                    $kategoriId = $rowKategori["id_kategori"];
                                    $kategoriNama = $rowKategori["nama_kategori"];
                                ?>
                                <a href="kids.php?kategori_id=<?php echo $kategoriId; ?>">
                                    <li
                                        class="block px-6 py-3 text-sm hover:text-lg hover:py-4 hover:bg-black hover:text-white transition-all duration-150">
                                        <button class="kategori-button">
                                            <?php echo $kategoriNama; ?>
                                        </button>
                                    </li>
                                </a>
                                <?php } ?>
                            </ul>
                        </li>
                        <!-- search bar -->
                        <div class="flex">
                            <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search"
                                aria-expanded="false"
                                class="md:hidden text-gray-500  hover:bg-gray-100  focus:outline-none focus:ring-4 focus:ring-gray-200  rounded-lg text-sm p-2.5 mr-1">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                            <div class="relative hidden md:block">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                    <span class="sr-only">Search icon</span>
                                </div>
                                <form action="" method="POST">
                                    <input type="text" id="keyword" name="keyword"
                                        class="block w-full p-2 pl-10 mr-44 text-sm mt-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "
                                        placeholder="Search...">
                                </form>
                            </div>
                        </div>
                        <a href="cart.php">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="w-7 h-7 hover:scale-90 border-white rounded-md transition-all duration-150 ease-in-out">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>

                        </a>
                        <a href="account.php">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="w-7 h-7 hover:scale-90 border-white rounded-md transition-all duration-150 ease-in-out">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </a>
                    </ul>
                </div>
            </nav>
        </header>
    </div>

    <!-- NAVBAR -->

    <div class="mt-24 ml-10">
        <div class="fixed h-screen">
            <form action="" method="post">
                <button type="submit" name="hapus_cart"
                    class="bg-blue-400 p-2 mb-3 text-white rounded-lg hover:bg-blue-700"
                    onclick="return confirm('Anda Yakin Ingin Mengosongkan Keranjang Anda?')">Clear ALL</button>
            </form>
            <div id="content">
                <div class="container flex flex-wrap gap-x-16 gap-y-5">
                    <?php if(mysqli_num_rows($result_select)) : ?>
                    <?php while ($row = $result_select->fetch_assoc()) : ?>
                    <div
                        class="group w-96 h-auto p-4 bg-white border rounded-lg hover:shadow-lg hover:bg-gray-600 hover:scale-105 transition-all duration-150 ease-in-out">
                        <div class="flex">
                            <img src="../homeADMIN/image/<?php echo $row['foto_produk']; ?>" alt="Produk"
                                class="w-32 h-32 mr-5 rounded-md">
                            <div>
                                <h2
                                    class="text-2xl font-bold mb-8 group-hover:text-white transition-all duration-150 ease-in-out">
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
                <p>Keranjang belanja Anda kosong.</p>
                <?php endif; ?>
            </div>
            <div class="fixed right-0 bottom-0 bg-black px-20 py-6 space-x-8 flex">
                <div class="">
                    <p class="text-xs text-white">Total</p>
                    <p class="text-white font-semibold">
                        <?php echo "Rp " . number_format($total_harga_semua_produk, 0, ',', ','); ?></p>
                </div>
                <button type="submit" onclick="document.location='cart-buy.php'"
                    class="bg-white px-4 py-2 font-semibold hover:bg-gray-300 rounded-md">Checkout</button>
            </div>
        </div>
    </div>

    <script>
    var keyword = document.getElementById('keyword');
    var content = document.getElementById('content');

    keyword.addEventListener('keyup', function() {
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                content.innerHTML = xhr.responseText;
            }
        }

        xhr.open('GET', 'ajax/cart.php?keyword=' + keyword.value, true);
        xhr.send();
    });
    </script>
</body>

</html>