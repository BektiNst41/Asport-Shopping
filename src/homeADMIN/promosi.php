<?php
   require 'funiklan.php'; 

   session_start();

if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '1') {
    // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
    header('location: ../../login.php'); // Sesuaikan dengan nama halaman login Anda.
    exit();
}
$admin_name = $_SESSION['admin_name'];

   if( isset($_POST["tambahpromosi"]) ){
    if( tambahpromosi($_POST) > 0){
        echo "<script>
        alert('Data Berhasil Di Tambahkan!!!');
        document.location.href = 'promosi.php';
        </script>";
    }else {
        echo "<script>
        alert('Data Gagal Di Tambahkan!!!');
        document.location.href = 'promosi.php';
        </script>";
    }
   }

$admin_name = $_SESSION['admin_name'];


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
    <title>Halaman Admin | Promosi</title>
</head>

<body class="bg-gray-200">
    <div>
        <?php include "header.php"; ?>
    </div>
    <div>
        <?php include "sidebar.php"; ?>
    </div>
    <div class="container mx-auto">
    <h1 class="text-4xl mt-24 font-bold font-poppins mb-16 ml-60 ">PROMOSI</h1>
    <div class="flex justify-end">
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

        <div class="ml-60">
            <div class="bg-white rounded shadow overflow-x-auto h-96">
                <table class="min-w-full border-separate">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-500 text-center text-xs leading-4 font-semibold text-white uppercase tracking-wider">
                                No</th>
                            <th
                                class="px-6 py-3 bg-gray-500 text-center text-xs leading-4 font-semibold text-white uppercase tracking-wider">
                                Nama</th>
                            <th
                                class="px-6 py-3 bg-gray-500 text-center text-xs leading-4 font-semibold text-white uppercase tracking-wider">
                                Preview</th>
                            <th
                                class="px-6 py-3 bg-gray-500 text-center text-xs leading-4 font-semibold text-white uppercase tracking-wider">
                                Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;?>
                        <?php
                        $tampil = "SELECT * FROM promosi ORDER BY id_promosi DESC";
                        $result = mysqli_query($conn, $tampil);

                        if(isset($_GET['cari'])) {
                            $result = mysqli_query($conn, "SELECT * FROM promosi WHERE nama_promosi LIKE '%".
                            $_GET['cari']. "%'");
                        }
                        while ($data = mysqli_fetch_assoc ($result)) {
                        ?>
                        <tr class="hover:bg-gray-100 transition-colors duration-300 text-center">

                            <td class="px-6 py-4 whitespace-no-wrap"><?php echo $i; ?></td>
                            <td class="px-6 py-4 whitespace-no-wrap"><?php echo $data["nama_promosi"] ?></td>
                            <td class="px-6 py-4 whitespace-no-wrap  flex justify-items-center justify-center"><img src="promosi/<?= $data["gambar_promosi"] ?>" class="w-52 h-auto"></td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <a href="editpromosi.php?id_promosi=<?= $data["id_promosi"];?>"
                                    class=" px-5 py-2 rounded-md bg-yellow-600 text-lg font-semibold text-white hover:bg-yellow-800">Edit</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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