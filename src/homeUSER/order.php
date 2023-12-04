<?php
require '../../koneksi.php';

session_start();
if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '0') {
    // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
    header('location: ../../login.php');
    exit();
}

$id_users = $_SESSION['id_users'];

$order_select = "SELECT user_pay.*, produk.foto_produk, nama_produk, status.nama_status FROM user_pay
                INNER JOIN produk ON user_pay.id_produk = produk.id_produk
                INNER JOIN status ON user_pay.id_status = status.id_status
                WHERE users_id = '$id_users' ORDER BY id_pay DESC";

$result = mysqli_query($conn, $order_select);

// Skrip untuk menghapus data dengan id_status = 2 setelah 24 jam
$delete_query = "DELETE FROM user_pay WHERE id_status = '2' AND TIMESTAMPDIFF(HOUR, created_at, NOW()) > 24";

if (mysqli_query($conn, $delete_query)) {
    
} else {
    echo "Error: " . mysqli_error($conn);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>My Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<style>
/* Animasi Pop-up */
@keyframes modalAnimation {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }

    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.rating label {
    font-size: 30px;
    color: #ddd;
    cursor: pointer;
}

.star {
    cursor: pointer;
}

.star.active {
    color: gold;
}
</style>

<body class="bg-gray-200">
    <!-- NAVBARR -->
    <div>
        <header class="">
            <nav class=" bg-white shadow-md fixed top-0 w-full z-20">
                <div class="container mx-auto items-center p-5">
                    <ul class="flex items-center space-x-4 ">
                        <li><img src="../../image/logo type b.png" width="20%" class="mr-80"></li>
                        <li><a href="../../index.php" class="font-semibold text-black px-3 py-2">Home</a></li>

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
                                <form action="" name="POST">
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
    <div class="mt-20 w-screen justify-center space-x-5 bg-black text-white p-4 font-semibold fixed flex">
        <p
            class="py-2 px-4 hover:text-black hover:bg-white rounded-md transition-all ease-in-out duration-200 delay-50 ">
            <a href="account.php">My Account
        </p></a>
        <p class="py-2 px-4 border-b-2 border-white p-2 "><a href="">My Order</p></a>
    </div>
    <div id="content">
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

                    <div class="flex items-center">
                        <p class="font-semibold mb-2 w-48">Jumlah Pesanan : <?= $row['jumlah_produk']; ?></p>
                    </div>

                    <div
<<<<<<< HEAD
                        class="px-5 rounded-md text-white flex items-center justify-end  right-0 <?php echo ($row['id_status'] == 1) ? 'bg-yellow-500' : (($row['id_status'] == 2) ? 'bg-green-500' : (($row['id_status'] == 3) ? 'bg-red-500' : '')); ?>">
=======
                        class="px-5 rounded-md text-white flex items-center justify-end  right-0 <?php echo ($row['id_status'] == 1) ? 'bg-red-500' : (($row['id_status'] == 2) ? 'bg-green-500' : ''); ?>">
>>>>>>> aa4b3fe6a53bc52a2cc392c69ebd46d2bd9f21ff
                        <p class="font-semibold"><?= $row['nama_status']; ?></p>
                    </div>

                    <div class="flex items-center">
                    <?php
                    $id_status = $row['id_status'];

                    if ($id_status == 2) {
                        // Cek apakah pengguna sudah memberikan rating atau belum
                        $userId = $_SESSION['id_users']; // Ganti dengan variabel session pengguna yang sesuai
                        $productId = $row['id_produk']; // Ganti dengan variabel ID produk yang sesuai

<<<<<<< HEAD
                        $query = $pdo->prepare("SELECT * FROM user_rating WHERE users_id = $id_users");
=======
                        $query = $pdo->prepare("SELECT * FROM user_rating WHERE users_id = ? AND id_produk = ?");
>>>>>>> aa4b3fe6a53bc52a2cc392c69ebd46d2bd9f21ff
                        $query->execute([$userId, $productId]);

                        $userHasRated = $query->rowCount() > 0; // Jika terdapat baris data, artinya pengguna sudah memberikan rating

                        if (!$userHasRated) {
                            ?>
                            <!-- Dalam halaman HTML Anda -->
                            <button id="beriRatingBtn" class="bg-blue-500 text-white px-4 py-2 items-center justify-center mt-4 rounded-md mb-4 openModal"
                                data-product-id="<?= $row['id_produk']; ?>">Beri Rating</button>
                            <?php
                        }
                    }
                    ?>
                        <!-- Modal -->
                        <div id="ratingModal" class="hidden absolute left-0 top-0 right-0 bottom-0 py-60 px-96 w-screen h-screen bg-black bg-opacity-50 flex justify-center items-center content-center modal">
                            <div class="modal-content bg-white rounded-lg shadow p-8 w-92 justify-center items-center"style="animation: modalAnimation 0.3s ease;">
                                <span class="close cursor-pointer">&times;</span>
                                <h2 class=" font-semibold">Beri Rating</h2>
                                <div class="rating font-semibold text-lg">
                                    <span class="star" data-star="1">&#9733;</span>
                                    <span class="star" data-star="2">&#9733;</span>
                                    <span class="star" data-star="3">&#9733;</span>
                                    <span class="star" data-star="4">&#9733;</span>
                                    <span class="star" data-star="5">&#9733;</span>
                                </div>

                                <form method="post" action="simpan_rating.php">
                                    <input type="hidden" name="productId" id="productId">
                                    <input type="hidden" name="ratingValue" id="ratingValue">
                                    <textarea name="comment" id="comment" class="w-full border rounded  shadow-lg px-3 py-2 text-sm focus:outline-none focus:border-black placeholder-gray-500" required
                                        placeholder="Tambahkan komentar..."></textarea>
                                    <button type="submit" class="bg-blue-700 p-1 text-white rounded-md mt-5">Simpan Rating</button>
                                </form>

                            </div>
                        </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.openModal').click(function() {
            var productId = $(this).data('product-id');
            $('#productId').val(productId);
            $('#ratingModal').removeClass('hidden');
            $('#ratingModal').css('display', 'block');
        });

        // Ketika salah satu bintang diklik
        $('.star').click(function() {
            var ratingValue = $(this).data('star');
            $('.star').removeClass('active');
            $(this).prevAll('.star').addBack().addClass('active');
            $('#ratingValue').val(ratingValue);
        });

        // Tombol untuk menutup modal
        $('.close').click(function() {
            $('#ratingModal').css('display', 'none');
        });

        // Mengirim data rating dan komentar ke PHP
        $('#ratingForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var submitButton = $(this).find('button[type="submit"]');
            $.ajax({
                url: 'simpan_rating.php',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    // Menyembunyikan tombol "Beri Rating" sebelum pengiriman data
                    submitButton.prop('disabled', true).addClass('disabled');
                },
                success: function(response) {
                    $('#ratingModal').css('display', 'none');
                    $('.openModal').hide(); // Menyembunyikan tombol "Beri Rating" setelah rating disimpan
                },
                error: function(error) {
                    console.log(error);
                    // Mengaktifkan kembali tombol setelah error
                    submitButton.prop('disabled', false).removeClass('disabled');
                }
            });
        });
    });
</script>
                    </div>
                </div>
            </div>
            <?php $i++ ;?>
            <?php endforeach; ?>
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

        xhr.open('GET', 'ajax/plus.php?keyword=' + keyword.value, true);
        xhr.send();
    });
    </script>
</body>

</html>