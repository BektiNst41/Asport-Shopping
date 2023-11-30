<?php
    require 'function.php';
    require '../../koneksi.php';
    session_start();

if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '1') {
    // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
    header('location: ../../login.php'); // Sesuaikan dengan nama halaman login Anda.
    exit();
}
$admin_name = $_SESSION['admin_name'];

     $id_produk =$_GET["id_produk"];
    
    $query = "SELECT produk.*, jenis.nama_jenis, kategori.nama_kategori FROM produk
                INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
                INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
                WHERE produk.id_produk = $id_produk";
    $result = mysqli_query($conn, $query);
    $produk = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../font.css">

</head>
<style>
    .gold-star {
    color: gold; 
}
.gray-star{
    color: gray;
}
</style>

<body class="bg-gray-200">
    <div class="bg-white shadow-md py-8">
        <h1 class="text-4xl text-center font-bold font-poppins">INFO PRODUK SEPATU</h1>
    </div>
    <div class="bg-white flex gap-6 mt-12 justify-start mx-5 p-5 rounded-md">
        <div>
            <img class=" w-96 h-auto rounded-md mb-5 justify-center shadow-md"
                src="image/<?php echo $produk['foto_produk'] ?>" alt="" />
        </div>
        <div class=" w-2/3 h-auto mr-10 text-justify">
            <p class="text-5xl font-bold mb-16"><?= ucwords($produk["nama_produk"]); ?></p>
            <p class="font-semibold"><?= ucwords($produk['nama_kategori']) ?> | <?= ucwords($produk['nama_jenis']) ?></p>
            <p class="">Ukuran Sepatu : <?php echo $produk['ukuran_produk'] ?></p>
            <p class="">Stok Tersedia : <?php echo $produk['stok_produk'] ?></p>
            <p class="">Harga Sepatu : <?php echo "Rp ".number_format($produk['harga_produk'],0,',','.'); ?></p>
            <?php
            // Query untuk menghitung rata-rata rating produk
            $query = $pdo->prepare("SELECT AVG(rating) AS average_rating FROM user_rating WHERE id_produk = $id_produk");
            $query->execute([$id_produk]);
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // Mendapatkan nilai rata-rata rating
            $averageRating = $result['average_rating'];

            // Menampilkan rata-rata rating dalam bentuk bintang
            echo '<p>Rating Produk : ';
            echo generateStarRating($averageRating); // Panggil fungsi untuk membuat bintang
            echo ' ' . round($averageRating). '/5'; // Tambahkan angka bulat
            echo '</p>';

            // Fungsi untuk membuat bintang berdasarkan nilai rating dan menampilkan angka bulat jika kurang dari 0.5
            function generateStarRating($rating) {
                $fullStar = floor($rating); // Jumlah bintang penuh
                $halfStar = ceil($rating - $fullStar); // Jumlah bintang setengah

                $stars = '';
                // Tambahkan bintang penuh
                for ($i = 0; $i < $fullStar; $i++) {
                    $stars .= '<span class="gold-star">★</span>'; // Unicode untuk bintang penuh
                }
                // Tambahkan bintang setengah jika diperlukan
                if ($halfStar > 0) {
                    $stars .= '<span class="gray-star">☆</span>'; // Unicode untuk bintang setengah
                }

                // Tampilkan angka bulat jika rating kurang dari 0.5
                if ($rating < 0.5) {
                    $stars .= round($rating);
                }

                return $stars;
            }
            ?>
            <div class="group inline-block relative mt-4">
                <div class="text-justify"><span class="font-semibold text-lg">Deskripsi : <br></span>
                    <?= $produk["desc_produk"]; ?>
                </div>
                <div class="flex gap-3 content-center mt-5">
                    <a href="editproduk.php?id_produk=<?= $produk["id_produk"];?>"
                        class="px-4 py-2 rounded-md bg-yellow-600 text-lg font-semibold text-white hover:bg-yellow-800"><span>Edit</span></a>
                    <a href="produk.php"
                        class="px-4 py-2 rounded-md bg-red-600 text-lg font-semibold text-white hover:bg-red-900"><span>Back</span></a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>