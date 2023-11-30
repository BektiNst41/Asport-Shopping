    <?php
    require '../../koneksi.php';
    ?>
    
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/6f0d2c27b1.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="../../font.css">

    </head>

    <body>
    <div class="flex">
    <!-- Sidebar -->
    <div class="bg-white text-black w-60 h-screen fixed">
        <!-- Logo atau Nama Situs -->
        <div class="text-2xl ml-10 font-bold mb-10 mt-28">Our Shoes</div>

        <!-- Menu Sidebar -->
        <ul class="">
        <?php
        $tampil = "SELECT * FROM kategori ORDER BY id_kategori DESC";
        $result= mysqli_query($conn, $tampil);

        while ($row = mysqli_fetch_assoc ($result)) {
        ?>
            <a href="index.html" class=" font-semibold">
            <li class=" pl-10 py-3 hover:text-xl hover:py-6 hover:bg-black hover:text-white transition-all duration-150">
                <button>
                    <?php echo $row["nama_kategori"] ?>
                </button>
            </li></a>
            <?php
            }
            ?>
        </ul>

        
    </div>
    </body>
    </html>