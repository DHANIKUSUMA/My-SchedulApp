<?php
    session_start();
    // 1. Logika untuk ganti gender via Tombol (URL Parameter)
    if(isset($_GET['set_gender'])){
        $_SESSION['gender'] = $_GET['set_gender'];
        header("Location: index.php"); // Reload halaman
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $_SESSION['nama'] = $_POST['nama'];
        $_SESSION['nim'] = $_POST['nim'];
        $_SESSION['universitas'] = $_POST['universitas'];
        $_SESSION['semester'] = $_POST['semester'];
        
        $_SESSION['gender'] = $_POST['gender_hidden'];
        
        header("location: pageOne.php");
        exit;   
    }
    
    $current_gender = $_SESSION['gender'] ?? 'cewe';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello! ✨</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Quicksand', sans-serif; }
        .bubble { position: absolute; border-radius: 50%; filter: blur(40px); z-index: -1; }
    </style>
</head>
<body class="bg-[#FFF5F7] min-h-screen relative transition-colors duration-500">
    
    <div class="bubble bg-pink-200 w-64 h-64 -top-10 -left-10 opacity-60 transition-colors duration-500"></div>
    <div class="bubble bg-yellow-100 w-80 h-80 -bottom-20 -right-10 opacity-70 transition-colors duration-500"></div>

    <div class="flex flex-col justify-center items-center min-h-screen p-6">
        
        <div class="bg-white/80 backdrop-blur-md p-8 rounded-[40px] shadow-[0_20px_50px_rgba(255,182,193,0.3)] border-4 border-white w-full max-w-md transform transition-all hover:scale-[1.01]">
            
            <div class="text-center mb-8">
                <div class="inline-block bg-pink-100 text-pink-500 p-4 rounded-full mb-4 animate-bounce transition-colors duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-pink-600 transition-colors duration-500">Halo, Teman! ✨</h1>
                <p class="text-pink-400 text-sm transition-colors duration-500">Kenalan dulu yuk, isi data dirimu ya~</p>
            </div>
            <div class="bubble bg-pink-200 w-64 h-64 -top-10 -left-10 opacity-60"></div>
            <div class="bubble bg-yellow-100 w-80 h-80 -bottom-20 -right-10 opacity-70"></div>

            <div class="flex flex-col justify-center items-center p-4">
                <div class="flex gap-4 mb-6 bg-white/50 p-2 rounded-full border-2 border-white shadow-sm">
                    <a href="?set_gender=cewe" class="px-6 py-2 rounded-full text-xs font-bold transition-all <?= $current_gender == 'cewe' ? 'bg-pink-400 text-white shadow-md' : 'text-pink-400 hover:bg-pink-50' ?>">
                        PINK 🌸
                    </a>
                    <a href="?set_gender=cowo" class="px-6 py-2 rounded-full text-xs font-bold transition-all <?= $current_gender == 'cowo' ? 'bg-blue-400 text-white shadow-md' : 'text-blue-400 hover:bg-blue-50' ?>">
                        BIRU 💎
                    </a>
                </div>
            

            <form method="POST" class="space-y-4">
                <input type="hidden" name="gender_hidden" value="<?= $current_gender ?>">

                <div class="space-y-1">
                    <label class="text-xs font-bold text-pink-400 ml-4 uppercase transition-colors duration-500">Nama Lengkap</label>
                    <input type="text" required name="nama" value="<?= $_SESSION['nama'] ?? '' ?>" placeholder="Syaiful Konan" 
                        class="w-full px-6 py-3 bg-pink-50/50 border-2 border-pink-100 rounded-full focus:ring-4 focus:ring-pink-200 focus:border-pink-300 outline-none transition-all placeholder:text-pink-200 text-pink-700">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-pink-400 ml-4 uppercase transition-colors duration-500">NIM</label>
                    <input type="text" required name="nim" value="<?= $_SESSION['nim'] ?? '' ?>" placeholder="2390110001" 
                        class="w-full px-6 py-3 bg-pink-50/50 border-2 border-pink-100 rounded-full focus:ring-4 focus:ring-pink-200 focus:border-pink-300 outline-none transition-all placeholder:text-pink-200 text-pink-700">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-pink-400 ml-4 uppercase transition-colors duration-500">Universitas</label>
                    <input type="text" required name="universitas" value="<?= $_SESSION['universitas'] ?? '' ?>" placeholder="ITB Bangkalan" 
                        class="w-full px-6 py-3 bg-pink-50/50 border-2 border-pink-100 rounded-full focus:ring-4 focus:ring-pink-200 focus:border-pink-300 outline-none transition-all placeholder:text-pink-200 text-pink-700">
                </div>

                <div class="grid grid-cols-1 gap-1">
                    <label class="text-xs font-bold text-pink-400 ml-4 uppercase transition-colors duration-500">Semester</label>
                    <input type="number" required name="semester" value="<?= $_SESSION['semester'] ?? '' ?>" placeholder="2" 
                        class="w-full px-6 py-3 bg-pink-50/50 border-2 border-pink-100 rounded-full focus:ring-4 focus:ring-pink-200 focus:border-pink-300 outline-none transition-all placeholder:text-pink-200 text-pink-700">
                </div>

                <button type="submit" class="w-full mt-4 bg-gradient-to-r from-pink-400 to-rose-400 hover:from-pink-500 hover:to-rose-500 text-white font-bold py-4 rounded-full shadow-lg shadow-pink-200 transition-all transform active:scale-95 cursor-pointer">
                    Simpan & Lanjut 🐾
                </button>
            </form>
        </div>

        <p class="mt-8 text-pink-300 text-sm font-medium italic transition-colors duration-500 justify-center items-center flex">Buatan Gue 💖 for your schedule</p>
    </div>

    <script>
    // Membaca data gender yang sudah disimpan PHP di Session
    const gender = "<?php echo $_SESSION['gender'] ?? 'cewe'; ?>";

    if (gender === 'cowo') {
        // 1. Ubah warna Background utama & teks utama
        document.body.classList.replace('bg-[#FFF5F7]', 'bg-[#F0F7FF]');
        document.body.classList.replace('text-pink-700', 'text-blue-700');

        // 2. Cari semua elemen yang punya class pink atau rose dan ganti ke biru/indigo
        const elements = document.querySelectorAll('[class*="pink"], [class*="rose"]');
        
        elements.forEach(el => {
            el.classList.forEach(className => {
                if (className.includes('pink')) {
                    const blueClass = className.replace('pink', 'blue');
                    el.classList.replace(className, blueClass);
                }
                if (className.includes('rose')) {
                    const indigoClass = className.replace('rose', 'indigo');
                    el.classList.replace(className, indigoClass);
                }
            });
        });

        // 3. Ubah warna hiasan bubble background
        const bubbles = document.querySelectorAll('.bubble');
        if(bubbles.length > 0) {
            bubbles[0].classList.replace('bg-pink-200', 'bg-blue-200');
            bubbles[1].classList.replace('bg-yellow-100', 'bg-cyan-100');
        }
    }
    </script>

</body>
</html>