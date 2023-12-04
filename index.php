<?php
    require 'koneksi.php';
?>

<!DOCTYPE html>
<html class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6f0d2c27b1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" href="font.css">
</head>

<body class="bg-gray-200">
<?php
    require 'koneksi.php';

    $query = "SELECT nama_kategori FROM kategori WHERE id_kategori = '1'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $kategori_data = mysqli_fetch_assoc($result);
    $nama_kategori = $kategori_data['nama_kategori'];
} else {
    $nama_kategori = "Kategori Default"; // Jika kategori tidak ditemukan
}
?>

<!-- NAVBARR -->
<div>
        <header class="">
            <nav class=" bg-white shadow-md fixed top-0 w-full z-20">
                <div class="container mx-auto items-center p-5">
                    <ul class="flex items-center space-x-4 ">
                        <li><img src="image/logo type b.png" width="20%" class="mr-80"></li>
                        <li><a href="index.php"
                                class="font-semibold text-black border-b-2 border-black px-3 py-2">Home</a></li>
                        <li class="relative group">
                            <a href="src/homeUSER/men.php"
                                class="font-semibold text-black px-3 py-2 rounded-md hover:bg-black hover:text-white transition-all duration-150 ease-in-out">Men</a>
                            <ul class="absolute -right-10 hidden bg-white text-black shadow-lg mt-2 w-44 z-10 group-hover:block">
                                <?php
                                    $tampilKategori = "SELECT * FROM kategori ORDER BY id_kategori DESC";
                                    $resultKategori = mysqli_query($conn, $tampilKategori);
                                    while ($rowKategori = mysqli_fetch_assoc($resultKategori)) {
                                    $kategoriId = $rowKategori["id_kategori"];
                                    $kategoriNama = $rowKategori["nama_kategori"];
                                ?>
                                        <a href="src/homeUSER/men.php?kategori_id=<?php echo $kategoriId; ?>">
                                        <li class="block px-6 py-3 text-sm hover:text-lg hover:py-4 hover:bg-black hover:text-white transition-all duration-150">
                                                <button class="kategori-button">
                                                    <?php echo $kategoriNama; ?>
                                                </button>
                                        </li>
                                        </a>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="relative group">
                            <a href="src/homeUSER/women.php"
                                class="font-semibold text-black px-3 py-2 rounded-md hover:bg-black hover:text-white transition-all duration-150 ease-in-out">Women</a>
                            <ul class="absolute -right-10 hidden bg-white text-black shadow-lg mt-2 w-44 z-10 group-hover:block">
                                <?php
                                    $tampilKategori = "SELECT * FROM kategori ORDER BY id_kategori DESC";
                                    $resultKategori = mysqli_query($conn, $tampilKategori);
                                    while ($rowKategori = mysqli_fetch_assoc($resultKategori)) {
                                    $kategoriId = $rowKategori["id_kategori"];
                                    $kategoriNama = $rowKategori["nama_kategori"];
                                ?>
                                        <a href="src/homeUSER/women.php?kategori_id=<?php echo $kategoriId; ?>">
                                        <li class="block px-6 py-3 text-sm hover:text-lg hover:py-4 hover:bg-black hover:text-white transition-all duration-150">
                                                <button class="kategori-button">
                                                    <?php echo $kategoriNama; ?>
                                                </button>
                                        </li>
                                        </a>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="relative group">
                            <a href="src/homeUSER/kids.php"
                                class="font-semibold text-black px-3 py-2 rounded-md hover:bg-black hover:text-white transition-all duration-150 ease-in-out">Kids</a>
                                <ul class="absolute -right-10 hidden bg-white text-black shadow-lg mt-2 w-44 z-10 group-hover:block">
                                <?php
                                    $tampilKategori = "SELECT * FROM kategori ORDER BY id_kategori DESC";
                                    $resultKategori = mysqli_query($conn, $tampilKategori);
                                    while ($rowKategori = mysqli_fetch_assoc($resultKategori)) {
                                    $kategoriId = $rowKategori["id_kategori"];
                                    $kategoriNama = $rowKategori["nama_kategori"];
                                ?>
                                        <a href="src/homeUSER/kids.php?kategori_id=<?php echo $kategoriId; ?>">
                                        <li class="block px-6 py-3 text-sm hover:text-lg hover:py-4 hover:bg-black hover:text-white transition-all duration-150">
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
                                <form method="POST" action="">
                                <input type="text" id="keyword" name="keyword"
                                    class="block w-full p-2 pl-10 mr-44 text-sm mt-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "
                                    placeholder="Search...">
                                </form>
                            </div>
                        </div>
                        <a href="src/homeUSER/cart.php">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="w-7 h-7 hover:scale-90 border-white rounded-md transition-all duration-150 ease-in-out">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>

                        </a>
                        <a href="src/homeUSER/account.php">
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
<div id="content">
    <!-- Implement the carousel -->
    <div class="mt-36">
        <div class="relative overflow-hidden">
            <div class="flex" id="carousel">
                <?php 
                $promosi = "SELECT * FROM promosi ORDER BY id_promosi DESC";
                $resultpro = mysqli_query($conn, $promosi);
                while ($row = mysqli_fetch_assoc ($resultpro)) {
                ?>
                <div class="w-full flex-shrink-0 ">
                    <img src="src/homeADMIN/promosi/<?php echo $row['gambar_promosi'] ?>" alt="Image 1" class="w-full h-[300px] object-cover">
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <br>

    <div class="flex justify-between items-center my-36 mx-20">
        <div class="text-left bg-white py-10 px-8 rounded-lg">
            <p class="text-5xl font-bold">Semua Jenis Olahraga,<br>Semua Jenis Gaya<br></p>
        </div>
        <div>
            <img class="w-96 mr-5" src="image/logo type b.png" alt="">
        </div>
    </div>

    <!--MEN SHOES-->
<<<<<<< HEAD
    <a href="src/homeUSER/men.php"><img src="image/Iklan/Men (1).png"></a>
=======
    <a href="src/homeUSER/men.php"><img src="image/Iklan/Men.png"></a>
>>>>>>> aa4b3fe6a53bc52a2cc392c69ebd46d2bd9f21ff
    </center>
    <p class="font-semibold text-4xl ml-16 mb-14 mt-14">MOST POPULER | MEN SHOES</p>
    <center>
    <div class="flex flex-wrap justify-center mt-6 gap-6 mb-7">
            <?php
             $query = "SELECT produk.*, jenis.nama_jenis, kategori.nama_kategori FROM produk
                       INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
                       INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
                       WHERE nama_jenis = 'men' AND stok_produk > 0
                       ORDER BY id_produk DESC
                       LIMIT 5";

            $result = mysqli_query($conn, $query);
            while($data = mysqli_fetch_array($result)){
            ?>
            <div
                class="w-56 bg-white rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-150 ease-in-out text-left p-4">
                <a href="src/homeUSER/desc.php?id_produk=<?= $data["id_produk"];?>">
                    <img class="w-56 h-auto rounded-md" src="src/homeADMIN/image/<?php echo $data['foto_produk'] ?>"
                        alt="" />
                </a>
                <div class="">
                    <p class="mb-2 text-2xl font-bold tracking-tight text-gray-900 mt-4">
                        <?php echo ucwords($data['nama_produk']) ?>
                    </p>

                    </a>
                    <p class="font-normal text-gray-700 "><?php echo $data['nama_jenis'] ?> |
                        <?php echo $data['nama_kategori'] ?></p>
                    <p class="mb-3 text-md font-semibold text-gray-700">
                        <?php echo "Rp ".number_format($data['harga_produk'], 0, ',', ','); ?></p>

                </div>
                </a>
                <form method="post" action="src/homeUSER/add_to_cart.php">
                <div class="flex justify-between mt-4">
                    <div class="mb-2">
                        <input type="hidden" name="id_produk" value="<?= $data["id_produk"]; ?>">
                    </div>
                        <button type="submit" name="tambah_ke_keranjang" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 ml-20">
                            <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                        </svg>
                        </button>
                        <a href="src/homeUSER/buy.php?id_produk=<?= $data["id_produk"];?>" class="bg-black py-2 px-6 text-sm rounded-md text-white hover:bg-gray-600">Beli</a>
                    </div>           
            </div>
            </form>  
            <?php } ?>
        </div>

        <a href="src/homeUSER/men.php"><button class="border-spacing-2 mt-10 mb-40 bg-black hover:scale-105 hover:bg-gray-600 px-5 py-3 rounded-md text-sm font-semibold text-white transition-all duration-150 ease-in-out">See More</button></a>
    </center>

<<<<<<< HEAD
    <a href="src/homeUSER/women.php"><img src="image/Iklan/Women (1).png"></a>
=======
    <a href="src/homeUSER/women.php"><img src="image/Iklan/Women.png"></a>
>>>>>>> aa4b3fe6a53bc52a2cc392c69ebd46d2bd9f21ff
    <p class="font-semibold text-4xl ml-16 mb-14 mt-14">MOST POPULER | WOMEN SHOES</p>
    <center>
    <div class="flex flex-wrap justify-center mt-6 gap-6 mb-7">
            <?php
              $query = "SELECT produk.*, jenis.nama_jenis, kategori.nama_kategori FROM produk
                        INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
                        INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
                        WHERE nama_jenis = 'women' AND stok_produk > 0
                        ORDER BY id_produk DESC
                        LIMIT 5";
            $result = mysqli_query($conn, $query);
            while($data = mysqli_fetch_array($result)){
            ?>
            <div class="w-56 bg-white rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-150 ease-in-out  text-left p-4">
                <a href="src/homeUSER/desc.php?id_produk=<?= $data["id_produk"];?>">
                <img class="w-52 h-auto rounded-md" src="src/homeADMIN/image/<?php echo $data['foto_produk'] ?>" alt="" />
                </a>
                <div class="">
                    <p class="mb-2 text-2xl font-bold tracking-tight text-gray-900 mt-4">
                        <?php echo ucwords($data['nama_produk']) ?></p>
                    </a>
                    <p class="font-normal text-gray-700 "><?php echo $data['nama_jenis'] ?> |
                        <?php echo $data['nama_kategori'] ?></p>
                    <p class="mb-3 text-md font-semibold text-gray-700">
                        <?php echo "Rp ".number_format($data['harga_produk'],0,',','.'); ?></p>
                    
                </div>
            </a>
            <form method="post" action="src/homeUSER/add_to_cart.php">
                <div class="flex justify-between mt-4">
                    <div class="mb-2">
                        <input type="hidden" name="id_produk" value="<?= $data["id_produk"]; ?>">
                    </div>
                        <button type="submit" name="tambah_ke_keranjang" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 ml-20">
                            <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                        </svg>
                        </button>
                        <a href="src/homeUSER/buy.php?id_produk=<?= $data["id_produk"];?>" class="bg-black py-2 px-6 text-sm rounded-md text-white hover:bg-gray-600">Beli</a>
                    </div>           
            </div>
            </form> 
            <?php } ?>
        </div>
        <a href="src/homeUSER/women.php"><button class="border-spacing-2 mt-10 mb-40 bg-black hover:scale-105 hover:bg-gray-600 px-5 py-3 rounded-md text-sm font-semibold text-white transition-all duration-150 ease-in-out">See More</button></a>
    </center>


<<<<<<< HEAD
    <a href="src/homeUSER/kids.php"><img src="image/Iklan/Kids (1).png"></a>
=======
    <a href="src/homeUSER/kids.php"><img src="image/Iklan/Kids.png"></a>
>>>>>>> aa4b3fe6a53bc52a2cc392c69ebd46d2bd9f21ff
    <p class="font-semibold text-4xl ml-16 mt-14">MOST POPULER | KIDS SHOES</p>
    <center>
    <div class="flex flex-wrap justify-center mt-6 gap-6 mb-7">
            <?php
              $query = "SELECT produk.*, jenis.nama_jenis, kategori.nama_kategori FROM produk
                        INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
                        INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
                        WHERE nama_jenis = 'kids' AND stok_produk > 0
                        ORDER BY id_produk DESC
                        LIMIT 5";
            $result = mysqli_query($conn, $query);
            while($data = mysqli_fetch_array($result)){
            ?>
            <div class="w-56 bg-white rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-150 ease-in-out  text-left p-4">
                <a href="src/homeUSER/desc.php?id_produk=<?= $data["id_produk"];?>">
                <img class="w-52 h-auto rounded-md" src="src/homeADMIN/image/<?php echo $data['foto_produk'] ?>" alt="" />
                </a>
                <div class="">
                    <p class="mb-2 text-2xl font-bold tracking-tight text-gray-900 mt-4">
                        <?php echo ucwords($data['nama_produk']) ?></p>
                    </a>
                    <p class="font-normal text-gray-700 "><?php echo $data['nama_jenis'] ?> |
                        <?php echo $data['nama_kategori'] ?></p>
                    <p class="mb-3 text-md font-semibold text-gray-700">
                        <?php echo "Rp ".number_format($data['harga_produk'],0,',','.'); ?></p>
                    
                </div>
            </a>
            <form method="post" action="src/homeUSER/add_to_cart.php">
                <div class="flex justify-between mt-4">
                    <div class="mb-2">
                        <input type="hidden" name="id_produk" value="<?= $data["id_produk"]; ?>">
                    </div>
                        <button type="submit" name="tambah_ke_keranjang" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 ml-20">
                            <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                        </svg>
                        </button>
                        <a href="src/homeUSER/buy.php?id_produk=<?= $data["id_produk"];?>" class="bg-black py-2 px-6 text-sm rounded-md text-white hover:bg-gray-600">Beli</a>
                    </div>           
            </div>
            </form>
            <?php } ?>
        </div>
        <a href="src/homeUSER/kids.php"><button class="border-spacing-2 mt-10 mb-40 bg-black hover:scale-105 hover:bg-gray-600 px-5 py-3 rounded-md text-sm font-semibold text-white transition-all duration-150 ease-in-out">See More</button></a>
    </center>
    </div>

    <footer class="bg-black mt-10">
        <div class="mx-auto w-full max-w-screen-xl p-4 pt-10">
            <div class="flex justify-between mx-auto ">
                <div class="mb-6 flex items-center md:mb-0">
                    <a href="" class="w-40">
                        <img src="image/logo type w.png"></span>
                    </a>
                </div>
                <div>
                    <div class="flex justify-between w-72 mx-auto ">
                        <div>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                    viewBox="0,0,256,256">
                                    <g fill="#e5e7eb" fill-rule="nonzero" stroke="none" stroke-width="1"
                                        stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                        stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                        font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <g transform="scale(8.53333,8.53333)">
                                            <path
                                                d="M15,3c-6.627,0 -12,5.373 -12,12c0,6.016 4.432,10.984 10.206,11.852v-8.672h-2.969v-3.154h2.969v-2.099c0,-3.475 1.693,-5 4.581,-5c1.383,0 2.115,0.103 2.461,0.149v2.753h-1.97c-1.226,0 -1.654,1.163 -1.654,2.473v1.724h3.593l-0.487,3.154h-3.106v8.697c5.857,-0.794 10.376,-5.802 10.376,-11.877c0,-6.627 -5.373,-12 -12,-12z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </div>

                        <div>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                    viewBox="0,0,256,256">
                                    <g fill="#e5e7eb" fill-rule="nonzero" stroke="none" stroke-width="1"
                                        stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                        stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                        font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <g transform="scale(8.53333,8.53333)">
                                            <path
                                                d="M9.99805,3c-3.859,0 -6.99805,3.14195 -6.99805,7.00195v10c0,3.859 3.14195,6.99805 7.00195,6.99805h10c3.859,0 6.99805,-3.14195 6.99805,-7.00195v-10c0,-3.859 -3.14195,-6.99805 -7.00195,-6.99805zM22,7c0.552,0 1,0.448 1,1c0,0.552 -0.448,1 -1,1c-0.552,0 -1,-0.448 -1,-1c0,-0.552 0.448,-1 1,-1zM15,9c3.309,0 6,2.691 6,6c0,3.309 -2.691,6 -6,6c-3.309,0 -6,-2.691 -6,-6c0,-3.309 2.691,-6 6,-6zM15,11c-2.20914,0 -4,1.79086 -4,4c0,2.20914 1.79086,4 4,4c2.20914,0 4,-1.79086 4,-4c0,-2.20914 -1.79086,-4 -4,-4z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </div>

                        <div>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                    viewBox="0,0,256,256">
                                    <g fill="#e5e7eb" fill-rule="nonzero" stroke="none" stroke-width="1"
                                        stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                        stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                        font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <g transform="scale(8.53333,8.53333)">
                                            <path
                                                d="M24,4h-18c-1.105,0 -2,0.895 -2,2v18c0,1.105 0.895,2 2,2h18c1.105,0 2,-0.895 2,-2v-18c0,-1.105 -0.896,-2 -2,-2zM22.689,13.474c-0.13,0.012 -0.261,0.02 -0.393,0.02c-1.495,0 -2.809,-0.768 -3.574,-1.931c0,3.049 0,6.519 0,6.577c0,2.685 -2.177,4.861 -4.861,4.861c-2.684,-0.001 -4.861,-2.178 -4.861,-4.862c0,-2.685 2.177,-4.861 4.861,-4.861c0.102,0 0.201,0.009 0.3,0.015v2.396c-0.1,-0.012 -0.197,-0.03 -0.3,-0.03c-1.37,0 -2.481,1.111 -2.481,2.481c0,1.37 1.11,2.481 2.481,2.481c1.371,0 2.581,-1.08 2.581,-2.45c0,-0.055 0.024,-11.17 0.024,-11.17h2.289c0.215,2.047 1.868,3.663 3.934,3.811z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </div>

                        <div>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                    viewBox="0,0,256,256">
                                    <g fill="#e5e7eb" fill-rule="nonzero" stroke="none" stroke-width="1"
                                        stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                        stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                        font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <g transform="scale(8.53333,8.53333)">
                                            <path
                                                d="M6,4c-1.105,0 -2,0.895 -2,2v18c0,1.105 0.895,2 2,2h18c1.105,0 2,-0.895 2,-2v-18c0,-1.105 -0.895,-2 -2,-2zM8.64844,9h4.61133l2.69141,3.84766l3.33008,-3.84766h1.45117l-4.12891,4.78125l5.05078,7.21875h-4.61133l-2.98633,-4.26953l-3.6875,4.26953h-1.47461l4.50586,-5.20508zM10.87891,10.18359l6.75391,9.62695h1.78906l-6.75586,-9.62695z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </div>

                        <div>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                    viewBox="0,0,256,256">
                                    <g fill="#e5e7eb" fill-rule="nonzero" stroke="none" stroke-width="1"
                                        stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                        stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                        font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <g transform="scale(8.53333,8.53333)">
                                            <path
                                                d="M15,3c-6.627,0 -12,5.373 -12,12c0,2.25121 0.63234,4.35007 1.71094,6.15039l-1.60352,5.84961l5.97461,-1.56836c1.74732,0.99342 3.76446,1.56836 5.91797,1.56836c6.627,0 12,-5.373 12,-12c0,-6.627 -5.373,-12 -12,-12zM10.89258,9.40234c0.195,0 0.39536,-0.00119 0.56836,0.00781c0.214,0.005 0.44692,0.02067 0.66992,0.51367c0.265,0.586 0.84202,2.05608 0.91602,2.20508c0.074,0.149 0.12644,0.32453 0.02344,0.51953c-0.098,0.2 -0.14897,0.32105 -0.29297,0.49805c-0.149,0.172 -0.31227,0.38563 -0.44727,0.51563c-0.149,0.149 -0.30286,0.31238 -0.13086,0.60938c0.172,0.297 0.76934,1.27064 1.65234,2.05664c1.135,1.014 2.09263,1.32561 2.39063,1.47461c0.298,0.149 0.47058,0.12578 0.64258,-0.07422c0.177,-0.195 0.74336,-0.86411 0.94336,-1.16211c0.195,-0.298 0.39406,-0.24644 0.66406,-0.14844c0.274,0.098 1.7352,0.8178 2.0332,0.9668c0.298,0.149 0.49336,0.22275 0.56836,0.34375c0.077,0.125 0.07708,0.72006 -0.16992,1.41406c-0.247,0.693 -1.45991,1.36316 -2.00391,1.41016c-0.549,0.051 -1.06136,0.24677 -3.56836,-0.74023c-3.024,-1.191 -4.93108,-4.28828 -5.08008,-4.48828c-0.149,-0.195 -1.21094,-1.61031 -1.21094,-3.07031c0,-1.465 0.76811,-2.18247 1.03711,-2.48047c0.274,-0.298 0.59492,-0.37109 0.79492,-0.37109z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </div>

                    </div>
                    <div class="flex justify-between w-72 mt-8">
                        <p class="text-gray-300 font-semibold "><a href="index.php">Home</a></p>
                        <p class="text-gray-300 font-semibold "><a href="src/homeUSER/men.php">Men</a></p>
                        <p class="text-gray-300 font-semibold "><a href="src/homeUSER/women.php">Women</a></p>
                        <p class="text-gray-300 font-semibold "><a href="src/homeUSER/kids.php">Kids</a></p>
                    </div>
                </div>
            </div>

            <hr class=" mb-4 mt-10 border-gray-200 " />
            <div class=" flex justify-center">
                <span class="text-sm text-gray-500 text-center ">© 2023 <a href="" class="hover:underline">Sport
                        Store</a>. All Rights Reserved.
                </span>
            </div>
        </div>
    </footer>

    <!-- Javascript code -->
    
    <script>
    const carousel = document.getElementById("carousel");
    let currentSlide = 0;
    let isAnimating = false;

    function nextSlide() {
        if (!isAnimating) {
            isAnimating = true;
            currentSlide = (currentSlide + 1) % 3; 

            // Calculate the translateX value based on the current slide
            const translateX = -currentSlide * 100;
            carousel.style.transition = "transform 0.5s ease-in-out";
            carousel.style.transform = `translateX(${translateX}%)`;

            setTimeout(() => {
                isAnimating = false;
            }, 500); // This should match the transition duration (0.5s)
        }
    }

    setInterval(nextSlide, 3000); // Change slide every 3 seconds (adjust as needed)
    </script>
    <style>
    #carousel {
        transition: none;
        /* Remove transition when the page loads */
    }
    </style>


    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>

    <!--AOS-->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
    <script>
    var keyword = document.getElementById('keyword');
    var content = document.getElementById('content');

    keyword.addEventListener('keyup', function() {
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if( xhr.readyState == 4 && xhr.status == 200){
                content.innerHTML = xhr.responseText;
            }
        }

        xhr.open('GET', 'src/homeUSER/ajax/index.php?keyword=' + keyword.value, true);
        xhr.send();
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>