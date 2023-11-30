<?php
   require 'function.php'; 

   session_start();
   if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '1') {
    // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
    header('location: ../../login.php'); // Sesuaikan dengan nama halaman login Anda.
    exit();
}
$admin_name = $_SESSION['admin_name'];

   if( isset($_POST["tambahproduk"]) ){
    if( tambahproduk($_POST) > 0){
        echo "<script>
        alert('Data Berhasil Di Tambahkan!!!');
        document.location.href = 'produk.php';
        </script>";
    }else {
        echo "<script>
        alert('Data Gagal Di Tambahkan!!!');
        document.location.href = 'produk.php';
        </script>";
    }
   }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6f0d2c27b1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../font.css">
    <title>Halaman Admin | Stock Sepatu</title>
</head>

<body class="bg-gray-200">
    <div>
        <?php include "header.php"; ?>
    </div>
    <div>
        <?php include "sidebar.php"; ?>
    </div>
    <div class="container mx-auto">
        <h1 class="text-4xl mt-24 font-bold font-poppins mb-16 ml-60">PRODUK SEPATU</h1>
        <div class="flex justify-between">
            <button
                class="bg-blue-600 ml-60 h-10 px-3 py-1 rounded text-white mr-1 mb-4 show-modal hover:shadow-md font-semibold hover:scale-105 hover:bg-white hover:text-blue-600">+ TAMBAH</button>
                <form action="" method="get">
                <div class="mb-4 flex">
                    <input type="search" name="cari" placeholder="Search..."
                        class="border rounded mr-2 px-3 h-10 focus:outline-none focus:ring focus:border-blue-300" value="<?php if(isset($_GET['search'])) { echo $_GET['search']; }?>">
                    <button type="submit" name="searching"
                        class="bg-blue-600 px-3 py-2 h-10 rounded text-white mr-1 mb-4 hover:shadow-md font-semibold hover:scale-105 hover:bg-white hover:text-blue-600">
                        Search
                    </button>
                </div>
                </form>
        </div>
        <div
            class="modal h-screen w-full z-50 fixed left-0 top-0 justify-center items-center bg-black bg-opacity-50 overflow-y-auto hidden flex">
            <div class="bg-white rounded shadow-lg w-1/2">
                <div class="border-b px-4 py-2">
                    <h3 class="font-bold text-lg">Tambah Data</h3>
                </div>
                <div class="p-3">
                    <!-- Form tambah data -->
                    <form method="post" action="" enctype="multipart/form-data">
                        <label class="mt-2 text-sm font-semibold" id="foto_produk">Foto Produk</label>
                        <input type="file" id="name" name="foto_produk"
                            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2"
                            require>

                        <label class="mt-2 text-sm font-semibold" id="nama_produk">Nama Produk</label>
                        <input type="text" name="nama_produk" placeholder="Masukkan Nama produk..."
                            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2"
                            require>

                        <label class="mt-2 text-sm font-semibold" id="harga_produk">Harga Produk</label>
                        <input type="text" name="harga_produk" placeholder="Masukkan Harga produk..."
                            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2"
                            require>

                        <label class="mt-2 text-sm font-semibold" id="ukuran_produk">Ukuran Produk</label><br>
                        <p class="mt-2 text-xs font-tint">Ukuran Dewasa</p>
                        <input type="radio" id="38" name="ukuran_produk" value="38" require>
                        <label class="mt-2 text-sm font-semibold mr-2">38</label>

                        <input type="radio" id="39" name="ukuran_produk" value="39" require>
                        <label class="mt-2 text-sm font-semibold mr-2">39</label>

                        <input type="radio" id="40" name="ukuran_produk" value="40" require>
                        <label class="mt-2 text-sm font-semibold mr-2">40</label>

                        <input type="radio" id="41" name="ukuran_produk" value="41" require>
                        <label class="mt-2 text-sm font-semibold mr-2">41</label>

                        <input type="radio" id="42" name="ukuran_produk" value="42" require>
                        <label class="mt-2 text-sm font-semibold mr-2">42</label>

                        <input type="radio" id="43" name="ukuran_produk" value="43" require>
                        <label class="mt-2 text-sm font-semibold mr-2">43</label>

                        <input type="radio" id="44" name="ukuran_produk" value="44" require>
                        <label class="mt-2 text-sm font-semibold mr-2">44</label>

                        <input type="radio" id="45" name="ukuran_produk" value="45" require>
                        <label class="mt-2 text-sm font-semibold mr-2">45</label><br>

                        <p class="mt-2 text-xs font-tint">Ukuran Anak</p>
                        <input type="radio" id="20" name="ukuran_produk" value="20" require>
                        <label class="mt-2 text-sm font-semibold mr-2">20</label>

                        <input type="radio" id="21" name="ukuran_produk" value="21" require>
                        <label class="mt-2 text-sm font-semibold mr-2">21</label>

                        <input type="radio" id="22" name="ukuran_produk" value="22" require>
                        <label class="mt-2 text-sm font-semibold mr-2">22</label>

                        <input type="radio" id="23" name="ukuran_produk" value="23" require>
                        <label class="mt-2 text-sm font-semibold mr-2">23</label>

                        <input type="radio" id="24" name="ukuran_produk" value="24" require>
                        <label class="mt-2 text-sm font-semibold mr-2">24</label>

                        <input type="radio" id="25" name="ukuran_produk" value="25" require>
                        <label class="mt-2 text-sm font-semibold mr-2">25</label>

                        <input type="radio" id="26" name="ukuran_produk" value="26" require>
                        <label class="mt-2 text-sm font-semibold mr-2">26</label>

                        <input type="radio" id="27" name="ukuran_produk" value="27" require>
                        <label class="mt-2 text-sm font-semibold mr-2">27</label>
                        <br>
                        <br>
                        <label class="text-sm font-semibold" id="jenis_produk">Jenis Produk</label>
                        <select name="jenis_produk" id="jenis_produk"
                            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2">
                            <option class="text-xs" value="" require>---</option>
                            <?php
                            $queryjenis = mysqli_query($conn, "SELECT * FROM jenis") or die (mysqli_error($conn));
                            while($data_jenis = mysqli_fetch_array($queryjenis)) {
                                echo '<option value="'.$data_jenis['id_jenis'].'">'.$data_jenis['nama_jenis'].'</option>';
                            }
                            ?>
                        </select>
                        <br>
                        <label class="text-sm font-semibold" id="kategori_produk">Kategori Produk</label>
                        <select name="kategori_produk" id="kategori_produk" class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2">
                            <option class="text-xs" value="" require>---</option>
                            <?php
                            $querykategori = mysqli_query($conn, "SELECT * FROM kategori") or die (mysqli_error($conn));
                            while($data_kategori = mysqli_fetch_array($querykategori)) {
                                echo '<option value="'.$data_kategori['id_kategori'].'">'.$data_kategori['nama_kategori'].'</option>';
                            }
                            ?>
                        </select>
                        <br>
                        <label class="mt-2 text-sm font-semibold" id="stok_produk">Stok Produk</label>
                        <input type="text" name="stok_produk" placeholder="Masukkan Jumlah Stok produk..."
                            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2"
                            require>

                        <label class="mt-2 text-sm font-semibold" id="desc_kategori">Deskripsi Produk</label>
                        <textarea rows="4" cols="50" name="desc_produk" placeholder="Masukkan Deskripsi produk..."
                            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2"
                            require></textarea>

                </div class="ml-7">
                <button
                    class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mr-3 float-right mb-4 close-modal">Batal</button>
                <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white mr-1 float-right mb-4"
                    name="tambahproduk">Tambah</button>
                </form>
            </div>
        </div>
        <!-- konten card -->
        <div class="flex flex-wrap ml-60 gap-5">
    <?php
    $query = "SELECT produk.*, jenis.nama_jenis, kategori.nama_kategori FROM produk
        INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
        INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori ORDER BY id_produk DESC";
    $result = mysqli_query($conn, $query);

    if (isset($_GET['cari'])) {
        $result = mysqli_query($conn, "SELECT produk.*, jenis.nama_jenis, kategori.nama_kategori FROM produk
            INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
            INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori  WHERE 
                nama_produk LIKE '%" . $_GET['cari'] . "%' OR 
                nama_jenis LIKE '%" . $_GET['cari'] . "%' OR 
                nama_kategori LIKE '%" . $_GET['cari'] . "%'" );
    }
    while ($data = mysqli_fetch_array($result)) {
        ?>
        <div class="w-48 h-auto <?php echo ($data['stok_produk'] == 0) ? 'bg-gray-700' : 'bg-white'; ?> rounded-sm p-2">
            <?php if ($data['stok_produk'] == 0) { ?>
                <img class="w-48 h-auto rounded-md opacity-30" src="image/<?php echo $data['foto_produk'] ?>" alt="" />
                <div class="border-y-2 border-white mt-8">
                <p class="font-bold text-2xl text-center text-white p-3 ">SOLD OUT</p>
                </div>
                
                <div class="flex gap-4 mt-14">
                <a href="editproduk.php?id_produk=<?= $data["id_produk"]; ?>"
                            class="px-2 py-1 rounded-md bg-yellow-600 text-sm font-semibold text-white hover:bg-yellow-800"><span>Edit</span></a>
                    <a href="hapusproduk.php?id_produk=<?= $data["id_produk"]; ?>"
                        class="px-2 py-1 rounded-md bg-red-600 text-sm font-semibold text-white hover:bg-red-900" onclick="return confirm('Anda Yakin Ingin Menghapus Data ini?')"><span>Hapus</span></a>
                    <a href="infoproduk.php?id_produk=<?= $data["id_produk"]; ?>"
                        class="px-2 py-1 rounded-md bg-blue-600 text-sm font-semibold text-white hover:bg-blue-900"><span>Info</span></a>
                </div>
            <?php } else { ?>
                <img class="w-48 h-auto rounded-md" src="image/<?php echo $data['foto_produk'] ?>" alt="" />
                <div class="">
                    <p class="mt-5 mb-2 text-xl font-bold tracking-tight text-gray-900">
                        <?php echo ucwords($data['nama_produk']) ?></p>
                    <p class="mt-5 text-sm tracking-tight text-gray-900">
                        <?php echo ucwords($data['nama_jenis']) ?> | <?php echo ucwords($data['nama_kategori']) ?></p>
                    <p class="text-sm tracking-tight text-gray-900"> Stock Tersisa : 
                        <?php echo $data['stok_produk'] ?></p>
                    <p class="text-sm font-bold text-gray-700 ">
                        <?php echo "Rp " . number_format($data['harga_produk'], 0, ',', '.'); ?></p>

                    <div class="flex gap-4 content-center mt-5">
                        <a href="editproduk.php?id_produk=<?= $data["id_produk"]; ?>"
                            class="px-2 py-1 rounded-md bg-yellow-600 text-sm font-semibold text-white hover:bg-yellow-800"><span>Edit</span></a>
                        <a href="hapusproduk.php?id_produk=<?= $data["id_produk"]; ?>"
                            class="px-2 py-1 rounded-md bg-red-600 text-sm font-semibold text-white hover:bg-red-900" onclick="return confirm('Anda Yakin Ingin Menghapus Data ini?')"><span>Hapus</span></a>
                        <a href="infoproduk.php?id_produk=<?= $data["id_produk"]; ?>"
                            class="px-2 py-1 rounded-md bg-blue-600 text-sm font-semibold text-white hover:bg-blue-900"><span>Info</span></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php }; ?>
</div>


        <script>
        const modal = document.querySelector('.modal');

        const showModal = document.querySelector('.show-modal');
        const closeModal = document.querySelector('.close-modal');

        showModal.addEventListener('click', function() {
            modal.classList.remove('hidden')
        });

        closeModal.addEventListener('click', function() {
            modal.classList.add('hidden')
        });
        </script>
</body>

</html>