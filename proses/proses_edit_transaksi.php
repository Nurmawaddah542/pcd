<?php
include "connect.php";

$id_transaksi = isset($_POST['edit_transaksi']) ? htmlentities($_POST['edit_transaksi']) : "";
$nama_nasabah = isset($_POST['nama_nasabah']) ? htmlentities($_POST['nama_nasabah']) : "";
$jabatan = isset($_POST['jabatan']) ? htmlentities($_POST['jabatan']) : "";
$tgl_transaksi = isset($_POST['tgl_transaksi']) ? htmlentities($_POST['tgl_transaksi']) : "";
$status = isset($_POST['status']) ? htmlentities($_POST['status']) : "";
$catatan = isset($_POST['catatan']) ? htmlentities($_POST['catatan']) : "";
$jumlah = isset($_POST['jumlah']) ? htmlentities($_POST['jumlah']) : "";

if (!empty($_POST['edit_transaksi_validate'])) {
    $check_existing = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'");
    if (mysqli_num_rows($check_existing) > 0) {
        $query = mysqli_query($conn, "UPDATE tb_transaksi SET nama_nasabah='$nama_nasabah', jabatan='$jabatan', tgl_transaksi='$tgl_transaksi',
            status='$status', catatan='$catatan', jumlah='$jumlah'
            WHERE id_transaksi='$id_transaksi'");
            
        if ($query) {
            echo '<script>alert("Data transaksi berhasil diubah"); window.location="../transaksi"</script>';
        } else {
            echo '<script>alert("Data gagal diubah"); window.location="../transaksi"</script>';
        }
    } else {
        echo '<script>alert("ID transaksi tidak ditemukan"); window.location="../transaksi"</script>';
    }
}
?>
