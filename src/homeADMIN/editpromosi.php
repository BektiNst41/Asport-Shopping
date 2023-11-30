<?php
    require 'funiklan.php';
    session_start();
    $id_promosi = $_GET["id_promosi"];
    $promosi = query("SELECT * FROM promosi WHERE id_promosi = $id_promosi")[0];

    

if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '1') {
    // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
    header('location: ../../login.php'); // Sesuaikan dengan nama halaman login Anda.
    exit();
}
$admin_name = $_SESSION['admin_name'];


if (isset($_POST["editpromosi"])) {
    if ( editpromosi($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil Di Ubah!');
        document.location.href = 'promosi.php';
        </script>";
    } else {
        echo "<script>
        alert('Tidak Terjadi Perubahan Pada Data!!!');
        document.location.href = 'promosi.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data | Promosi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../font.css">

</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-6 mt-20">
        <h2 class="text-2xl font-semibold mb-10 text-center">EDIT DATA</h2>
        <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-4">
                <input type="hidden" name="id_promosi" value="<?= $promosi["id_promosi"]; ?>">
                <input type="hidden" name="fotoLama" value="<?= $promosi["gambar_promosi"]; ?>">
                <label for="nama" class="block text-black font-medium mb-3">Foto</label>
                <img src="promosi/<?php echo $promosi["gambar_promosi"] ?>" class="w-52 h-auto justify-center content-center">
                <input type="file" id="name" name="gambar_promosi" class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-3 mb-5" require>
                <label for="nama" class="block text-black font-medium mb-3">Nama</label>
                <input type="text" id="nama" name="nama_promosi" class="w-full px-3 py-2 border rounded-lg" value="<?= $promosi["nama_promosi"]; ?>">
                <div class="flex justify-end">
                <button
                class="bg-red-500 hover:bg-red-700 px-3 py-1 rounded text-white mr-3 mb-4 mt-5"><a href="promosi.php">Back</a></button>
                <button
                    class="bg-green-500 hover:bg-green-700 px-3 py-1 rounded text-white mr-3 mb-4 mt-5" name="editpromosi">Edit</button> 
                </div>
        </div>
        </form>
    </div>
</body>
</html>
