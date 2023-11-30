<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
</head>
<body>
    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
<?php
require '../../koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];
    $ratingValue = $_POST['ratingValue'];
    $comment = $_POST['comment'];

    // Pastikan variabel $id_users terdefinisi
    $id_users = $_SESSION['id_users'] ?? null;

    if ($id_users !== null) {
        try {
            $query = $pdo->prepare("INSERT INTO user_rating (id_produk, users_id, rating, comment) VALUES (?, ?, ?, ?)");
            $query->execute([$productId, $id_users, $ratingValue, $comment]);
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Terima Kasih Atas Rating Anda!!',
                showConfirmButton: false,
                timer: 2000 // Durasi notifikasi (dalam milidetik)
            }).then(() => {
                // Setelah notifikasi ditutup, arahkan kembali ke order.php
                window.location.href = 'order.php'; // Ganti dengan path yang sesuai
            });       
            </script>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'ID Pengguna tidak valid.';
    }
} else {
    echo 'Metode request tidak valid.';
}
?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
</body>
</html>
