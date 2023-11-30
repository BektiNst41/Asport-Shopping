<?php
require '../../koneksi.php';

session_start();
if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '0') {
    // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
    header('location: ../../login.php'); // Sesuaikan dengan nama halaman login Anda.
    exit();
}

$email = $_SESSION['admin_email'];
$id_users = $_SESSION['id_users'];


$query = "SELECT id_users, nama, email, phone, email, password FROM users WHERE id_users = '$id_users'";
$result = mysqli_query($conn, $query);
if ($result) {
    $user_data = mysqli_fetch_assoc($result);
    $nama = $user_data['nama'];
    $phone = $user_data['phone'];
    $password = $user_data['password'];
} else {
    // Handle kesalahan saat mengambil data pengguna dari database
    header('location: account.php');
    die("Error: " . mysqli_error($conn));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>My Account</title>
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
                                class="font-semibold text-black px-3 py-2">Home</a></li>
                        <li class="relative group">
                            <a href="men.php"
                                class="font-semibold text-black px-3 py-2 rounded-md hover:bg-black hover:text-white transition-all duration-150 ease-in-out">Men</a>
                            <ul class="absolute -right-10 hidden bg-white text-black shadow-lg mt-2 w-44 z-10 group-hover:block">
                                <?php
                                    $tampilKategori = "SELECT * FROM kategori ORDER BY id_kategori DESC";
                                    $resultKategori = mysqli_query($conn, $tampilKategori);
                                    while ($rowKategori = mysqli_fetch_assoc($resultKategori)) {
                                    $kategoriId = $rowKategori["id_kategori"];
                                    $kategoriNama = $rowKategori["nama_kategori"];
                                ?>
                                        <a href="men.php?kategori_id=<?php echo $kategoriId; ?>">
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
                            <a href="women.php"
                                class="font-semibold text-black px-3 py-2 rounded-md hover:bg-black hover:text-white transition-all duration-150 ease-in-out">Women</a>
                            <ul class="absolute -right-10 hidden bg-white text-black shadow-lg mt-2 w-44 z-10 group-hover:block">
                                <?php
                                    $tampilKategori = "SELECT * FROM kategori ORDER BY id_kategori DESC";
                                    $resultKategori = mysqli_query($conn, $tampilKategori);
                                    while ($rowKategori = mysqli_fetch_assoc($resultKategori)) {
                                    $kategoriId = $rowKategori["id_kategori"];
                                    $kategoriNama = $rowKategori["nama_kategori"];
                                ?>
                                        <a href="women.php?kategori_id=<?php echo $kategoriId; ?>">
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
                            <a href="kids.php"
                                class="font-semibold text-black px-3 py-2 rounded-md hover:bg-black hover:text-white transition-all duration-150 ease-in-out">Kids</a>
                                <ul class="absolute -right-10 hidden bg-white text-black shadow-lg mt-2 w-44 z-10 group-hover:block">
                                <?php
                                    $tampilKategori = "SELECT * FROM kategori ORDER BY id_kategori DESC";
                                    $resultKategori = mysqli_query($conn, $tampilKategori);
                                    while ($rowKategori = mysqli_fetch_assoc($resultKategori)) {
                                    $kategoriId = $rowKategori["id_kategori"];
                                    $kategoriNama = $rowKategori["nama_kategori"];
                                ?>
                                        <a href="kids.php?kategori_id=<?php echo $kategoriId; ?>">
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
<div id="content">
<div class="mt-20 w-screen justify-center space-x-5 bg-black text-white p-4 font-semibold fixed flex">
    <p class="py-2 px-4 border-b-2 border-white"><a href="">My Account</a></p>
    <p class="py-2 px-4 hover:text-black hover:bg-white rounded-md transition-all ease-in-out duration-200 delay-50"><a href="order.php">My Order</a></p>
</div>
<div class="bg-white flex justify-center h-screen mx-80">
    <div class="bg-white p-8 rounded-md mt-40 w-full">
        <div class="flex"><p class="text-md mb-10 font-semibold w-3/5 mx-auto text-2xl text-center">PROFILE</p>

    </div>
        
        <form>
            <label class="text-sm">Username</label>
            <div class="mb-2">
                <input type="text" id="nama" name="text" placeholder="Username" value="<?php echo ucwords($nama); ?>" readonly
                    class="w-full border rounded px-3 py-2 mb-3 text-sm focus:outline-none focus:border-black">
            </div>
            <label class="text-sm">Email</label>
            <div class="mb-2">
                <input type="email" id="nama" name="text" placeholder="Email" value="<?php echo $email; ?>" readonly
                    class="w-full border rounded px-3 py-2 mb-3 text-sm focus:outline-none focus:border-black">
            </div>
            <label class="text-sm">No. Telp</label>
            <div class="mb-2">
                <input type="text" id="nama" name="text" placeholder="Nomor Telephone" value="<?php echo $phone; ?>" readonly
                    class="w-full border rounded px-3 py-2 mb-3 text-sm focus:outline-none focus:border-black">
            </div>
            <div class="flex gap-3 mt-28">
            <a href="eaccount.php" class="bg-black text-white text-center w-full  px-3 py-2 mb-6 rounded float-right hover:bg-yellow-400 hover:text-black hover:transition duration-300 ease-in-out">Edit</a>
            <a href="outuser.php" class="bg-black text-white text-center w-full  px-3 py-2 mb-6 rounded float-right hover:bg-red-600 hover:transition duration-300 ease-in-out">Logout</a>
            </div>
        </form>
    </div>
</div>
</div>
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

    xhr.open('GET', 'ajax/plus.php?keyword=' + keyword.value, true);
    xhr.send();
});
</script>
</body>
</html>