<?php
session_start();
include "connect.php";

$id_kelas = (isset($_POST['id_kelas'])) ? htmlentities($_POST['id_kelas']) : "";
$nama_kelas = (isset($_POST['nama_kelas'])) ? htmlentities($_POST['nama_kelas']) : "";
$tingkat = (isset($_POST['tingkat'])) ? htmlentities($_POST['tingkat']) : "";
$kapasitas = (isset($_POST['kapasitas'])) ? htmlentities($_POST['kapasitas']) : "";
$wali_kelas = (isset($_POST['wali_kelas'])) ? htmlentities($_POST['wali_kelas']) : "";

if (!empty($_POST['edit_kelas_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_kelas SET nama_kelas='$nama_kelas', tingkat='$tingkat', kapasitas='$kapasitas', wali_kelas='$wali_kelas'
        WHERE id_kelas = '$id_kelas'");
    
    if ($query) {
        $message = '<script>alert("Data berhasil dimasukkan");
                    window.location="../kelas"</script>';
    } else {
        $message = '<script>alert("Data gagal dimasukkan")
                    window.location="../kelas"</script>';
    }
}

echo $message;
?>
