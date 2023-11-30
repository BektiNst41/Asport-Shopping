<?php 
require 'function.php';
require 'fpdf/fpdf.php';

$id_pay = $_GET["id_pay"];

// Menjalankan query SQL untuk mendapatkan informasi produk berdasarkan id_pay
$query = "SELECT user_pay.*, produk.nama_produk, produk.ukuran_produk, users.nama, jenis.nama_jenis, kategori.nama_kategori, status.nama_status 
            FROM user_pay
            INNER JOIN produk ON user_pay.id_produk = produk.id_produk
            INNER JOIN jenis ON produk.id_jenis = jenis.id_jenis
            INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
            INNER JOIN status ON user_pay.id_status = status.id_status
            INNER JOIN users ON user_pay.users_id = users.id_users 
            WHERE id_pay = $id_pay"; 
            
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    
    $nama_produk = $row['nama_produk'];
    $jenis_produk = $row['nama_jenis'];
    $kategori_produk = $row['nama_kategori'];
    $ukuran_produk = $row['ukuran_produk'];
    $jumlah_produk = $row['jumlah_produk'];
    $alamat = $row['alamat'];
    $no = $row['no_order'];
    $tgl = $row['created_at'];
    $created_at_timestamp = $row['created_at'];
    
    $tanggal = date("l, d F Y", strtotime($created_at_timestamp));

$pdf = new FPDF('P', 'mm', "A4");
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 22);
$pdf->Cell(25, 5, 'Resi Pengiriman', 0, 0);
// Tentukan koordinat dan dimensi untuk gambar
$x = 150; // Koordinat X
$y = 5; // Koordinat Y
$width = 45; // Lebar gambar
$height = 0; // Tinggi gambar (0 untuk otomatis mengikuti proporsi gambar)

// Tambahkan gambar ke dalam PDF
$pdf->Image('../../image/logo type b.png', $x, $y, $width, $height);

$pdf->Cell(59, 10, '', 0, 1);
$pdf->Cell(59, 10, '', 0, 1);

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(100, 10, 'Penerima', 0, 0);
$pdf->Cell(59, 5, '', 0, 0);
$pdf->Cell(59, 10, 'Pengirim', 0, 1);

$pdf->SetFont('Arial', '', 10);

$pdf->Cell(20, 10, 'No Order :', 0, 0);
$pdf->Cell(140, 10, '' . $no, 0, 0);
$pdf->Cell(20, 10, 'Admin Asport', 0, 1);

$pdf->Cell(20, 3, 'Tanggal :', 0, 0);
$pdf->Cell(132, 3, '' . $tanggal, 0, 0);
$pdf->Cell(20, 3, 'admin@gmail.com', 0, 1);

$pdf->Cell(20, 10, 'Alamat :', 0, 0);
$pdf->Cell(110, 10, '' . $alamat, 0, 0);
$pdf->Cell(20, 10, '', 0, 1);




// Tentukan koordinat untuk garis
$x1 = 10; // Koordinat X titik awal
$y1 = 70; // Koordinat Y titik awal
$x2 = 200; // Koordinat X titik akhir
$y2 = 70; // Koordinat Y titik akhir

// Tambahkan garis ke dalam PDF
$pdf->Line($x1, $y1, $x2, $y2);

$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(59, 20, '', 0, 1);
$pdf->Cell(130, 5, 'Deskripsi Produk', 0, 1);

$pdf->SetFont('Arial', '', 13);
$pdf->Cell(130, 10, '', 0, 1);
$pdf->Cell(130, 7, 'Nama Produk : ' . $nama_produk, 0, 1);
$pdf->Cell(130, 7, 'Deskripsi : ' . $jenis_produk . ' | ' . $kategori_produk, 0, 1);
$pdf->Cell(130, 7, 'Ukuran Produk : ' . $ukuran_produk, 0, 1);
$pdf->Cell(130, 7, 'Jumlah Produk : ' . $jumlah_produk, 0, 1);

// Tentukan koordinat dan dimensi untuk gambar
$x3 = 140; // Koordinat X
$y3 = 80; // Koordinat Y
$width3 = 50; // Lebar gambar
$height3 = 0; // Tinggi gambar (0 untuk otomatis mengikuti proporsi gambar)

// Tambahkan gambar ke dalam PDF
$pdf->Image('../../image/qr.jpg', $x3, $y3, $width3, $height3);
};


$pdf->Output();
?>
