<?php 
$conn = mysqli_connect("localhost","root","","shopping");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = []; 
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambahpromosi($data){
    global $conn;

    $nama_promosi = $data["nama_promosi"];

    $gambar_promosi = uploadpromosi();
    if( !$gambar_promosi) {
        return false;
    }

    $queryaddpromosi = "INSERT INTO `promosi` VALUES ('', '$gambar_promosi', '$nama_promosi')";
    mysqli_query($conn, $queryaddpromosi);

    return mysqli_affected_rows($conn);
}

    function uploadpromosi() {
        $namaFile = $_FILES['gambar_promosi']['name'];
        $sizeFile = $_FILES['gambar_promosi']['size'];
        $error = $_FILES['gambar_promosi']['error'];
        $tmpName = $_FILES['gambar_promosi']['tmp_name'];

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
        if( $sizeFile > 10000000000){
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
        move_uploaded_file($tmpName, 'promosi/' . $namaFileBaru);

        return $namaFileBaru;
    }

    function hapuspromosi($id_promosi) {
        global $conn;
        
        $result = mysqli_query($conn, "SELECT gambar_promosi FROM promosi WHERE id_promosi = $id_promosi");
        $file = mysqli_fetch_assoc($result);

        //delete from file
        $filenama = implode('.', $file);
        $location = "promosi/$filenama";
        if(file_exists($location)){
            unlink('promosi/'.$filenama);
        }

        mysqli_query($conn, "DELETE FROM promosi WHERE id_promosi = $id_promosi");
        return mysqli_affected_rows($conn);
    }

    function editpromosi($data){
        global $conn;
        
        $id_promosi = $data["id_promosi"];
        $fotoLama = htmlspecialchars($data["fotoLama"]);
        $nama_promosi = htmlspecialchars($data["nama_promosi"]);


        //cek new image
        if($_FILES['gambar_promosi']['error'] === 4){
            $gambar_promosi = $fotoLama;
        }else {
            $edit = mysqli_query($conn, "SELECT gambar_promosi FROM promosi WHERE id_promosi = $id_promosi");
            $file = mysqli_fetch_assoc($edit);

            $filenama = implode('.', $file);
            unlink('promosi/'. $filenama);

            $gambar_promosi = uploadpromosi();
        }

        $query = "UPDATE promosi SET
        gambar_promosi = '$gambar_promosi',
        nama_promosi = '$nama_promosi'
        WHERE id_promosi = '$id_promosi' ";
        
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
?>