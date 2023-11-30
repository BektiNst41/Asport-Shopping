    <?php
    require '../../koneksi.php';

    session_start();
    if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'Logged' || $_SESSION['role'] !== '0') {
        header('location: ../../login.php');
        exit();
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $admin_email = $_SESSION['admin_email'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password === $confirm_password) {
            $query = "SELECT password FROM users WHERE email = '$admin_email'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $hashed_old_password = $row['password'];

                if (password_verify($old_password, $hashed_old_password)) {
                    $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);

                    $update_query = "UPDATE users SET password = '$hashed_new_password' WHERE email = '$admin_email'";
                    if (mysqli_query($conn, $update_query)) {
                        echo "<script>
                        alert('Akun Berhasil Di Edit, Silahkan Login Kembali');
                        document.location.href = '../../login.php';
                        </script>";
                    } else {
                        echo "Error updating password: " . mysqli_error($conn);
                    }
                } else {
                    echo  "<script>
                    alert('Password Lama Salah');
                    </script>";
                }
            } else {
                echo "Error fetching old password: " . mysqli_error($conn);
            }
        } else {
            echo "<script>
            alert('Password Lama Salah dan Password Baru Tidak Sesuai');
            </script>";;
        }
    }

    $email = $_SESSION['admin_email'];
    $query = "SELECT nama, email, phone, password FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $user_data = mysqli_fetch_assoc($result);
        $nama = $user_data['nama'];
        $email = $user_data['email'];
        $phone = $user_data['phone'];
        $password = $user_data['password'];

    } else {
        die("Error: " . mysqli_error($conn));
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_nama = $_POST['newNama'];
        $new_email = $_POST['newEmail'];
        $new_phone = $_POST['newPhone'];
    
        $update_user_query = "UPDATE users SET nama = '$new_nama', email = '$new_email', phone = '$new_phone' WHERE email = '$admin_email'";
        if (mysqli_query($conn, $update_user_query)) {
        
            echo "<script>
                alert('Informasi Akun Berhasil Diperbarui');
                // Ganti lokasi sesuai kebutuhan Anda
                document.location.href = 'profil.php';
                </script>";
        } else {
            echo "Error updating user information: " . mysqli_error($conn);
        }
    }
    
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Edit Account</title>

    <body>
        <div>
        <div class="bg-white flex justify-center mt-16">
        <div class="bg-white p-8 rounded-md w-2/5 border-2 border-black">
            <p class="text-md mb-10 font-semibold w-3/5 mx-auto text-2xl text-center">Update Profile</p>
            <form method="POST">
                <label class="text-sm mb-2" id="newNama">Username</label>
                <div class="mb-2">
                    <input type="text" id="nama" name="newNama" placeholder="Username" value="<?php echo ucwords($nama); ?>" 
                    class="w-full border rounded px-3 py-2 mb-3 text-sm focus:outline-none focus:border-black">
                </div>
                <label class="text-sm mb-2">Email</label>
                <div class="mb-2">
                <input type="email" id="nama" name="newEmail" placeholder="Email" value="<?php echo $email; ?>" 
                    class="w-full border rounded px-3 py-2 mb-3 text-sm focus:outline-none focus:border-black">
                </div>
                <label class="text-sm mb-2">No. Telephone</label>
                <div class="mb-2">
                <input type="text" id="nama" name="newPhone" placeholder="Nomor Telephone" value="<?php echo $phone; ?>" 
                    class="w-full border rounded px-3 py-2 mb-3 text-sm focus:outline-none focus:border-black">
                </div>
                
                <div class="mb-2">
                <label for="old_password" class="text-sm mb-2" >Old Password:</label>
                <input type="password" id="old_password" name="old_password" class="w-full border rounded px-3 py-2 mb-3 text-sm focus:outline-none focus:border-black"  required>

                <label for="new_password" class="text-sm mb-2">New Password:</label>
                <input type="password" id="new_password" name="new_password" class="w-full border rounded px-3 py-2 mb-3 text-sm focus:outline-none focus:border-black" required>

                <!-- Konfirmasi password baru -->
                <label for="confirm_password" class="text-sm mb-2">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="w-full border rounded px-3 py-2 mb-3 text-sm focus:outline-none focus:border-black" required>
                </div>
                <button type="submit" class="bg-black text-white text-center w-full px-3 py-2 mb-6 rounded hover:bg-yellow-400 hover:text-black hover:transition duration-300 ease-in-out">Simpan Perubahan</button>
            </form>
        </div>

        <!-- Skrip JavaScript untuk mengenkripsi password -->
    <script>
        function encryptPassword() {
            var passwordField = document.getElementById('password');
            var encryptedPassword = /* logika enkripsi Anda */;

            // Mengganti nilai input dengan password terenkripsi
            passwordField.value = encryptedPassword;
        }
    </script>

    </body>
    </html>
