<?php 
$conn = mysqli_connect("localhost", "root", "", "shopping");

function query($query) {
    global $conn;
    
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }
    
    $rows = []; 
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    
    return $rows;
}

function tambahkategori($data){
    global $conn;

    $nama_kategori = $data["nama_kategori"];

    $queryadd = "INSERT INTO `kategori` VALUES ('', '$nama_kategori')";
    mysqli_query($conn, $queryadd);

    return mysqli_affected_rows($conn);
}


function hapuskategori($id_kategori) {
    global $conn;
    mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = $id_kategori");
    return mysqli_affected_rows($conn);
}

function editkategori($data){
    global $conn;

    $id_kategori = $data["id_kategori"];
    $nama_kategori = htmlspecialchars($data["nama_kategori"]);

    
    $query = "UPDATE kategori SET
              nama_kategori = '$nama_kategori'
        WHERE id_kategori = '$id_kategori'
             ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahproduk($data){
    global $conn;

    $nama_produk = $data["nama_produk"];
    $harga_produk = $data["harga_produk"];
    $harga_produk_clean = str_replace(['Rp. ', '.'], '', $harga_produk);
    $ukuran_produk = $data["ukuran_produk"];
    $jenis_produk = $data["jenis_produk"];
    $kategori_produk = $data["kategori_produk"];
    $stok_produk = $data["stok_produk"];
    $desc_produk = $data["desc_produk"];

    $foto_produk = uploadproduk();
    if( !$foto_produk) {
        return false;
    }

    $queryaddproduk = "INSERT INTO `produk` VALUES ('', '$foto_produk', '$nama_produk', '$harga_produk_clean', '$ukuran_produk', '$jenis_produk', '$kategori_produk', '$stok_produk', '$desc_produk')";
    mysqli_query($conn, $queryaddproduk);

    return mysqli_affected_rows($conn);
}

    function uploadproduk() {
        $namaFile = $_FILES['foto_produk']['name'];
        $sizeFile = $_FILES['foto_produk']['size'];
        $error = $_FILES['foto_produk']['error'];
        $tmpName = $_FILES['foto_produk']['tmp_name'];

        //cek upload gambar
        if( $error === 4) {
            echo "<script>
            alert('Format Foto Tidak Valid');
            </script>";
            
        return false;
        }

        // cek just image
        $validationimage = ['jpg', 'jpeg', 'png'];
        $ekstensigambar = explode('.', $namaFile);
        $ekstensigambar = strtolower(end($ekstensigambar));
        if( !in_array($ekstensigambar, $validationimage)) {
            echo "<script>
            alert('Format Foto Tidak Benar');
            </script>";
        return false;
        }
        
        //size foto

        if( $sizeFile > 1000000){
            echo "<script>
            alert('Ukuran Foto Terlalu Besar');
            </script>";
        return false; 
        }
        
        //new name image
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensigambar;
        //valid image
        move_uploaded_file($tmpName, 'image/' . $namaFileBaru);

        return $namaFileBaru;
    }

    function editproduk($data){
        global $conn;
    
        $id_produk = $data["id_produk"];
        $fotoLama = htmlspecialchars($data["fotoLama"]);
        $nama_produk = htmlspecialchars($data["nama_produk"]);
        $harga_produk = htmlspecialchars($data["harga_produk"]);
        $harga_produk_clean = str_replace(['Rp. ', '.'], '', $harga_produk);
        $ukuran_produk = htmlspecialchars($data["ukuran_produk"]);
        $jenis_produk = htmlspecialchars($data["jenis_produk"]);
        $kategori_produk = htmlspecialchars($data["kategori_produk"]);
        $stok_produk = htmlspecialchars($data["stok_produk"]);
        $desc_produk = htmlspecialchars($data["desc_produk"]);

        //cek new image
        if($_FILES['foto_produk']['error'] === 4){
            $foto_produk = $fotoLama;
        }else {
            $result = mysqli_query($conn, "SELECT foto_produk FROM produk WHERE id_produk = $id_produk");
            $file = mysqli_fetch_assoc($result);

            $filenama = implode('.', $file);
            unlink('image/'.$filenama);

            $foto_produk = uploadproduk();

            
        }
    
        
        $query = "UPDATE produk SET
                  foto_produk = '$foto_produk',
                  nama_produk = '$nama_produk',
                  harga_produk = '$harga_produk_clean',
                  ukuran_produk = '$ukuran_produk',
                  id_jenis = '$jenis_produk',
                  id_kategori = '$kategori_produk',
                  stok_produk = '$stok_produk',
                  desc_produk = '$desc_produk'
            WHERE id_produk = '$id_produk'
                 ";
        mysqli_query($conn, $query);
    
        return mysqli_affected_rows($conn);
    }

    function hapusproduk($id_produk) {
        global $conn;
        
        $result = mysqli_query($conn, "SELECT foto_produk FROM produk WHERE id_produk = $id_produk");
        $file = mysqli_fetch_assoc($result);

        //delete from file
        $filenama = implode('.', $file);
        $location = "image/$filenama";
        if(file_exists($location)){
            unlink('image/'.$filenama);
        }

        mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id_produk");
        return mysqli_affected_rows($conn);
    }

?>