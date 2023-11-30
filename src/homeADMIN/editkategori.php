<?php
    require 'function.php';
    $id_kategori =$_GET["id_kategori"];
    $kategori = query("SELECT * FROM kategori WHERE id_kategori = $id_kategori")[0];

    session_start();

if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '1') {
    // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
    header('location: ../../login.php'); // Sesuaikan dengan nama halaman login Anda.
    exit();
}
$admin_name = $_SESSION['admin_name'];


if (isset($_POST["editkategori"])) {
    if ( editkategori($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil Di Ubah!');
        document.location.href = 'categori.php';
        </script>";
    } else {
        echo "<script>
        alert('Tidak Terjadi Perubahan Pada Data!!!');
        document.location.href = 'categori.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data | Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../font.css">

</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-6 mt-20">
        <h2 class="text-2xl font-semibold mb-10 text-center">EDIT DATA</h2>
        <form method="post" action="">
        <div class="mb-4">
                <input type="hidden" name="id_kategori" value="<?= $kategori["id_kategori"]; ?>">
                <label for="nama" class="block text-gray-600 font-medium mb-3">Nama</label>
                <input type="text" id="nama" name="nama_kategori" class="w-full px-3 py-2 border rounded-lg" value="<?= $kategori["nama_kategori"]; ?>">
                <div class="flex justify-end">
                <button
                class="bg-red-500 hover:bg-red-700 px-3 py-1 rounded text-white mr-3 mb-4 mt-5"><a href="categori.php">Back</a></button>
                <button
                    class="bg-green-500 hover:bg-green-700 px-3 py-1 rounded text-white mr-3 mb-4 mt-5" name="editkategori">Edit</button> 
                </div>
        </div>
        </form>
    </div>
</body>
</html>
