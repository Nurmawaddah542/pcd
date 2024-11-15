<?php
include "connect.php";

$nama_guru = (isset($_POST['nama_guru'])) ? htmlentities($_POST['nama_guru']) : "";
$kode_guru = (isset($_POST['kode_guru'])) ? htmlentities($_POST['kode_guru']) : "";
$jen_kel = (isset($_POST['jen_kel'])) ? htmlentities($_POST['jen_kel']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";

if (!empty($_POST['input_guru_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_guru WHERE nama_guru = '$nama_guru'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Data guru yang anda masukkan telah ada");
                    window.location="../guru"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_guru (nama_guru,kode_guru, jen_kel, alamat, nohp) 
    values ('$nama_guru','$kode_guru', '$jen_kel', '$alamat', '$nohp')");
        if ($query) {
            $message = '<script>alert("Data Guru berhasil dimasukkan");
                        window.location="../guru"</script>';
        } else {
            $message = '<script>alert("Data gagal dimasukkan")</script>';
        }
    }}

echo $message;
?>
