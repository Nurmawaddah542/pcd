<?php
include "connect.php";

$id_transaksi = isset($_POST['id_transaksi']) ? htmlentities($_POST['id_transaksi']) : "";
$nama_nasabah = isset($_POST['nama_nasabah']) ? htmlentities($_POST['nama_nasabah']) : "";
$jabatan = isset($_POST['jabatan']) ? htmlentities($_POST['jabatan']) : "";
$tgl_transaksi = isset($_POST['tgl_transaksi']) ? htmlentities($_POST['tgl_transaksi']) : "";
$status = isset($_POST['status']) ? htmlentities($_POST['status']) : "";
$catatan = isset($_POST['catatan']) ? htmlentities($_POST['catatan']) : "";
$jumlah = isset($_POST['jumlah']) ? htmlentities($_POST['jumlah']) : "";

$message = "";

if (!empty($_POST['input_transaksi_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'"); 
    if (mysqli_num_rows($select) > 0) {
        echo('<script>alert("Data transaksi yang Anda masukkan telah ada"); 
        window.location="../transaksi"</script>');
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_transaksi (nama_nasabah, jabatan, tgl_transaksi, status, catatan, jumlah) 
        VALUES ('$nama_nasabah', '$jabatan', '$tgl_transaksi', '$status', '$catatan', '$jumlah')");
        if ($query) {
            echo ('<script>alert("Data transaksi berhasil dimasukkan"); 
            window.location="../transaksi"</script>');
        } else {
            echo ('<script>alert("Data gagal dimasukkan"); 
            window.location="../transaksi"</script>');
        }
    }
}

echo $message;
?>
