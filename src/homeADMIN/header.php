<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6f0d2c27b1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">  
    <script src="https://cdn.tailwindcss.com"></script> 
    <link rel="stylesheet" href="../../font.css">
</head>

<body>
    <nav class="bg-white py-4 shadow-md fixed w-full z-10">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-black text-lg font-semibold ml-56">Halaman Admin
            <div class="relative group">
                <button id="menu-button" class="text-black hover:text-gray-500 hover:scale-90 transition-all duration-150 ease-in-out focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 ">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
                <div id="dropdown-menu"
                    class="hidden origin-top-right absolute right-0 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                    role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">
                    <div class="" role="none">
                        <a href="" class="z-50 block px-4 py-2 text-sm text-black font-bold"
                            role="menuitem"><h5>Nama Admin : <?= ucwords($admin_name); ?></h5>
                        </a>
                        <a href="outadmin.php" class="z-50 block px-4 py-2 text-sm text-gray-700 hover:text-red-500"
                            role="menuitem">Log Out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <script>
    // JavaScript untuk menampilkan dan menyembunyikan dropdown saat tombol "Menu" diklik
    const menuButton = document.getElementById('menu-button');
    const dropdownMenu = document.getElementById('dropdown-menu');

    menuButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    // Tutup dropdown saat pengguna mengklik di luar dropdown
    document.addEventListener('click', (event) => {
        if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
    </script>
</body>

</html>