<?php
// Tugas 1: Menyimpan data keranjang dalam array multidimensi
$keranjang = [
    ["nama" => "Kopi Susu", "harga" => 18000, "jumlah" => 2],
    ["nama" => "Teh Manis", "harga" => 8000, "jumlah" => 3],
    ["nama" => "Roti Bakar", "harga" => 15000, "jumlah" => 1],
    ["nama" => "('x')", "harga" => 11000, "jumlah" => 4]
];

// Tugas 2: Membuat fungsi hitungSubtotal dan formatRupiah
function hitungSubtotal(int $harga, int $jumlah): int {
    return $harga * $jumlah;
}

function formatRupiah(int $angka): string {
    return "Rp " . number_format($angka, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Kasir Kedai Kopi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

    <h2>Struk Belanja Kedai Kopi</h2>

    <!-- Tugas 3: Menggunakan foreach untuk menampilkan tabel HTML -->
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total_belanja = 0;
            foreach ($keranjang as $item): 
                $subtotal = hitungSubtotal($item['harga'], $item['jumlah']);
                $total_belanja += $subtotal;
            ?>
            <tr>
                <td><?= $item['nama']; ?></td>
                <td><?= formatRupiah($item['harga']); ?></td>
                <td><?= $item['jumlah']; ?></td>
                <td><?= formatRupiah($subtotal); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Tugas 4: Menghitung diskon 10% jika total >= Rp 50.000 dan tanggal -->
    <?php
    $diskon = 0;
    if ($total_belanja >= 50000) {
        $diskon = $total_belanja * 0.10;
    }
    $total_bayar = $total_belanja - $diskon;
    ?>

    <p><strong>Total belanja:</strong> <?= formatRupiah($total_belanja); ?></p>
    <?php if ($diskon > 0): ?>
        <p><strong>Diskon 10%:</strong> <?= formatRupiah($diskon); ?></p>
    <?php endif; ?>
    <p><strong>Total bayar:</strong> <?= formatRupiah($total_bayar); ?></p>
    <p><strong>Tanggal:</strong> <?= date('d-m-Y'); ?></p>

</body>
</html>