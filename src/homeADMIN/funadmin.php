<?php
    $conn = mysqli_connect("localhost","root","","shopping");

    //LOGIN
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $cek = mysqli_query($conn, "SELECT * FROM users where email='$email' and password='$password'");
        $count = mysqli_num_rows($cek);

        if ($cek===1) {
            $_SESSION['userweb']=$email;
            
            header ("location: login.php");
            exit;
          }
          else {
            $error = true;
          }
        if($count> 0){
            $ambilrole = mysqli_fetch_array($cek);
            $role = $ambilrole['role'];
            $email = $ambilrole['email']; 


            if($role=='1'){
                $_SESSION['log'] = 'Logged';
                $_SESSION['role'] = '0';
                $_SESSION['userweb'] = '$email';

                header('location:src/homeADMIN/dashboard.php');
            }else{
                $_SESSION['log'] = 'Logged';
                $_SESSION['role'] = '0';
                $_SESSION['userweb'] = '$email';

                header('location:index.php');
            }
        }else{
            echo 'Data tdk ditemukan';
        }
    };
?>