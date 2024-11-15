<?php
include "connect.php";

$nama_murid = isset($_POST['nama_murid']) ? htmlentities($_POST['nama_murid']) : "";
$kode_murid = isset($_POST['kode_murid']) ? htmlentities($_POST['kode_murid']) : "";
$jen_kel = isset($_POST['jen_kel']) ? htmlentities($_POST['jen_kel']) : "";
$alamat = isset($_POST['alamat']) ? htmlentities($_POST['alamat']) : "";
$nohp = isset($_POST['nohp']) ? htmlentities($_POST['nohp']) : "";
$kelas = isset($_POST['kelas']) ? htmlentities($_POST['kelas']) : "";

$message = '';

if (!empty($_POST['input_murid_validate'])) {
    mysqli_begin_transaction($conn);
    $query = mysqli_query($conn, "INSERT INTO tb_murid (nama_murid, kode_murid, jen_kel, alamat, nohp, kelas) 
    VALUES ('$nama_murid', '$kode_murid', '$jen_kel', '$alamat', '$nohp', '$kelas')");

    if ($query) {
        mysqli_commit($conn);

        // Panggil script Python untuk pengambilan dataset wajah (1 file saja)
        $command = escapeshellcmd("python3 dataset.py '$kode_murid' start_capture");
        $output = shell_exec($command);

        $message = '<script>alert("Data murid berhasil dimasukkan dan foto wajah diambil"); window.location="../murid"</script>';
    } else {
        mysqli_rollback($conn);
        $message = '<script>alert("Data gagal dimasukkan"); window.location="../murid"</script>';
    }
}

echo $message;


