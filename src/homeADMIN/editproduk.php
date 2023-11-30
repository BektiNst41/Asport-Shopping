<?php
    require 'function.php';

    session_start();

    if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '1') {
        // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
        header('location: ../../login.php'); // Sesuaikan dengan nama halaman login Anda.
        exit();
    }
    $admin_name = $_SESSION['admin_name'];


    $id_produk = $_GET["id_produk"];
    $produk = query("SELECT * FROM produk WHERE id_produk = $id_produk")[0];

    if (isset($_POST["editproduk"])) {
        if ( editproduk($_POST) > 0) {
            echo "<script>
            alert('Data Berhasil Di Ubah!');
            document.location.href = 'produk.php';
            </script>";
        } else {
            echo "<script>
            alert('Tidak Terjadi Perubahan Pada Data!!!');
            document.location.href = 'produk.php';
            </script>";
        }
    }

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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../font.css">
    <title>Edit Produk</title>
    <style>
    /* Custom CSS for Glassmorphism effect */
    .glass-container {
        background: rgba(255, 255, 255, 0.15);
        /* Ubah transparansi sesuai kebutuhan */
        border-radius: 10px;
        backdrop-filter: blur(10px);
        /* Efek blur latar belakang */
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    input,
    select,
    textarea {
        background: rgba(255, 255, 255, 0.15);
        /* Ubah transparansi sesuai kebutuhan */
        border-radius: 10px;
        backdrop-filter: blur(10px);
        /* Efek blur latar belakang */
        border: 1px solid rgba(255, 255, 255, 0.18);
    }
    </style>
</head>

<body class="bg-gray-300">
    <div class="p-10 border-2 shadow-md m-10 glass-container bg-white">
        <h1 class="text-center text-black font-bold text-3xl mb-10">EDIT DATA PRODUK</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id_produk" value="<?= $produk["id_produk"]; ?>">
            <input type="hidden" name="fotoLama" value="<?= $produk["foto_produk"]; ?>">

            <img class="w-56 h-auto rounded-md mb-5 justify-center" src="image/<?php echo $produk['foto_produk'] ?>"
                alt="" />

            <label class="mt-2 text-sm font-semibold" id="foto_produk">Foto Produk</label>
            <input type="file" id="name" name="foto_produk"
            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2">

            <label class="mt-2 text-sm font-semibold" id="nama_produk">Nama Produk</label>
            <input type="text" id="name" name="nama_produk" value="<?= $produk["nama_produk"]; ?>"
            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2">

            <label class="mt-2 text-sm font-semibold" id="harga_produk">Harga Produk</label>
            <input type="text" id="name" name="harga_produk" value="<?= $produk["harga_produk"]; ?>"
            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2">

            <label class="mt-2 text-sm font-semibold" id="ukuran_produk">Ukuran Produk</label><br>
            <p class="mt-2 text-xs font-tint">Ukuran Dewasa</p>

            <input type="radio" id="ukuran_38" name="ukuran_produk" value="38"
            <?php echo ($produk['ukuran_produk']=='38') ? "checked" : ""; ?>>
            <label for="ukuran_38" class="mt-2 text-sm font-semibold mr-2">38</label>

            <input type="radio" id="ukuran_39" name="ukuran_produk" value="39"
                   <?php echo($produk['ukuran_produk'] == '39')? "checked":""; ?>>
            <label for="ukuran_39" class="mt-2 text-sm font-semibold mr-2">39</label>

            <input type="radio" id="ukuran_40" name="ukuran_produk" value="40"
                <?php echo ($produk['ukuran_produk']=='40') ? "checked" : ""; ?>>
            <label for="ukuran_40" class="mt-2 text-sm font-semibold mr-2">40</label>

            <input type="radio" id="ukuran_41" name="ukuran_produk" value="41"
                <?php echo ($produk['ukuran_produk']=='41') ? "checked" : ""; ?>>
            <label for="ukuran_38" class="mt-2 text-sm font-semibold mr-2">41</label>

            <input type="radio" id="ukuran_42" name="ukuran_produk" value="42"
                <?php echo ($produk['ukuran_produk']=='42') ? "checked" : ""; ?>>
            <label for="ukuran_42" class="mt-2 text-sm font-semibold mr-2">42</label>

            <input type="radio" id="ukuran_43" name="ukuran_produk" value="43"
                <?php echo ($produk['ukuran_produk']=='43') ? "checked" : ""; ?>>
            <label for="ukuran_43" class="mt-2 text-sm font-semibold mr-2">43</label>

            <input type="radio" id="ukuran_44" name="ukuran_produk" value="44"
                <?php echo ($produk['ukuran_produk']=='44') ? "checked" : ""; ?>>
            <label for="ukuran_44" class="mt-2 text-sm font-semibold mr-2">44</label>

            <input type="radio" id="ukuran_45" name="ukuran_produk" value="45"
                <?php echo ($produk['ukuran_produk']=='45') ? "checked" : ""; ?>>
            <label for="ukuran_45" class="mt-2 text-sm font-semibold mr-2">45</label>

            <p class="mt-2 text-xs font-tint">Ukuran Anak</p>
            <input type="radio" id="ukuran_20" name="ukuran_produk" value="20"
                <?php echo ($produk['ukuran_produk']=='20') ? "checked" : ""; ?>>
            <label for="ukuran_20" class="mt-2 text-sm font-semibold mr-2">20</label>

            <input type="radio" id="ukuran_21" name="ukuran_produk" value="21"
                <?php echo ($produk['ukuran_produk']=='21') ? "checked" : ""; ?>>
            <label for="ukuran_21" class="mt-2 text-sm font-semibold mr-2">21</label>

            <input type="radio" id="ukuran_22" name="ukuran_produk" value="22"
                <?php echo ($produk['ukuran_produk']=='22') ? "checked" : ""; ?>>
            <label for="ukuran_22" class="mt-2 text-sm font-semibold mr-2">22</label>

            <input type="radio" id="ukuran_23" name="ukuran_produk" value="23"
                <?php echo ($produk['ukuran_produk']=='23') ? "checked" : ""; ?>>
            <label for="ukuran_23" class="mt-2 text-sm font-semibold mr-2">23</label>

            <input type="radio" id="ukuran_24" name="ukuran_produk" value="24"
                <?php echo ($produk['ukuran_produk']=='24') ? "checked" : ""; ?>>
            <label for="ukuran_24" class="mt-2 text-sm font-semibold mr-2">24</label>

            <input type="radio" id="ukuran_25" name="ukuran_produk" value="25"
                <?php echo ($produk['ukuran_produk']=='25') ? "checked" : ""; ?>>
            <label for="ukuran_25" class="mt-2 text-sm font-semibold mr-2">25</label>

            <input type="radio" id="ukuran_26" name="ukuran_produk" value="26"
                <?php echo ($produk['ukuran_produk']=='26') ? "checked" : ""; ?>>
            <label for="ukuran_26" class="mt-2 text-sm font-semibold mr-2">26</label>

            <input type="radio" id="ukuran_27" name="ukuran_produk" value="27"
                <?php echo ($produk['ukuran_produk']=='27') ? "checked" : ""; ?>>
            <label for="ukuran_27" class="mt-2 text-sm font-semibold mr-2">27</label>


            <br>
            <br>
            <label class="text-sm font-semibold" id="jenis_produk">Jenis Produk</label>
            <select name="jenis_produk" id="jenis_produk"
                class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2">
                <option value="<?php echo "$produk[id_jenis]";?>"><?= $produk["nama_jenis"];?></option>
                <?php
                    $queryjenis = mysqli_query($conn, "SELECT * FROM jenis") or die (mysqli_error($conn));
                    while($data_jenis = mysqli_fetch_array($queryjenis)) {
                    echo '<option value="'.$data_jenis['id_jenis'].'">'.$data_jenis['nama_jenis'].'</option>';
                }
                ?>
            </select><br>
            
            <label class="text-sm font-semibold" id="kategori_produk">Kategori Produk</label>
            <select name="kategori_produk" id="kategori_produk" class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2">
                <option class="text-xs" value="<?php echo "$produk[id_kategori]";?>">
                    <?= $produk['nama_kategori'];?></option>
                <?php
                    $querykategori = mysqli_query($conn, "SELECT * FROM kategori") or die (mysqli_error($conn));
                    while($data_kategori = mysqli_fetch_array($querykategori)) {
                    echo '<option value="'.$data_kategori['id_kategori'].'">'.$data_kategori['nama_kategori'].'</option>';
                    }
                ?>
            </select><br>

            <label class="mt-2 text-sm font-semibold" id="stok_produk">Stok Produk</label>
            <input type="text" id="name" name="stok_produk" value="<?= $produk["stok_produk"]; ?>"
                class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2">

            <label class="mt-2 text-sm font-semibold" id="desc_kategori">Deskripsi Produk</label>
            <textarea rows="4" cols="50" name="desc_produk"
                class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2"><?= $produk["desc_produk"]; ?></textarea>

            <div class="float-right">
                <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white mr-1 float-right mb-4"
                    name="editproduk">Edit</button>
                <button
                    class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mr-3 float-right mb-4 close-modal"><a
                        href="produk.php">Batal</a></button>
            </div>
    </div>
    </form>
    </div>
</body>

</html>