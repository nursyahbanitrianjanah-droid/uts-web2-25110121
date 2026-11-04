<?php
$pesan_sukses = "";
$error_nama = "";
$error_harga = "";
$error_jumlah = "";
$nama_produk = "";
$harga = "";
$jumlah = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = trim($_POST['nama_produk'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $jumlah = trim($_POST['jumlah'] ?? '');
    $isValid = true;

    // Validasi Nama Produk
    if (empty($nama_produk)) {
        $error_nama = "Nama produk wajib diisi.";
        $isValid = false;
    }

    // Validasi Harga
    if (empty($harga) || !is_numeric($harga) || floatval($harga) <= 0) {
        $error_harga = "Harga harus berupa angka lebih dari 0.";
        $isValid = false;
    }

    // Validasi Jumlah Pesanan
    if (empty($jumlah) || !is_numeric($jumlah) || intval($jumlah) <= 0) {
        $error_jumlah = "Jumlah pesanan harus berupa angka minimal 1.";
        $isValid = false;
    }

    // Jika valid
    if ($isValid) {
        $aman_nama = htmlspecialchars($nama_produk, ENT_QUOTES, 'UTF-8');
        $aman_jumlah = htmlspecialchars($jumlah, ENT_QUOTES, 'UTF-8');
        $pesan_sukses = "Produk <strong>{$aman_nama}</strong> sebanyak <strong>{$aman_jumlah}</strong> berhasil ditambahkan!";
        
        // Kosongkan form setelah sukses
        $nama_produk = "";
        $harga = "";
        $jumlah = "";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Tambah Produk Kedai Kopi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }
        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }
        h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
        }
        .error {
            color: #e74c3c;
            font-size: 0.85em;
            margin-top: 5px;
            display: block;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #c3e6cb;
            margin-bottom: 20px;
            font-size: 14px;
        }
        button[type="submit"] {
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 12px 20px;
            width: 100%;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #357abd;
        }
        /* Style untuk Tombol Navigasi Tambahan */
        .nav-buttons {
            margin-top: 20px;
            text-align: center;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        .btn-link {
            display: inline-block;
            background-color: #2ecc71;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        .btn-link:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Tambah Produk</h2>

    <?php if (!empty($pesan_sukses)): ?>
        <div class="success"><?php echo $pesan_sukses; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" id="nama_produk" name="nama_produk" value="<?php echo htmlspecialchars($nama_produk); ?>" placeholder="Contoh: Kopi Susu">
            <?php if (!empty($error_nama)): ?>
                <span class="error"><?php echo $error_nama; ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="harga">Harga (Rp):</label>
            <input type="text" id="harga" name="harga" value="<?php echo htmlspecialchars($harga); ?>" placeholder="Contoh: 18000">
            <?php if (!empty($error_harga)): ?>
                <span class="error"><?php echo $error_harga; ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah Pesanan:</label>
            <input type="number" id="jumlah" name="jumlah" value="<?php echo htmlspecialchars($jumlah); ?>" min="1" placeholder="Masukkan jumlah pesanan">
            <?php if (!empty($error_jumlah)): ?>
                <span class="error"><?php echo $error_jumlah; ?></span>
            <?php endif; ?>
        </div>

        <button type="submit">Simpan Pesanan</button>
    </form>

    <!-- Tombol navigasi untuk melihat halaman Struk Belanja -->
    <div class="nav-buttons">
        <a href="struk.php" class="btn-link">Lihat Struk Belanja (Bagian A)</a>
    </div>
</div>

</body>
</html>