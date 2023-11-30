<?php
    require '../../function.php';

    session_start();

if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '1') {
    // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
    header('location: ../../login.php'); // Sesuaikan dengan nama halaman login Anda.
    exit();
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../../font.css">
    <title>Halaman Admin | Home</title>
</head>

<body class="bg-gray-100">
    <div>
        <?php include "header.php"; ?>
    </div>
    <div>
        <?php include "sidebar.php"; ?>
    </div>

    <div class="container mx-auto mt-32">
        <div class="bg-white overflow-hidden shadow-lg ml-56 rounded-lg h-36">
            <div class="px-6 py-4 flex mr-3 justify-between">
                <div class="font-bold mb-2">
                    <h1 class=" text-4xl my-3">Hi, <?= ucwords($admin_name); ?></h1>
                    <p class="text-gray-800 text-md">Selamat Datang Kembali <?= ucwords($admin_name); ?>...</p>
                </div>
                <div class=""><img src="admin.png" class="w-auto h-48 absolute right-14 top-24"></div>
            </div>
        </div>
        <div class="container mx-auto mt-10 flex justify-between">
            <div class="w-1/3 mx-2 ml-56">
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <div class="px-6 py-4 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-12 h-12 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                        </svg>
                        <?php
                            $total_stok_produk = mysqli_query($conn, "SELECT SUM(stok_produk) FROM produk");
                            $jumlah_produk = mysqli_fetch_array($total_stok_produk)[0];
                        ?>
                        <div class=" mb-2">
                            <p class="font-bold text-md">Jumlah Barang</p>
                            <p class="text-gray-700"><?=$jumlah_produk?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/3 mx-2">
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <div class="px-6 py-4 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-12 h-12 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>

                        <div class=" mb-2">
                        <?php
                        $jumlahpesanan = mysqli_query($conn, "SELECT * FROM user_pay");
                        $jumlahpesanan = mysqli_num_rows($jumlahpesanan);
                        ?>
                            <p class="font-bold text-md">Jumlah Pesanan</p>
                            <p class="text-gray-700"><?= $jumlahpesanan; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/3 mx-2">
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <div class="px-6 py-4 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-12 h-12 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg>
                        <?php
                        $sql = "SELECT total_harga FROM user_pay";
                        $result = mysqli_query($conn, $sql);
                        
                        // Inisialisasi variabel untuk menyimpan jumlah harga
                        $totalHarga = 0;
                        
                        // Loop melalui hasil query dan tambahkan harga ke total
                        while ($row = mysqli_fetch_assoc($result)) {
                            $hargaProduk = $row['total_harga']; 
                            $totalHarga += $hargaProduk;
                        }
                        ?>
                        <div class=" mb-2">
                            <p class="font-bold text-md">Pendapatan</p>
                            <p class="text-gray-700"><?php echo "Rp ".number_format($totalHarga,0,',','.'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/3 mx-2">
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <div class="px-6 py-4 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                    </svg>

                        </svg>
                        <div class=" mb-2">
                        <?php
                        $jumlaterjual = "SELECT jumlah_produk FROM user_pay";
                        $jumlaterjual = mysqli_query($conn, $jumlaterjual);

                        $total_terjual = 0;
                        while ($row_jual = mysqli_fetch_assoc($jumlaterjual)){
                            $jumlahjual = $row_jual['jumlah_produk'];
                            $total_terjual += $jumlahjual;
                        }
                        ?>
                            <p class="font-bold text-md">Barang Terjual</p>
                            <p class="text-gray-700"><?= $total_terjual; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=" justify-between flex">
            <div class="bg-white shadow-lg ml-56 w-fit rounded-lg mt-7">
                <div class="w-[30rem]">
                    <canvas id="modal" class=""></canvas>
                </div>
            </div>
            <div class="bg-white shadow-lg w-fit rounded-lg mt-7">
                <div class="w-[30rem]">
                    <canvas id="grafik" class=""></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
    var ctx = document.getElementById("grafik").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Men", "Women", "Kids"],
            datasets: [{
                label: 'Data Produk',
                data: [
                    <?php
                        $conn = mysqli_connect("localhost", "root", "", "shopping");

                        $men = mysqli_query($conn, "SELECT produk.*, jenis.nama_jenis FROM produk
                        INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis WHERE nama_jenis = 'Men'");
                        echo mysqli_num_rows($men);
                        ?>,

                    <?php
                        $women = mysqli_query($conn, "SELECT produk.*, jenis.nama_jenis FROM produk
                        INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis WHERE nama_jenis = 'Women'");
                        echo mysqli_num_rows($women);
                        ?>,

                    <?php
                        $kids = mysqli_query($conn, "SELECT produk.*, jenis.nama_jenis FROM produk
                        INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis WHERE nama_jenis = 'Kids'");
                        echo mysqli_num_rows($kids);
                        ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        }
    })
    </script>

    <script>
    var ctx = document.getElementById("modal").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
				datasets: [{
					label: 'Jumlah Perbulan',
					data: [
                        <?php 
                            $jumlah_produk_query = mysqli_query($conn, "SELECT SUM(jumlah_produk) AS total_produk FROM user_pay WHERE MONTH(created_at) = 1");
                            $row = mysqli_fetch_assoc($jumlah_produk_query);
                            $total_produk = $row['total_produk'];

                            echo $total_produk;
                        ?>,
                        <?php 
                            $jumlah_produk_query = mysqli_query($conn, "SELECT SUM(jumlah_produk) AS total_produk FROM user_pay WHERE MONTH(created_at) = 2");
                            $row = mysqli_fetch_assoc($jumlah_produk_query);
                            $total_produk = $row['total_produk'];

                            echo $total_produk;
                        ?>,

                        <?php 
                            $jumlah_produk_query = mysqli_query($conn, "SELECT SUM(jumlah_produk) AS total_produk FROM user_pay WHERE MONTH(created_at) = 3");
                            $row = mysqli_fetch_assoc($jumlah_produk_query);
                            $total_produk = $row['total_produk'];

                            echo $total_produk;
                        ?>, 
                        <?php 
                            $jumlah_produk_query = mysqli_query($conn, "SELECT SUM(jumlah_produk) AS total_produk FROM user_pay WHERE MONTH(created_at) = 4");
                            $row = mysqli_fetch_assoc($jumlah_produk_query);
                            $total_produk = $row['total_produk'];

                            echo $total_produk;
                        ?>, 
                        <?php 
                            $jumlah_produk_query = mysqli_query($conn, "SELECT SUM(jumlah_produk) AS total_produk FROM user_pay WHERE MONTH(created_at) = 5");
                            $row = mysqli_fetch_assoc($jumlah_produk_query);
                            $total_produk = $row['total_produk'];

                            echo $total_produk;
                        ?>, 
                        <?php 
                            $jumlah_produk_query = mysqli_query($conn, "SELECT SUM(jumlah_produk) AS total_produk FROM user_pay WHERE MONTH(created_at) = 6");
                            $row = mysqli_fetch_assoc($jumlah_produk_query);
                            $total_produk = $row['total_produk'];

                            echo $total_produk;
                        ?>, 
                        <?php 
                            $jumlah_produk_query = mysqli_query($conn, "SELECT SUM(jumlah_produk) AS total_produk FROM user_pay WHERE MONTH(created_at) = 7");
                            $row = mysqli_fetch_assoc($jumlah_produk_query);
                            $total_produk = $row['total_produk'];

                            echo $total_produk;
                        ?>, 
                        <?php 
                            $jumlah_produk_query = mysqli_query($conn, "SELECT SUM(jumlah_produk) AS total_produk FROM user_pay WHERE MONTH(created_at) = 8");
                            $row = mysqli_fetch_assoc($jumlah_produk_query);
                            $total_produk = $row['total_produk'];

                            echo $total_produk;
                        ?>, 
                        <?php 
                            $jumlah_produk_query = mysqli_query($conn, "SELECT SUM(jumlah_produk) AS total_produk FROM user_pay WHERE MONTH(created_at) = 9");
                            $row = mysqli_fetch_assoc($jumlah_produk_query);
                            $total_produk = $row['total_produk'];

                            echo $total_produk;
                        ?>, 
                        <?php 
                            $jumlah_produk_query = mysqli_query($conn, "SELECT SUM(jumlah_produk) AS total_produk FROM user_pay WHERE MONTH(created_at) = 10");
                            $row = mysqli_fetch_assoc($jumlah_produk_query);
                            $total_produk = $row['total_produk'];

                            echo $total_produk;
                        ?>, 
                        <?php 
                            $jumlah_produk_query = mysqli_query($conn, "SELECT SUM(jumlah_produk) AS total_produk FROM user_pay WHERE MONTH(created_at) = 11");
                            $row = mysqli_fetch_assoc($jumlah_produk_query);
                            $total_produk = $row['total_produk'];

                            echo $total_produk;
                        ?>, 
                        <?php 
                            $jumlah_produk_query = mysqli_query($conn, "SELECT SUM(jumlah_produk) AS total_produk FROM user_pay WHERE MONTH(created_at) = 12");
                            $row = mysqli_fetch_assoc($jumlah_produk_query);
                            $total_produk = $row['total_produk'];

                            echo $total_produk;
                        ?>, 
					],
					backgroundColor: [
					'rgba(112, 112, 112, 0.5)',
					'rgba(227, 135, 79, 0.5)',
					'rgba(10, 135, 84, 0.5)',
					'rgba(0, 79, 45, 0.5)',
					'rgba(123, 126, 144, 0.5)',
					'rgba(186, 121, 78, 0.5)',
					'rgba(235, 235, 211, 0.5)',
					'rgba(70, 53, 29, 0.5)',
					'rgba(191, 210, 191, 0.5)',
					'rgba(226, 138, 79, 0.5)',
					'rgba(219, 233, 238, 0.5)',
					'rgba(194, 207, 178, 0.5)'
					],
					borderColor: [
					'rgba(112, 112, 112, 1)',
					'rgba(227, 135, 79, 1)',
					'rgba(10, 135, 84, 1)',
					'rgba(0, 79, 45, 1)',
					'rgba(123, 126, 144, 1)',
					'rgba(186, 121, 78, 1)',
					'rgba(235, 235, 211, 1)',
					'rgba(70, 53, 29, 1)',
					'rgba(191, 210, 191, 1)',
					'rgba(226, 138, 79, 1)',
					'rgba(219, 233, 238, 1)',
					'rgba(194, 207, 178, 1)'
					],
					borderWidth: 2
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});

    </script>
</body>

</html>