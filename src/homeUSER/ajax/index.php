<?php
require '../../../koneksi.php';

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
        <div class="mt-32 ml-10 flex flex-wrap gap-5">
        <?php

        $keyword = $_GET["keyword"];
        $query = "SELECT produk.*, jenis.nama_jenis, kategori.nama_kategori FROM produk
          INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
          INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
          WHERE produk.nama_produk LIKE '%$keyword%' OR produk.ukuran_produk LIKE '%$keyword%'
          ORDER BY produk.id_produk DESC";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_array($result)) {
            ?>
            <div class="w-60 bg-white rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-150 ease-in-out text-left p-4">
                <a href="desc.php?id_produk=<?= $data["id_produk"];?>">
                    <img class="w-60 h-auto rounded-md" src="src/homeADMIN/image/<?php echo $data['foto_produk'] ?>"
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
                            class="bg-black py-2 px-6 text-sm rounded-md text-white hover:bg-gray-600">Beli</a>
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

    </body>
</html>