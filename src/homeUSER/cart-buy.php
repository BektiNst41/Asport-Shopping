<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
<?php
require '../../koneksi.php';

session_start();
if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '0') {
    header('location: ../../login.php');
    exit();
}

$email = $_SESSION['admin_email'];
$id_users = $_SESSION['id_users'];

$total_harga = 0;

$query_select = "SELECT uc.id_cart, uc.qty, uc.created_at, p.id_produk, p.foto_produk, p.nama_produk, jp.nama_jenis, kp.nama_kategori, p.harga_produk, p.ukuran_produk
                FROM user_cart uc
                INNER JOIN produk p ON uc.id_produk = p.id_produk
                INNER JOIN jenis jp ON p.id_jenis = jp.id_jenis
                INNER JOIN kategori kp ON p.id_kategori = kp.id_kategori
                WHERE uc.users_id = '$id_users'";

$result_select = mysqli_query($conn, $query_select);

if (!$result_select) {
    die("Kueri bermasalah: " . mysqli_error($conn));
}

$query = "SELECT id_users, nama, email, phone FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);
if ($result) {
    $user_data = mysqli_fetch_assoc($result);
    $id = $user_data['id_users'];
    $nama = $user_data['nama'];
    $email = $user_data['email'];
    $phone = $user_data['phone'];
} else {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/6f0d2c27b1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
    <title>Form Order</title>
</head>
<style>
    /* Style untuk animasi modal */
    @keyframes slideUp {
      from {
        transform: translateY(100%);
      }
      to {
        transform: translateY(0);
      }
    }
  </style>

<body class="bg-gray-200  items-center justify-center my-6">
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-md ">
    <?php if(mysqli_num_rows($result_select)) : ?>
    <?php while ($row = $result_select->fetch_assoc()) : ?>
        <?php
            $random_number = mt_rand(10000000, 99999999);
            $id_users = $_SESSION['id_users'];
            $id_produk = $row['id_produk'];

            $total_harga_semua_produk = $row['harga_produk'] * $row['qty'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alamat'], $_POST['card_name'], $_POST['num_pay'], $_POST['exp_date'], $_POST['cvv'])) {
                $alamat = $_POST['alamat'];
                $card_name = $_POST['card_name'];
                $num_pay = $_POST['num_pay'];
                $card_cvv = $_POST['cvv'];
                $exp_date = $_POST['exp_date'];
                $cvv = $_POST['cvv'];

                $query_insert_payment = "INSERT INTO user_pay (users_id, id_produk, no_order, total_harga, jumlah_produk, alamat, card_name, num_pay, exp_date, card_cvv, id_status, created_at, updated_at)
                VALUES ('$id_users', '$id_produk', '$random_number', '$total_harga_semua_produk', '$row[qty]', '$alamat', '$card_name', '$num_pay', '$exp_date', '$card_cvv', '1', NOW(), NOW())";

                $result_insert_payment = mysqli_query($conn, $query_insert_payment);

                if ($result_insert_payment) {
                    // Kurangi stok produk setelah transaksi berhasil
                    $query_select_stock = "SELECT stok_produk FROM produk WHERE id_produk = '$id_produk'";
                    $result_select_stock = mysqli_query($conn, $query_select_stock);

                    if ($result_select_stock) {
                        $row_stock = mysqli_fetch_assoc($result_select_stock);
                        $stok_produk = $row_stock['stok_produk'];
                        
                        $sisa_stok = $stok_produk - $row['qty'];
                        $query_update_stock = "UPDATE produk SET stok_produk = '$sisa_stok' WHERE id_produk = '$id_produk'";
                        $result_update_stock = mysqli_query($conn, $query_update_stock);

                        if (!$result_update_stock) {
                            die("Error mengupdate stok produk: " . mysqli_error($conn));
                        }
                    } else {
                        die("Error mengambil stok produk: " . mysqli_error($conn));
                    }
                    $query_delete_cart = "DELETE FROM user_cart WHERE users_id = '$id_users'";
                    $result_delete_cart = mysqli_query($conn, $query_delete_cart);

                    if ($result_delete_cart) {
                        echo "<script>
                        Swal.fire({
                            title: 'Pembayaran Berhasil!',
                            html:
                                '<p>Detail Produk:</p>' +
                                '<p><strong>Nama Produk : </strong> " . $row['nama_produk'] . "</p>' +
                                '<p>" . $row['nama_jenis'] . " | " . $row['nama_kategori'] . "</p>' +
                                '<p><strong>Ukuran Produk : </strong> " . $row['ukuran_produk'] . "</p>',
                            icon: 'success',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn-green-color'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.location.href = 'order.php';
                            }
                        });
                    </script>";
                    } else {
                        die("Error menghapus data dari cart: " . mysqli_error($conn));
                    }
                } else {
                    die("Error melakukan pembayaran: " . mysqli_error($conn));
                }
            }
