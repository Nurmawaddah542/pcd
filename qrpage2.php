<?php
// Include the QR code library
include 'phpqrcode/qrlib.php'; // Sesuaikan path sesuai lokasi library

// URL untuk form input transaksi
$transactionFormUrl = "https://2b68-180-241-47-58.ngrok-free.app/ni_khusus_pcd/TabungKu/input_form.php"; // Ganti dengan URL form yang sebenarnya

// Path dan nama file QR code yang akan disimpan
$qrcodeFile = './qrcode2.png';

// Generate QR code dan simpan ke file
QRcode::png($transactionFormUrl, $qrcodeFile, QR_ECLEVEL_L, 4);

// Menampilkan QR code di halaman
echo '<h1>Scan this QR code to access the transaction input form:</h1>';
echo '<img src="' . $qrcodeFile . '" alt="QR Code" />';
?>