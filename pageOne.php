<?php
    session_start();

    if(!isset($_SESSION['list_jadwal'])){
        $_SESSION['list_jadwal'] = [];    
    }

    if(isset($_GET['hapus'])){
        $key = $_GET['hapus'];
        unset($_SESSION['list_jadwal'][$key]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $hari = $_POST['hari']??'';

        $_SESSION['list_jadwal'][$hari] = [
            "jam1" => $_POST['jam1'] ?? '', 
            "mk1"  => $_POST['mk1'] ?? '',
            "ruang1" => $_POST['ruang1'] ?? '',
            "jam2" => $_POST['jam2'] ?? '', 
            "mk2"  => $_POST['mk2'] ?? '',
            "ruang2" => $_POST['ruang2'] ?? '',
            "jam3" => $_POST['jam3'] ?? '',
            "mk3"  => $_POST['mk3'] ?? '',
            "ruang3" => $_POST['ruang3'] ?? '',
        ];

        $_SESSION['pesan'] = "Data jadwal hari $hari berhasil disimpan!";
        header("location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Menggunakan null coalescing agar tidak error jika session belum ada
    $nama = $_SESSION['nama'] ?? 'Teman';
    $nim = $_SESSION['nim'] ?? '-';
    $universitas = $_SESSION['universitas'] ?? 'Universitas';
    $semester = $_SESSION['semester'] ?? '-';  
    $gender = $_SESSION['gender'] ?? 'cewe';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kuliah ✨</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        body { font-family: 'Quicksand', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { height: 8px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #fff5f7; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #fbcfe8; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#FFF5F7] min-h-screen p-4 md:p-8 text-pink-700">

    <div class="max-w-6xl mx-auto space-y-8">
        
        <div class="bg-white/70 backdrop-blur-md p-6 rounded-[30px] border-4 border-white shadow-lg flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h3 class="text-xl font-bold">Halo, <span class="text-pink-500"><?= $nama ?></span>! 👋</h3>
                <p class="text-sm text-pink-400 font-medium italic">Nim: <?= $nim ?></p>
            </div>
            <div class="text-center md:text-right">
                <span class="bg-pink-100 text-pink-600 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider">
                    <?= $universitas ?>
                </span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[35px] shadow-xl border-2 border-pink-50">
            <div class="flex items-center gap-2 mb-4">
                <span class="text-2xl">📅</span>
                <p class="font-bold text-pink-500 uppercase text-sm tracking-widest">Input Jadwal Baru</p>
            </div>
            
            <form method="POST">
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-sm border-separate border-spacing-2">
                        <thead>
                            <tr class="text-pink-400">
                                <th class="pb-2">Hari</th>
                                <th class="pb-2">Jam 1</th><th class="pb-2">Matkul 1</th><th class="pb-2">Ruang</th>
                                <th class="pb-2">Jam 2</th><th class="pb-2">Matkul 2</th><th class="pb-2">Ruang</th>
                                <th class="pb-2">Jam 3</th><th class="pb-2">Matkul 3</th><th class="pb-2">Ruang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="hari" required class="w-full p-2 bg-pink-50 border-2 border-pink-100 rounded-xl focus:ring-2 focus:ring-pink-300 outline-none"> 
                                        <option value="">-- Pilih --</option>
                                        <option value="senin">Senin</option>
                                        <option value="selasa">Selasa</option>
                                        <option value="rabu">Rabu</option>
                                        <option value="kamis">Kamis</option>
                                        <option value="jumat">Jumat</option>
                                    </select>
                                </td>
                                <td><input type="text" name="jam1" placeholder="08:00" required class="w-20 p-2 bg-pink-50 border-2 border-pink-100 rounded-xl outline-none focus:ring-2 focus:ring-pink-200"></td>
                                <td><input type="text" name="mk1" placeholder="Matkul" required class="w-32 p-2 bg-pink-50 border-2 border-pink-100 rounded-xl outline-none"></td>
                                <td><input type="text" name="ruang1" placeholder="R1" required class="w-20 p-2 bg-pink-50 border-2 border-pink-100 rounded-xl outline-none"></td>
                                
                                <td><input type="text" name="jam2" placeholder="10:00" class="w-20 p-2 bg-pink-50 border-2 border-pink-100 rounded-xl outline-none"></td>
                                <td><input type="text" name="mk2" placeholder="Matkul" class="w-32 p-2 bg-pink-50 border-2 border-pink-100 rounded-xl outline-none"></td>
                                <td><input type="text" name="ruang2" placeholder="R2" class="w-20 p-2 bg-pink-50 border-2 border-pink-100 rounded-xl outline-none"></td>
                                
                                <td><input type="text" name="jam3" placeholder="13:00" class="w-20 p-2 bg-pink-50 border-2 border-pink-100 rounded-xl outline-none"></td>
                                <td><input type="text" name="mk3" placeholder="Matkul" class="w-32 p-2 bg-pink-50 border-2 border-pink-100 rounded-xl outline-none"></td>
                                <td><input type="text" name="ruang3" placeholder="R3" class="w-20 p-2 bg-pink-50 border-2 border-pink-100 rounded-xl outline-none"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6 flex flex-wrap gap-4 items-center justify-between">
                    <button type="submit" class="bg-gradient-to-r from-pink-400 to-rose-400 hover:from-pink-500 hover:to-rose-500 text-white font-bold py-3 px-8 rounded-full shadow-lg shadow-pink-200 transition-all active:scale-95 cursor-pointer">
                        Save Jadwal 🐾
                    </button>
                </div>

                <?php if(isset($_SESSION['pesan'])): ?>
                    <script>alert ("<?= $_SESSION['pesan'];?>")</script>
                    <?php unset($_SESSION['pesan']);?>
                <?php endif; ?>
            </form>
        </div>

        <hr class="border-2 border-pink-100 border-dashed">

        <div class="space-y-4" id="area-cetak">
            <div class="text-center">
                <h1 class="text-2xl font-extrabold text-pink-600">Jadwal Kuliah Semester <?= $semester ?></h1>
                <h2 class="text-pink-400 font-medium"><?= $universitas ?></h2>
            </div>

            <div class="bg-white p-4 rounded-[40px] shadow-2xl overflow-hidden border-4 border-white">
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-separate border-spacing-y-2">
                        <thead>
                            <tr class="bg-pink-400 text-white">
                                <th class="p-4 rounded-l-2xl">Hari</th>
                                <th class="p-4">Jam 1 & Ruang</th>
                                <th class="p-4">Jam 2 & Ruang</th>
                                <th class="p-4">Jam 3 & Ruang</th>
                                <th class="p-4 rounded-r-2xl text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <?php if(empty($_SESSION['list_jadwal'])): ?>
                                <tr><td colspan="5" class="p-8 text-center text-pink-300 italic">Duh, jadwalnya masih kosong nih... 🌸</td></tr>
                            <?php else: ?>
                                <?php
                                $urutan_hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat'];
                                foreach ($urutan_hari as $h):
                                    if(isset($_SESSION['list_jadwal'][$h])):
                                        $baris = $_SESSION['list_jadwal'][$h];
                                ?>
                                    <tr class="bg-pink-50/50 hover:bg-pink-100/50 transition-colors">
                                        <td class="p-4 font-bold capitalize text-pink-600 border-l-4 border-pink-300"><?= $h ?></td>
                                        <td class="p-4">
                                            <div class="font-bold"><?= htmlspecialchars($baris['mk1']) ?></div>
                                            <div class="text-xs text-pink-400"><?= htmlspecialchars($baris['jam1']) ?> | Lt.<?= htmlspecialchars($baris['ruang1']) ?></div>
                                        </td>
                                        <td class="p-4">
                                            <div class="font-bold"><?= htmlspecialchars($baris['mk2']) ?></div>
                                            <div class="text-xs text-pink-400"><?= htmlspecialchars($baris['jam2']) ?> | Lt.<?= htmlspecialchars($baris['ruang2']) ?></div>
                                        </td>
                                        <td class="p-4">
                                            <div class="font-bold"><?= htmlspecialchars($baris['mk3']) ?></div>
                                            <div class="text-xs text-pink-400"><?= htmlspecialchars($baris['jam3']) ?> | Lt.<?= htmlspecialchars($baris['ruang3']) ?></div>
                                        </td>
                                        <td class="p-4 text-center">
                                            <a href="?hapus=<?= $h ?>" onclick="return confirm('Hapus hari <?= $h ?>?')" class="bg-white p-2 rounded-full shadow-sm border border-pink-100 inline-block hover:scale-110 transition-transform">
                                                ❌
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="flex justify-center pb-8">
            <a href="index.php" class="text-pink-400 font-bold hover:text-pink-600 transition-colors">
                ← Kembali ke Profil
            </a>
        </div>
        
    </div>

    <script>
    const gender = "<?= $gender ?>";

        if (gender === 'cowo') {
            document.body.classList.replace('bg-[#FFF5F7]', 'bg-[#F0F7FF]');
            document.body.classList.replace('text-pink-700', 'text-blue-700');

            const elements = document.querySelectorAll('[class*="pink"], [class*="rose"]');
            elements.forEach(el => {
                el.classList.forEach(className => {
                    if (className.includes('pink')) el.classList.replace(className, className.replace('pink', 'blue'));
                    if (className.includes('rose')) el.classList.replace(className, className.replace('rose', 'indigo'));
                });
            });

            const bubbles = document.querySelectorAll('.bubble');
            bubbles[0].classList.replace('bg-pink-200', 'bg-blue-200');
            bubbles[1].classList.replace('bg-yellow-100', 'bg-cyan-100');
        }
    </script>
</body>
</html>