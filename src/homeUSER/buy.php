<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

<?php
require '../homeADMIN/function.php';

session_start();
if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '0') {
    // Pengguna belum login atau bukan admin, arahkan mereka ke halaman login atau halaman lain.
    header('location: ../../login.php'); // Sesuaikan dengan nama halaman login Anda.
    exit();
}

$id_produk =$_GET["id_produk"];
$id_users = $_SESSION['id_users'];

$query = "SELECT produk.*, jenis.nama_jenis, kategori.nama_kategori FROM produk
        INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
        INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
        WHERE produk.id_produk = $id_produk";

$result = mysqli_query($conn, $query);
$produk = mysqli_fetch_assoc($result);

$email = $_SESSION['admin_email'];
$query = "SELECT id_users, nama, email, phone FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);
if ($result) {
    $user_data = mysqli_fetch_assoc($result);
    $id = $user_data['id_users'];
    $nama = $user_data['nama'];
    $email = $user_data['email'];
    $phone = $user_data['phone'];
} else {
    // Handle kesalahan saat mengambil data pengguna dari database
    die("Error: " . mysqli_error($conn));
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>Form Order</title>
    <style>
    @keyframes slideUp {
        from {
            transform: translateY(100%);
        }

        to {
            transform: translateY(0);
        }
    }

    .btn-green-color {
        background-color: #69a907 !important;
        color: white !important;
    }
    </style>
</head>

<body class="bg-gray-200  h-screen items-center justify-center">
    <form class="py-20" action="" method="POST">
        <div class="max-w-4xl mx-auto bg-white p-4 shadow-md rounded-md ">
            <div class="">
                <div class="flex p-4 space-x-5 bg-gray-700 rounded-md my-4 text-white">
                    <img src="../homeADMIN/image/<?php echo $produk['foto_produk'] ?>" alt="Gambar Produk"
                        class="w-2/12 h-auto  rounded-md">
                    <div class="">
                        <p class=" text-4xl font-bold "><?= ucwords($produk['nama_produk']) ?></p>
                        <p class=" text-2xl font-semibold mt-8">
                            <?= "Rp ".number_format($produk['harga_produk'], 0, ',', '.'); ?></p>
                        <p class=" text-sm mt-1"><?= $produk['nama_kategori'] ?> | <?= $produk['nama_jenis'] ?></p>
                        <p class=" text-sm mt-1">Ukuran : <?= $produk['ukuran_produk'] ?></p>
                    </div>
                </div>
                <div class=" p-4">
                    <h2 class="text-2xl font-semibold mb-4">Form Order</h2>
                    <div class="mb-4">
                        <label for="nama" class="block font-semibold text-sm">Nama</label>
                        <input type="text" placeholder="Nama.." id="nama" name="nama" readonly
                            class="w-full text-sm px-3 py-1.5 border rounded-sm" value="<?php echo ucwords($nama); ?>"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="alamat" class="block font-semibold">Alamat</label>
                        <textarea type="text" placeholder="Alamat.. " id="nama" name="alamat" required
                            class="w-full text-sm px-3 py-1.5 border rounded-sm"></textarea>
                    </div>
                    <div class="flex  justify-between w-full">
                        <div class="mb-4">
                            <label for="no-telepon" class="block font-semibold text-sm ">No. Telepon</label>
                            <input type="text" placeholder="No.Telp.." id="no-telepon" name="no-telepon" readonly
                                class="w-96 text-sm px-3 py-1.5 border rounded-sm" value="<?php echo $phone; ?>"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block font-semibold text-sm ">Email</label>
                            <input type="email" placeholder="Email.." id="email" name="email" readonly
                                class="w-96 text-sm px-3 py-1.5 border rounded-sm" value="<?php echo $email; ?>"
                                required>
                        </div>
                    </div>
                    <div class="mb-4 mt-3 flex space-x-36 justify-between">
                        <div class="">
                            <label for="quantity" class="block font-semibold text-sm mb-2">Jumlah</label>
                            <div class="flex items-center container">
                                <div class="flex w-full  rounded-sm ">
                                    <button type="button" id="decrement"
                                        class="px-4 py-1.5 bg-black text-white hover:bg-gray-600 font-bold rounded-l-md transition-all duration-150 ease-in-out"
                                        onclick="decrementQuantity()">-</button>
                                    <input type="number" id="quantity" name="jumlah"
                                        class="w-16 px-3 py-1.5 border border-gray-200 text-center" min="1" value="1"
                                        required onchange="updateTotalPrices()"
                                        max="<?php echo $produk['stok_produk']; ?>">
                                    <button type="button" id="increment"
                                        class="px-3 py-1.5 bg-black text-white hover:bg-gray-600 font-bold rounded-r-md transition-all duration-150 ease-in-out"
                                        onclick="incrementQuantity()">+</button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <label for="total-price" class="block font-semibold text-lg mb-1">Total Harga</label>
                                <p id="total-price-harga" class="total-price mt-1 text-3xl font-semibold">
                                    <?php echo "Rp. ".number_format($produk['harga_produk'], 0, ',', ','); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button id="openModal" type="button"
                            class="bg-black text-white px-4 w-48 py-2 rounded-md hover:bg-gray-600 mt-4 transition-all duration-150 ease-in-out">Order</button>
                    </div>
                </div>
            </div>
        </div>

        <!--payment-->

        <div id="myModal" class="fixed inset-0 items-center justify-center z-50 hidden flex bg-black bg-opacity-50">
            <div class="bg-white rounded shadow-md w-96" style="animation: slideUp 0.5s ease-out;">
                <div class="flex justify-between">
                    <p
                        class="bg-transparent text-black hover:text-gray-800 font-bold py-2 px-4 rounded-full focus:outline-none">
                        PAYMENT METHOD</p>
                    <button id="closeModal"
                        class="bg-transparent text-black hover:text-gray-800 font-bold py-2 px-4 rounded-full focus:outline-none">
                        X
                    </button>
                </div>
                <div class="p-5">
                    <h5 class="font-semibold mb-5">Select Your Creadit Cart</h5>
                    <div>
                        <div class="flex justify-between border p-2 mb-3" onclick="checkRadio('BCA')">
                            <label class="text-black font-medium rounded"><img src="../../image/pay/BCA.png"
                                    alt="BCA LOGO" id="BCA" class="w-20"></label>
                            <input type="radio" name="card_name" required value="BCA" id="radio_BCA"
                                class="border-2 border-black">
                        </div>

                        <div class="flex justify-between border p-2 mb-3" onclick="checkRadio('Mandiri')">
                            <label class="text-black font-medium rounded"><img src="../../image/pay/Mandiri.png"
                                    alt="Mandiri LOGO" id="Mandiri" class="w-24"></label>
                            <input type="radio" name="card_name" required value="Mandiri" id="radio_Mandiri"
                                class="border-2 border-black">
                        </div>
                        <div class="flex justify-between border p-2 mb-3" onclick="checkRadio('BRI')">
                            <label class="text-black font-medium rounded"><img src="../../image/pay/BRI.png"
                                    alt="BRI LOGO" id="BRI" class="w-20"></label>
                            <input type="radio" name="card_name" required value="BCA" id="radio_BRI"
                                class="border-2 border-black">
                        </div>

                        <div class="flex justify-between border p-2 mb-3" onclick="checkRadio('Visa')">
                            <label class="text-black font-medium rounded"><img src="../../image/pay/Visa.png"
                                    alt="Visa LOGO" id="Visa" class="w-24"></label>
                            <input type="radio" name="card_name" required value="Visa" id="radio_Visa"
                                class="border-2 border-black">
                        </div>
                    </div>

                    <label class="text-black font-medium text-sm mb-3">Credit Card Number</label>
                    <input type="text" name="num_pay"
                        class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black"
                        placeholder="111-111-111-111" oninput="formatCardNumber(this)" maxlength="11" required>

                    <div class="flex mt-5">
                        <div class="container pr-2">
                            <label class="text-black font-medium text-sm mb-3">Experation Date</label>
                            <div class="mb-2">
                                <input type="date" id="date" name="exp_date" placeholder="Experation Date..." required
                                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black">
                            </div>
                        </div>
                        <div class="container pl-2">
                            <label class="text-black font-medium text-sm mb-3">CVV</label>
                            <div class="mb-2">
                                <input type="number" id="cvv" name="cvv" required placeholder="Your CVV..."
                                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black placeholder-gray-500">
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-5 gap-3">
                        <div class="container pr-2">
                            <label class="text-black font-medium text-sm mb-3">Total Belanja : </label>
                            <div>
                                <p id="total-price-belanja" class="total-price text-lg font-semibold">
                                    <?php echo "Rp. ".number_format($produk['harga_produk'], 0, ',', ','); ?>
                                </p>
                            </div>
                        </div>
                        <div class="container pl-2">

                            <input type="hidden" name="no_order" value="<?php echo $random_number; ?>">
                            <input type="hidden" name="id_produk" value="<?= $data["id_produk"]; ?>">
                            <input type="hidden" name="total-harga" value="<?php echo $produk['harga_produk']; ?>">
                            <button
                                class="bg-black text-white px-4 w-36 py-2 rounded-md hover:bg-gray-600 mt-2 transition-all duration-150 ease-in-out"
                                name="pay" type="submit">Pay</button>
                            <?php
                $random_number = mt_rand(10000000, 99999999);

                if (isset($_POST['pay'])) {
                    $no_order = $random_number;
                    $jumlah_produk = $_POST['jumlah'];
                    $total_harga = $produk['harga_produk'] * $jumlah_produk;
                    $alamat = $_POST['alamat'];
                    $card_name = $_POST['card_name'];
                    $num_pay = $_POST['num_pay'];
                    $exp_date = $_POST['exp_date']; 
                    $card_cvv = $_POST['cvv'];
                
                
                    $query_insert = "INSERT INTO user_pay(users_id, id_produk, no_order, total_harga, jumlah_produk, alamat, card_name, num_pay, exp_date, card_cvv, id_status, created_at, updated_at) 
                                    VALUES ('$id_users', '$id_produk', '$no_order', '$total_harga', '$jumlah_produk', '$alamat', '$card_name', '$num_pay', '$exp_date', '$card_cvv', '1', NOW(), NOW())";
                
                    $result_insert = mysqli_query($conn, $query_insert);
                
                if ($result_insert) {
                    // Mengurangi stok produk
                    $query_update_stok = "UPDATE produk SET stok_produk = stok_produk - $jumlah_produk WHERE id_produk = $id_produk";
                    $result_update_stok = mysqli_query($conn, $query_update_stok);
                
                    if ($result_update_stok) {
                        echo "<script>
                            Swal.fire({
                                title: 'Pembayaran Berhasil!',
                                html:
                                    '<p>Detail Produk:</p>' +
                                    '<p><strong>Nama Produk : </strong> " . $produk['nama_produk'] . "</p>' +
                                    '<p>" . $produk['nama_jenis'] . " | " . $produk['nama_kategori'] . "</p>' +
                                    '<p><strong>Ukuran Produk : </strong> " . $produk['ukuran_produk'] . "</p>',
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
                        echo "Terjadi kesalahan saat mengupdate stok produk: " . mysqli_error($conn);
                    }
                } else {
                    echo "Terjadi kesalahan saat melakukan pembayaran: " . mysqli_error($conn);
                }
                
                }
                ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </form>
    </div>
    <!-- payment end-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

    <script>
    // JavaScript
    function formatCardNumber(input) {
        // Menghapus semua kecuali digit
        let cardNumber = input.value.replace(/\D/g, '');

        // Menambahkan tanda "-" setiap setelah tiga digit
        if (cardNumber.length > 0) {
            cardNumber = cardNumber.slice(0, 9);
            cardNumber = cardNumber.match(new RegExp('.{1,3}', 'g')).join('-');
        }

        // Menetapkan nilai yang telah diformat kembali ke input
        input.value = cardNumber;
    }
    </script>
    <script>
    function checkRadio(id) {
        // Dapatkan input radio yang sesuai dengan ID yang diklik
        var radio = document.getElementById('radio_' + id);

        if (radio) {
            // Periksa apakah input radio tersebut sudah dicek atau tidak
            if (!radio.checked) {
                // Jika belum dicek, atur status checked menjadi true
                radio.checked = true;
            }
        }
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

    // Menutup modal saat area luar modal diklik
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
    </script>

    <script>
    function incrementQuantity() {
        const quantityInput = document.getElementById('quantity');
        const pricePerItem = <?= $produk['harga_produk']; ?>; // Harga produk per item

        // Memeriksa apakah stok_produk sudah mencapai batas maksimum atau tidak
        let maxStock = parseInt(quantityInput.getAttribute('max'));
        if (parseInt(quantityInput.value) < maxStock) {
            // Memperbarui nilai input jumlah
            quantityInput.value = parseInt(quantityInput.value) + 1;

            // Menghitung harga total
            const total = pricePerItem * parseInt(quantityInput.value);
            updateTotalPrice(total, 'total-price-harga');
            updateTotalPrices(); // Memanggil fungsi untuk memperbarui total belanja
        }
    }

    function decrementQuantity() {
        const quantityInput = document.getElementById('quantity');
        const pricePerItem = <?= $produk['harga_produk']; ?>; // Harga produk per item

        // Memperbarui nilai input jumlah
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;

            // Menghitung harga total setelah mengurangi nilai
            const total = pricePerItem * parseInt(quantityInput.value);
            updateTotalPrice(total, 'total-price-harga');
            updateTotalPrices(); // Memanggil fungsi untuk memperbarui total belanja
        }
    }


    function updateTotalPrice(price, targetId) {
        const totalPriceElement = document.getElementById(targetId);
        totalPriceElement.innerText = 'Rp. ' + numberWithCommas(price);
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function updateTotalPrices() {
        const pricePerItem = <?= $produk['harga_produk']; ?>; // Harga produk per item
        const quantity = parseInt(document.getElementById('quantity').value);

        const totalHarga = pricePerItem * quantity;
        updateTotalPrice(totalHarga, 'total-price-harga');

        // Update label "Total Belanja" seiring dengan total harga
        const totalBelanja = totalHarga; // Contoh perhitungan total belanja
        updateTotalPrice(totalBelanja, 'total-price-belanja');

        // Update teks label "Total Belanja"
        const labelTotalBelanja = document.getElementById('label-total-belanja');
        labelTotalBelanja.innerText = 'Total Belanja : Rp. ' + numberWithCommas(totalBelanja);
    }

    // Pemanggilan fungsi updateTotalPrices() saat terjadi perubahan pada jumlah
    document.getElementById('quantity').addEventListener('change', updateTotalPrices);

    // Pemanggilan fungsi updateTotalPrices() untuk menginisialisasi total harga saat halaman dimuat
    updateTotalPrices();
    </script>

</body>

</html>