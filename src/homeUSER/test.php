<?php
require '../../koneksi.php';

$host = 'localhost';
$dbname = 'shopping';
$username = 'root';
$password = '';

$id_produk = $_GET["id_produk"] ?? null;

session_start();
$id_users = $_SESSION['id_users'] ?? null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim melalui AJAX
    $id_produk = $_POST['id_produk'] ?? null;
    $users_id = $_POST['users_id'] ?? null;
    $rating = $_POST['rating'] ?? null;
    $comment = $_POST['comment'] ?? null;

    // Validasi data (misalnya pastikan $id_produk dan $users_id tidak null)

    // Buat koneksi
    $conn = new mysqli($host, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi database gagal: " . $conn->connect_error);
    }

    // Siapkan statement SQL menggunakan prepared statement
    $stmt = $conn->prepare("INSERT INTO user_rating (id_produk, users_id, rating, comment) VALUES (?, ?, ?, ?)");

    // Bind parameter ke statement
    $stmt->bind_param("iiss", $id_produk, $users_id, $rating, $comment);

    // Jalankan statement
    if ($stmt->execute()) {
        echo "Data rating berhasil disimpan!";
    } else {
        echo "Error: " . $stmt->error; // Tampilkan pesan kesalahan SQL jika terjadi
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Star Rating dengan jQuery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<style>
/* Animasi Pop-up */
@keyframes modalAnimation {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }

    to {
        transform: translateY(0);
        opacity: 1;
    }
}
label i {
  color: grey; /* Warna bintang tidak dipilih */
}

.selected i {
  color: gold; /* Warna bintang yang dipilih */
}


</style>

<body class="bg-gray-200 flex items-center justify-center h-screen">

    <div class="bg-white rounded-lg shadow p-8 w-80">
        <!-- Tombol untuk memunculkan modal -->
        <button id="openModal" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Beri Rating</button>

      
        <div id="ratingModal"
            class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow p-8 w-80" style="animation: modalAnimation 0.3s ease;">
                <h2 class="text-lg font-bold mb-4">Beri Rating Produk</h2>
                <div class="flex items-center mb-4" id="ratingStars">
                    <!-- Star Rating -->
                    <input type="radio" hidden id="star1" name="rating" value="1" />
                    <label for="star1"><i class="fas fa-star"></i></label>
                    <input type="radio" hidden id="star2" name="rating" value="2" />
                    <label for="star2"><i class="fas fa-star"></i></label>
                    <input type="radio" hidden id="star3" name="rating" value="3" />
                    <label for="star3"><i class="fas fa-star"></i></label>
                    <input type="radio" hidden id="star4" name="rating" value="4" />
                    <label for="star4"><i class="fas fa-star"></i></label>
                    <input type="radio" hidden id="star5" name="rating" value="5" />
                    <label for="star5"><i class="fas fa-star"></i></label>
                </div>
                <input type="text" id="comment" name="comment" class="border rounded-md w-full px-3 py-2 mb-4"
                    placeholder="Tulis komentar Anda...">
                <button id="submitRating" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit</button>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        // Event saat tombol "Beri Rating" diklik untuk menampilkan modal
        $('#openModal').on('click', function () {
            // Mendapatkan nilai id_produk dari parameter GET
            const urlParams = new URLSearchParams(window.location.search);
            const id_produk = urlParams.get('id_produk');

            // Redirect ke URL dengan parameter id_produk
            if (id_produk) {
                window.location.href = 'test.php?id_produk=' + id_produk;
            } else {
                // Jika id_produk tidak ada, bisa dilakukan penanganan lainnya atau tindakan yang sesuai
                console.error('ID Produk tidak tersedia.');
            }
        });

        // Event saat tombol submit diklik
        $('#submitRating').on('click', function () {
            const id_produk = $('input[name="id_produk"]').val(); // Mendapatkan nilai id_produk dari form atau sesuai kebutuhan
            const users_id = <?php echo json_encode($_SESSION['id_users'] ?? null); ?>;
            const rating = $('input[name="rating"]:checked').val();
            const comment = $('#comment').val();

            // Kirim data rating ke server menggunakan AJAX (contoh dengan PHP)
            $.ajax({
                url: 'test.php', // Ganti dengan path ke file PHP yang sesuai
                method: 'POST',
                data: {
                    id_produk: id_produk,
                    users_id: users_id,
                    rating: rating,
                    comment: comment
                },
                success: function (response) {
                    console.log(response); // Tampilkan respons dari server (untuk keperluan debugging)
                    // Tambahkan logika lain setelah pengiriman data berhasil jika diperlukan
                },
                error: function (error) {
                    console.error(error); // Tampilkan pesan error jika pengiriman data gagal
                }
            });
        });
    });
</script>
        <script>
          const stars = document.querySelectorAll('input[name="rating"]');
          const starLabels = document.querySelectorAll('label');

          stars.forEach((star, index) => {
            star.addEventListener('change', () => {
              const clickedStarValue = parseInt(star.value, 10);

              starLabels.forEach((label, idx) => {
                if (idx < clickedStarValue) {
                  label.classList.add('selected');
                } else {
                  label.classList.remove('selected');
                }
              });
            });
          });
        </script>
</body>

</html>