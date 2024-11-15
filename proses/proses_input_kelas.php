<?php
include "connect.php";

$nama_kelas = (isset($_POST['nama_kelas'])) ? htmlentities($_POST['nama_kelas']) : "";
$tingkat = (isset($_POST['tingkat'])) ? htmlentities($_POST['tingkat']) : "";
$kapasitas = (isset($_POST['kapasitas'])) ? htmlentities($_POST['kapasitas']) : "";
$wali_kelas = (isset($_POST['wali_kelas'])) ? htmlentities($_POST['wali_kelas']) : "";

if (!empty($_POST['input_kelas_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE nama_kelas = '$nama_kelas'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Kelas yang anda masukkan telah ada");
                    window.location="../kelas"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_kelas (nama_kelas, tingkat, kapasitas, wali_kelas) 
    values ('$nama_kelas', '$tingkat', '$kapasitas', '$wali_kelas')");
        if ($query) {
            $message = '<script>alert("Data berhasil dimasukkan");
                        window.location="../kelas"</script>';
        } else {
            $message = '<script>alert("Data gagal dimasukkan")</script>';
        }
    }}

echo $message;
?>
