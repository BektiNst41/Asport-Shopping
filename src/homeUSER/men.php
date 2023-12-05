<?php
session_start();
require '../../koneksi.php';


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
    <title>Men Section | Asport</title>
</head>

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
                                class="border-b-2 border-black font-semibold text-black px-3 py-2  hover:bg-black hover:text-white active:bg-blue-500 transition-all duration-150 ease-in-out">Men</a>
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
                                class=" font-semibold text-black px-3 py-2  hover:bg-black hover:text-white transition-all duration-150 ease-in-out">Women</a>
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
                                class="font-semibold text-black px-3 py-2  hover:bg-black hover:text-white transition-all duration-150 ease-in-out">Kids</a>
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
                                    <input type="text" id="keyword_men" name="keyword_men"
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
    <?php
    require '../../koneksi.php';
    ?>
    <div class="flex">
        <!-- Sidebar -->
        <div class="bg-white text-black w-60 h-screen fixed">
            <div class="text-2xl ml-10 font-bold mb-10 mt-28">Men Shoes</div>

            <!-- Menu Sidebar -->
            <ul class="">
                <?php
            $tampilKategori = "SELECT * FROM kategori ORDER BY id_kategori DESC";
            $resultKategori = mysqli_query($conn, $tampilKategori);
            while ($rowKategori = mysqli_fetch_assoc($resultKategori)) {
            $kategoriId = $rowKategori["id_kategori"];
            $kategoriNama = $rowKategori["nama_kategori"];
                ?>
                <li
                    class="pl-10 py-3 hover:text-xl hover:py-6 hover:bg-black hover:text-white transition-all duration-150">
                    <a href="men.php?kategori_id=<?php echo $kategoriId; ?>">
                        <button class="kategori-button">
                            <?php echo $kategoriNama; ?>
                        </button>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
        <!-- sidebar -->
    <div id="content_men">
        <div class="mt-36 ml-64 flex flex-wrap gap-5">
                <?php
        $query = "SELECT produk.*, jenis.nama_jenis, kategori.nama_kategori FROM produk
                INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
                INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
                WHERE jenis.nama_jenis = 'men' AND stok_produk > 0 ORDER BY id_produk DESC";

        if (isset($_GET['kategori_id'])) {
            $kategori_id = $_GET['kategori_id'];
            $query = "SELECT produk.*, jenis.nama_jenis, kategori.nama_kategori FROM produk
                      INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
                      INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
                      WHERE jenis.nama_jenis = 'men' AND kategori.id_kategori = $kategori_id";
        } else {
            $query = "SELECT produk.*, jenis.nama_jenis, kategori.nama_kategori FROM produk
                      INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
                      INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
                      WHERE jenis.nama_jenis = 'men' AND stok_produk > 0 ORDER BY id_produk DESC";
        } 

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <div
                    class="w-60 bg-white rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-150 ease-in-out text-left p-4">
                    <a href="desc.php?id_produk=<?= $data["id_produk"];?>">
                        <img class="w-60 h-auto rounded-md" src="../homeADMIN/image/<?php echo $data['foto_produk'] ?>"
                            alt="" />
                    </a>
                    <div class="">
                        <p class="mb-2 text-2xl font-bold tracking-tight text-gray-900 mt-4">
                            <?php echo ucwords($data['nama_produk']) ?>
                        </p>

                        </a>
                        <p class="font-normal text-gray-700 "><?php echo $data['nama_jenis'] ?> |
                            <?php echo $data['nama_kategori'] ?></p>
                        <p class="font-normal text-gray-700">Size : <?php echo $data['ukuran_produk'] ?></p>
                        <p class="mb-3 text-md font-semibold text-gray-700">
                            <?php echo "Rp ".number_format($data['harga_produk'], 0, ',', ','); ?></p>

                    </div>
                    </a>
                    <form method="post" action="add_to_cart.php">
                        <div class="flex justify-between mt-4">
                            <div class="mb-2">
                                <input type="hidden" name="id_produk" value="<?= $data["id_produk"]; ?>">
                            </div>
                            <button type="submit" name="tambah_ke_keranjang" class="">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-7 h-7 ml-20">
                                    <path
                                        d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                                </svg>
                            </button>
                            <a href="buy.php?id_produk=<?= $data["id_produk"];?>"
                                class="bg-black py-2 px-6 text-sm rounded-md text-white hover:bg-gray-600">BUY</a>
                        </div>
                </div>
                </form>
                <?php
            }
        } else {
            echo "<script>
            alert('Produk dengan kategori ini tidak tersedia');
            document.location.href = 'men.php';
            </script>";
        }
        ?>
            </div>
    </div>
    
        <div>
            <?php include"footer.php"; ?>
        </div>

        <script>
        var keyword = document.getElementById('keyword_men');
        var content = document.getElementById('content_men');

        keyword.addEventListener('keyup', function() {
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    content.innerHTML = xhr.responseText;
                }
            }

            xhr.open('GET', 'ajax/men.php?keyword=' + keyword.value, true);
            xhr.send();
        });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).ready(function() {
            $(".kategori-button").click(function() {
                var kategoriId = $(this).data("kategori-id");
                $.ajax({
                    url: "men.php",
                    method: "GET",
                    data: {
                        id_kategori: kategoriId
                    },
                    success: function(data) {
                        $("#kategori-detail").html(data);
                    }
                });
            });
        });
        </script>

</body>

</html>