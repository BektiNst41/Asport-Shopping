<?php
    $conn = mysqli_connect("localhost","root","","shopping");

    function regis($data) {
    global $conn;

    $nama = strtolower(stripslashes($data["nama"]));
    $email = ($data["email"]);
    $phone = ($data["phone"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek pw
    if( $password !== $password2){
        echo "<script>
        alert('Password Berbeda');
        </script>";
        
        return false;
    }

    $password = password_hash($password, PASSWORD_BCRYPT);

    //check email
    $result = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email' ");
    if( mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Alamat Email Sudah Ada');
            </script>";

            
            return false;
    }

    /// add new account
    mysqli_query($conn, "INSERT INTO users VALUES('', '$nama', '$email', '$phone' ,'$password' ,'')");
    
    return mysqli_affected_rows($conn);

    header('location:login.php');


}

?>