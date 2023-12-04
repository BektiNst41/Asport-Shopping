<?php
 require '../../koneksi.php';

 $id_produk =$_GET["id_produk"];

 $query_desc = "SELECT produk.*, jenis.nama_jenis, kategori.nama_kategori FROM produk
                INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
                INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
                WHERE produk.id_produk = $id_produk";
    $result = mysqli_query($conn, $query_desc);
    $data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../font.css">
    <link rel="icon" type="image/png" href="../../image/Icon/icon.png" />
    <title>Description Product</title>
</head>
<style>
    
.gold-star {
    color: gold; 
    font-size: 20px;
}
.gray-star{
    color: gray;
    font-size: 20px;

}
</style>

<body class="bg-gray-200">
    <div><?php include "navbar.php"; ?> </div>

    <div class="bg-white flex gap-44 mt-32 mx-10 p-5 rounded-md">
        <div class="">
            <img src="../homeADMIN/image/<?php echo $data['foto_produk'] ?>" class="w-96 rounded-md"
                alt="">
        </div>
        <div class=" w-2/3 h-auto -ml-20">
            <p class="text-5xl font-semibold mb-16 mt-4"><?= ucwords($data['nama_produk'])?></p>
            <p class=""><?php echo $data['nama_jenis']; ?> | <?php echo $data['nama_kategori']; ?></p>
            <p class="">Ukuran : <?= $data['ukuran_produk']; ?></p>

            <?php
            $query = $pdo->prepare("SELECT AVG(rating) AS average_rating FROM user_rating WHERE id_produk = $id_produk");
            $query->execute([$id_produk]);
            $result = $query->fetch(PDO::FETCH_ASSOC);

            
            $averageRating = $result['average_rating'];
            
            echo '<p>Rating Produk : ';
            echo generateStarRating($averageRating); 
            echo ' ' . round($averageRating). '/5'; 
            echo '</p>';

            
            function generateStarRating($rating) {
                $fullStar = floor($rating);
                $halfStar = ceil($rating - $fullStar);

                $stars = '';
                for ($i = 0; $i < $fullStar; $i++) {
                    $stars .= '<span class="gold-star">★</span>'; 
                }
            
                if ($halfStar > 0) {
                    $stars .= '<span class="gray-star">☆</span>';
                }

                if ($rating < 0.5) {
                    $stars .= round($rating);
                }

                return $stars;
            }
            ?>
            <div class="text-justify w-11/12">
                <p class=" font-semibold mt-5">Deskripsi : </p><?= $data['desc_produk'] ?>
            </div>
            <p class=" font-semibold text-xl mt-3"><?= "Rp ".number_format($data['harga_produk'],0,',','.'); ?></p>

            <form method="post" action="add_to_cart.php">
                <div class="flex justify-start items-center pt-3 mt-5">
                    <div class="mb-2">
                        <input type="hidden" name="id_produk" value="<?= $data["id_produk"]; ?>">
                    </div>
                        <a href="buy.php?id_produk=<?= $data["id_produk"];?>"class="bg-black py-2 px-14 text-sm rounded-md text-white hover:bg-gray-700 transition-all duration-150">Beli</a>
                        <button type="submit" name="tambah_ke_keranjang" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9 ml-6">
                            <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                        </svg>
                        </button>
                    </div>           
            </div>
            </form> 
        </div>
    </div>
    <div class=" bg-transparent flex mt-8 mx-10 p-5 rounded-md overflow-x-scroll">
        <?php 

        require '../../koneksi.php';

        $id_produk =$_GET["id_produk"];
        $query_rate = "SELECT user_rating.*, users.nama FROM user_rating 
                        INNER JOIN users ON user_rating.users_id = users.id_users 
                        WHERE id_produk = $id_produk ORDER BY id_rating DESC";
        $result_rate = mysqli_query($conn, $query_rate);
        if ($result_rate) {
            while ($row = mysqli_fetch_assoc($result_rate)) {
                // Lakukan sesuatu dengan data di sini
            }
        } else {
            echo "Query tidak berhasil dieksekusi: " . mysqli_error($conn);
        }

            function displayStarRating($rating)
            {
                $rounded_rating = round($rating);
                $output = '<p> ';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $rounded_rating) {
                        $output .= '<span class="gold-star">★</span>'; // Simbol bintang di sini (Anda juga bisa menggunakan gambar)
                    } else {
                        $output .= '<span class="gray-star">☆</span>'; // Simbol bintang kosong untuk nilai yang belum tercapai
                    }
                }
                $output .= ' (' . $rating . ')</p>';
                return $output;
            }
        ?>
        <div class="rounded-md flex">
            <?php foreach ($result_rate as $row) : ?>
            <div class="bg-white w-96 shadow-md mx-4 my-4 px-4 py-4 rounded space-x-4">

                <div class="justify-between flex w-full">
                <p><?= ucwords($row['nama']); ?></p>
                <p><?php
                $timestamp = $row['created_at'];

                $date_formatted = date('d-m-Y', strtotime($timestamp));

                echo "" . $date_formatted;
                ?>
                </p>
                </div>

                <?php
                $rating = $row['rating'];
                echo displayStarRating($rating);
                ?>
                
                
                <p>Comment : <br><?= ucwords($row['comment']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>