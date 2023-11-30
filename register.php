<?php
require 'function.php';
    if( isset($_POST["regis"])) {

        if( regis($_POST) > 0 ) {
          echo "<script>
                alert('Akun Berhasil Dibuat, Silahkan Login Kembali');
                document.location.href = 'login.php';
                </script>";
    
        }else{
          echo mysqli_error($conn);
        }
        }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6f0d2c27b1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script> 
    <title>Register | User</title>
</head>
<body class="bg-white h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-md  w-2/5">
        <img src="image/logo type b.png" width="50%" class="mx-auto my-7">
        <p class="text-md mb-5 font-semibold w-3/5 mx-auto text-center">Silahkan Daftar</p>
        <form action="" method="post">
            <label class="text-sm">Username</label>
            <div class="mb-2">
                <input type="text" id="nama" name="nama" placeholder="Username..."
                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black italic">
            </div>
            <div class="flex">
                <div class="container pr-2">
                    <label class="text-sm">Email</label>
                    <div class="mb-2">
                        <input type="email" id="email" name="email" placeholder="Email..."
                            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black italic">
                    </div>
                </div>
                <div class="container pl-2">
                    <label class="text-sm">No.Telphone</label>
                    <div class="mb-2">
                    <input type="text" id="phone" name="phone" placeholder="No. Telephone..." class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black placeholder-gray-500 italic">
                    </div>
                </div>
            </div>
            <label class="text-sm">Password</label>
            <div class="mb-2">
                <input type="password" id="password" name="password" placeholder="Password..."
                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:border-black italic">
            </div>
            <label class="text-sm">Confirm Password</label>
            <div class="mb-2">
                <input type="password" id="password2" name="password2" placeholder="Confirm Password..."
                    class="w-full border rounded px-3 py-2 mb-3 text-sm focus:outline-none focus:border-black italic">
            </div>
            <button type="submit" name="regis"
                class="bg-black text-white w-full border  px-3 py-2 mb-6 rounded float-right hover:bg-gray-600 transition duration-300 ease-in-out">Daftar</button>
            <p class="text-xs text-center my-5">Sudah memiliki akun? <a href="login.php"><span
                        class="font-bold">Login.</span></a> </p>
        </form>
    </div>
</body>
</html>