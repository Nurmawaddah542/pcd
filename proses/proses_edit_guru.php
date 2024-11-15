<?php
session_start();
include "connect.php";

$id_guru = (isset($_POST['id_guru'])) ? htmlentities($_POST['id_guru']) : "";
$kode_guru = (isset($_POST['kode_guru'])) ? htmlentities($_POST['kode_guru']) : "";
$nama_guru = (isset($_POST['nama_guru'])) ? htmlentities($_POST['nama_guru']) : "";
$jen_kel = (isset($_POST['jen_kel'])) ? htmlentities($_POST['jen_kel']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";

if (!empty($_POST['edit_guru_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_guru SET nama_guru='$nama_guru', kode_guru='$kode_guru', jen_kel='$jen_kel', alamat='$alamat', nohp='$nohp'
        WHERE id_guru = '$id_guru'");
    
    if ($query) {
        $message = '<script>alert("Data berhasil dimasukkan");
                    window.location="../guru"</script>';
    } else {
        $message = '<script>alert("Data gagal dimasukkan")
                    window.location="../guru"</script>';
    }
}

echo $message;
?>
