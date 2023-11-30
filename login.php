<?php
    include "function.php";
    session_start();
    if (isset($_COOKIE['remembered_role'])) {
        $_SESSION['role'] = $_COOKIE['remembered_role'];
        // Lakukan pengecekan lain atau arahkan pengguna ke halaman yang sesuai sesuai dengan $_SESSION['role']
    }
?>

</head><!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body class="bg-white h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-md  w-2/5">
        <img src="image/logo type b.png" width="50%" class="mx-auto my-7">
        <p class="text-md mb-5 font-semibold w-3/5 mx-auto text-center">Silakan Login</p>
        
        <form method="post">
        <?php
        if(isset($_POST['login'])) {
        $id_users = $_POST['id_users'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];
            
            if(password_verify($password, $hashed_password)) {
                $_SESSION['admin_email'] = $email;
                $role = $row['role'];

                if ($role == '1') {
                    $_SESSION['log'] = 'Logged';
                    $_SESSION['role'] = '1';

                    $query = "SELECT nama FROM users WHERE email='$email'";
                    $result = mysqli_query($conn, $query);
                    $admin_data = mysqli_fetch_assoc($result);
                    $admin_name = $admin_data['nama'];

                    $_SESSION['admin_name'] = $admin_name;

                    header('location:src/homeADMIN/dashboard.php');
                } else {
                    $_SESSION['log'] = 'Logged';
                    $_SESSION['role'] = '0';

                    if (isset($_POST['remember'])) {
                        // Jika checkbox "Remember me" terceklis, simpan $_SESSION['role'] dalam cookie
                        setcookie('remembered_role', $_SESSION['role'], time() + (86400 * 30), "/"); // Cookie berlaku selama 30 hari (30 * 24 * 60 * 60 detik)
                    }
            

                    $query = "SELECT id_users FROM users WHERE email='$email'";
                    $result = mysqli_query($conn, $query);
                    $admin_data = mysqli_fetch_assoc($result);
                    $id_users = $admin_data['id_users'];

                    $_SESSION['id_users'] = $id_users;

                    header('location:index.php');
                }
            } else {
                echo "<script>
                        alert('Password Salah');
                    </script>";
            }
        } else {
            echo "<script>
                    alert('Akun Tidak Valid');
                </script>";
        }
    };
?>
            <input type="hidden" name="id_users">
            <label class="text-sm">Email</label>
            <div class="mb-3">
                <input type="email" id="email" name="email" placeholder="Email..." class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black italic">
            </div>
            <label class="text-sm">Password</label>
            <div class="">
                <input type="password" id="password" name="password" placeholder="Password..." class="w-full border rounded px-3 py-2 text-sm mb-3 focus:outline-none focus:border-black italic">
            </div>
            <div>
            <input type="checkbox" value="lsRememberMe" id="rememberMe" name="remember" class="mb-3">
            <label for="rememberMe" class="text-sm">Remember me</label>
            </div>
            <button type="submit" name="login" class="bg-black text-white w-full border  px-3 py-2 mb-6 rounded float-right hover:bg-gray-600 hover:transition duration-300 ease-in-out">Login</button>
            <p class="text-xs text-center my-5">Belum memiliki akun? <a href="register.php"><span class="font-bold">Daftar.</span></a> </p>
        </form>
    </div>
</body>
</html>

</body>
</html>