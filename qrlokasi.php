<?php
// Memastikan error reporting diaktifkan untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Menyertakan file QR Code
include 'phpqrcode/qrlib.php'; // Pastikan path ini sesuai dengan lokasi QRcode.php Anda

// URL Google Maps yang ingin dijadikan QR Code
$url = 'https://maps.app.goo.gl/KvyPGFrR8TALckKk8'; // Ganti dengan URL Google Maps Anda

// Menentukan lokasi penyimpanan QR Code    
$filePath = 'assets/img/qr_code_maps.png';

// Membuat QR Code dan menyimpannya sebagai file
QRcode::png($url, $filePath, QR_ECLEVEL_L, 10);

// Menampilkan QR Code
header('Content-Type: image/png');
header('Content-Disposition: inline; filename="qr_code_maps.png"');
readfile($filePath);
?>