    <?php
        require 'function.php';
        session_start();
        
        if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '1') {
        // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
        header('location: ../../login.php'); // Sesuaikan dengan nama halaman login Anda.
        exit();
        }
        $admin_name = $_SESSION['admin_name'];
        $email = $_SESSION['admin_email'];

        $order_query = "SELECT user_pay.*, produk.nama_produk, produk.ukuran_produk, users.nama, jenis.nama_jenis, kategori.nama_kategori, status.nama_status 
                        FROM user_pay
                        INNER JOIN produk ON user_pay.id_produk = produk.id_produk
                        INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
                        INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
                        INNER JOIN status ON user_pay.id_status = status.id_status
                        INNER JOIN users ON user_pay.users_id = users.id_users 
                        ORDER BY user_pay.id_pay DESC";

        $order_result = mysqli_query($conn, $order_query);

                    // Mengonversi hasil kueri menjadi array
        $order = mysqli_fetch_all($order_result, MYSQLI_ASSOC);

        if (isset($_GET['cari'])) {
            $order = mysqli_query($conn,"SELECT user_pay.*, produk.nama_produk, users.nama, jenis.nama_jenis, kategori.nama_kategori, status.nama_status 
            FROM user_pay
            INNER JOIN produk ON user_pay.id_produk = produk.id_produk
            INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
            INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
            INNER JOIN status ON user_pay.id_status = status.id_status
            INNER JOIN users ON user_pay.users_id = users.id_users 
            WHERE nama_produk LIKE '%" . $_GET['cari'] . "%' OR nama LIKE '%" . $_GET['cari'] . "%'");
        }
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['new_status'])) {
            $orderId = $_POST['order_id'];
            $newStatus = $_POST['new_status'];

            // Lakukan update status di database untuk pesanan yang sesuai
            $updateQuery = "UPDATE user_pay SET id_status = '$newStatus' WHERE id_pay = '$orderId'";
            $result = mysqli_query($conn, $updateQuery);

            // Handle respons (jika diperlukan)
            if ($result) {
                // Jika berhasil, Anda dapat mengirim respons JSON atau pesan lain jika diperlukan
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal memperbarui status']);
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
        <title>Halaman Admin | Pesanan</title>
    </head>

    <body class="bg-gray-200">
        <div>
            <?php include "header.php"; ?>
        </div>
        <div>
            <?php include "sidebar.php"; ?>
        </div>
        <div class="rounded mt-24 ml-36">
            <div class="w-full pl-32">
                <h1 class="text-4xl font-bold mb-10">PESANAN KONSUMEN</h1>
                <form action="" method="get" class="">
                    <div class="mb-4 flex">
                        <input type="search" name="cari" placeholder="Search..."
                            class="border rounded mr-2 px-3 h-10 focus:outline-none focus:ring focus:border-blue-300"
                            value="<?php if(isset($_GET['search'])) { echo $_GET['search']; }?>">
                        <button type="submit" name="searching"
                            class="bg-blue-600 px-3 py-2 h-10 rounded text-white mr-1 mb-4 hover:shadow-md font-semibold hover:scale-105 hover:bg-white hover:text-blue-600">
                            Search
                        </button>
                    </div>
                </form>
            </div>
            <div class="overflow-y-auto h-96">
                <table class="border-collapse max-w-fit ml-32">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-500 text-xs leading-4 font-semibold text-white uppercase tracking-wider text-center">
                                No</th>
                            <th
                                class="px-6 py-3 bg-gray-500 text-xs leading-4 font-semibold text-white uppercase tracking-wider text-center">
                                Nama Pemesan</th>
                            <th
                                class="px-6 py-3 bg-gray-500 text-xs leading-4 font-semibold text-white uppercase tracking-wider text-center">
                                Nama Produk</th>
                            <th
                                class="px-6 py-3 bg-gray-500 text-xs leading-4 font-semibold text-white uppercase tracking-wider text-center">
                                Jumlah Pesanan</th>
                            <th
                                class="px-6 py-3 bg-gray-500 text-xs leading-4 font-semibold text-white uppercase tracking-wider text-center">
                                Total Harga</th>
                            <th
                                class="px-6 py-3 bg-gray-500 text-xs leading-4 font-semibold text-white uppercase tracking-wider text-center">
                                Ket</th>
                            <th
                                class="px-6 py-3 bg-gray-500 text-xs leading-4 font-semibold text-white uppercase tracking-wider text-center">
                                Aksi</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php $no = 1 ;?>
                        <?php foreach ($order as $row) : ?>
                        <tr class="hover:bg-gray-100 transition-colors duration-300 text-center">
                            <td class="px-6 py-4 text-sm whitespace-no-wrap"><?= $no;?></td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap"><?= ucwords($row['nama']);?></td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap"><?= ucwords($row['nama_produk']); ?></td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap"><?= ucwords($row['jumlah_produk']); ?></td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                <?= "Rp. ".number_format($row['total_harga'],0,',',','); ?></td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                <select name="status" onchange="updateStatus(<?php echo $row['id_pay']; ?>, this.value)"
                                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black mt-1 mb-2">
                                    <option value="<?php echo "$row[id_status]";?>"><?= $row["nama_status"];?></option>
                                    <?php
                                $querystatus = mysqli_query($conn, "SELECT * FROM status") or die (mysqli_error($conn));
                                while($data_status = mysqli_fetch_array($querystatus)) {
                                    echo '<option value="'.$data_status['id_status'].'">'.$data_status['nama_status'].'</option>';
                                }
                                ?>
                                </select>
                            </td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                <a href="print-out.php?id_pay=<?= $row["id_pay"];?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Print</a>
                            </td>
                        </tr>
                        <?php $no++ ;?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <script>
        function updateStatus(orderId, newStatus) {
            // Kirim permintaan ke server dengan informasi yang diperlukan (ID pesanan dan status baru)
            fetch('pesanan.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'order_id=' + orderId + '&new_status=' + newStatus,
                })
                .then(response => {
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
        </script>
    </body>
    </html>