?>

<div class="pt-2">
<form method="post" action="">
<div class="flex p-4 space-x-5 bg-gray-700 rounded-md m-4 text-white">
    <img src="../homeADMIN/image/<?php echo $row['foto_produk'] ?>" alt="Gambar Produk"
    class="w-2/12 h-auto rounded-md">
    <div class="">
        <p class=" text-4xl mb-8 font-semibold "><?= ucwords($row['nama_produk']) ?></p>
        <p class=" text-xl font-semibold"><?php echo "Rp " . number_format($row['harga_produk'] * $row['qty'], 0, ',', '.'); ?></p>
        <p class=" text-sm "><?= $row['nama_kategori'] ?> | <?php echo $row['nama_jenis']; ?></p>
        <p class=" text-sm w-2/3 ">Jumlah : <?php echo $row['qty']; ?></p>
    </div>
</div>
    <?php
        $total_harga_produk = $row['harga_produk'] * $row['qty'];
        $total_harga += $total_harga_produk;
    ?>

    <?php endwhile; ?>
    <?php else : ?>
    <p>Keranjang belanja Anda kosong.</p>
    <?php endif; ?>
    </div>

<div class=" p-4">
<h2 class="text-2xl font-semibold mb-4">Form Order</h2>
    <div class="mb-4">
        <label for="nama" class="block mb-2 font-semibold">Nama</label>
        <input type="text" placeholder="Nama.." id="nama" name="nama"
            class="w-full text-sm px-3 py-1.5 border rounded-sm" value="<?php echo ucwords($nama); ?>" required>
    </div>
    <div class="mb-4">
        <label for="alamat" class="block mb-2 font-semibold">Alamat</label>
        <textarea type="text" placeholder="Alamat.. " id="alamat" name="alamat" requirexd
            class="w-full text-sm px-3 py-1.5 border rounded-sm" required></textarea>
    </div>
    <div class="flex  justify-between w-full">
        <div class="mb-4">
            <label for="no-telepon" class="block mb-2 font-semibold">No. Telepon</label>
            <input type="text" placeholder="No.Telp.." id="no-telepon" name="no-telepon"
                class="w-96 text-sm px-3 py-1.5 border rounded-sm" value="<?php echo $phone; ?>" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block mb-2 font-semibold">Email</label>
            <input type="email" placeholder="Email.." id="email" name="email"
                class="w-96 text-sm px-3 py-1.5 border rounded-sm" value="<?php echo $email; ?>" required>
        </div>
    </div>
    <div class="flex justify-between">
    <p class="text-black mt-4 font-semibold text-lg">Total : <?php echo "Rp " . number_format($total_harga, 0, ',', ','); ?></p>
    <button id="openModal" type="button" class="bg-black text-white px-4 w-48 py-2 rounded-md hover:bg-gray-600 mt-4 transition-all duration-150 ease-in-out">Order</button>
    </div>

    
    <div id="myModal" class="fixed inset-0 items-center justify-center z-50 hidden flex bg-black bg-opacity-50">
    <div class="bg-white rounded shadow-md w-96" style="animation: slideUp 0.5s ease-out;">
      <div class="flex justify-between">
      <p class="bg-transparent text-black hover:text-gray-800 font-bold py-2 px-4 rounded-full focus:outline-none">PAYMENT METHOD</p>
        
  </div>
      <div class="p-5">
        <h5 class="font-semibold mb-5">Select Your Creadit Cart</h5>
        <div>
            <div class="flex justify-between border p-2 mb-3" onclick="checkRadio('BCA')">
                <label class="text-black font-medium rounded"><img src="../../image/pay/BCA.png" alt="BCA LOGO" id="BCA" class="w-20"></label>
                <input type="radio" name="card_name" value="BCA" id="radio_BCA" class="border-2 border-black">
            </div>

            <div class="flex justify-between border p-2 mb-3" onclick="checkRadio('Mandiri')">
                <label class="text-black font-medium rounded"><img src="../../image/pay/Mandiri.png" alt="Mandiri LOGO" id="Mandiri" class="w-24"></label>
                <input type="radio" name="card_name" value="Mandiri" id="radio_Mandiri" class="border-2 border-black">
            </div>
            <div class="flex justify-between border p-2 mb-3" onclick="checkRadio('BRI')">
                <label class="text-black font-medium rounded"><img src="../../image/pay/BRI.png" alt="BRI LOGO" id="BRI" class="w-20"></label>
                <input type="radio" name="card_name" value="BCA" id="radio_BRI" class="border-2 border-black">
            </div>

            <div class="flex justify-between border p-2 mb-3" onclick="checkRadio('Visa')">
                <label class="text-black font-medium rounded"><img src="../../image/pay/Visa.png" alt="Visa LOGO" id="Visa" class="w-24"></label>
                <input type="radio" name="card_name" value="Visa" id="radio_Visa" class="border-2 border-black">
            </div>
            </div>

            <label class="text-black font-medium text-sm mb-3">Credit Card Number</label>
            <input type="text" name="num_pay" class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black" placeholder="111-111-111-111" oninput="formatCardNumber(this)"  maxlength="11">

            <div class="flex mt-5">
                <div class="container pr-2">
                    <label class="text-black font-medium text-sm mb-3">Experation Date</label>
                    <div class="mb-2">
                        <input type="date" id="date" name="exp_date" placeholder="Experation Date..."
                            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black">
                    </div>
                </div>
                <div class="container pl-2">
                    <label  class="text-black font-medium text-sm mb-3">CVV</label>
                    <div class="mb-2">
                    <input type="number" id="cvv" name="cvv" placeholder="Your CVV..." class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black placeholder-gray-500 italic">
                    </div>
                </div>
            </div>

            <div class="flex mt-5 gap-3">
                <div class="container pr-2">
                    <label class="text-black font-medium text-sm mb-3">Total Belanja : </label>
                    <div>
                        <p id="total-price-belanja" class="total-price text-sm font-semibold">
                        <?php echo "Rp " . number_format($total_harga, 0, ',', ','); ?>
                        </p>
                    </div>
                </div>
                <div class="container pl-2">
                
                <input type="hidden" name="id_produk" value="<?= $id_produk; ?>">
                <input type="hidden" name="no_order" value="<?= $random_number; ?>">
                <button type="submit" class="bg-black text-white px-4 w-48 py-2 rounded-md hover:bg-gray-600 mt-4 transition-all duration-150 ease-in-out">Pay</button>
            </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
    <!-- payment end-->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script>
        // JavaScript
        function formatCardNumber(input) {
            let cardNumber = input.value.replace(/\D/g, '');

            if (cardNumber.length > 0) {
                cardNumber = cardNumber.slice(0, 9);
                cardNumber = cardNumber.match(new RegExp('.{1,3}', 'g')).join('-');
            }

            input.value = cardNumber;
        }

    </script>

    <script>
    const openModalBtn = document.getElementById('openModal');
    const closeModalBtn = document.getElementById('closeModal');
    const modal = document.getElementById('myModal');

    openModalBtn.addEventListener('click', () => {
      modal.classList.remove('hidden');
    });

    closeModalBtn.addEventListener('click', () => {
      modal.classList.add('hidden');
    });

    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.add('hidden');
      }
    });
  </script>
  
  <script>
    function checkRadio(id) {
      
      var radio = document.getElementById('radio_' + id);

      if (radio) {
        if (!radio.checked) {

          radio.checked = true;
        }
      }
    }
    </script>
</body>
</html>