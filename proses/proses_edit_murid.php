<?php
session_start();
include "connect.php";

$id_murid = (isset($_POST['id_murid'])) ? htmlentities($_POST['id_murid']) : "";
$nama_murid = (isset($_POST['nama_murid'])) ? htmlentities($_POST['nama_murid']) : "";
$kode_murid = (isset($_POST['kode_murid'])) ? htmlentities($_POST['kode_murid']) : ""; 
$jen_kel = (isset($_POST['jen_kel'])) ? htmlentities($_POST['jen_kel']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$kelas = (isset($_POST['kelas'])) ? htmlentities($_POST['kelas']) : "";

$target_dir = "../assets/img/";
$uploaded_filename = null;
$statusUpload = 0;

// Check if the form is submitted to edit the student data
if (!empty($_POST['edit_murid_validate'])) {
    // Check if the file input is set and not empty
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        $cek = getimagesize($_FILES['foto']['tmp_name']);
        
        if ($cek !== false) {
            // Create the target directory if it doesn't exist
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Attempt to upload the file
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $statusUpload = 1;
                $uploaded_filename = basename($_FILES["foto"]["name"]);
            } else {
                $message = '<script>alert("Maaf, terjadi kesalahan file tidak dapat diupload"); window.location="../murid";</script>';
                echo $message;
                exit;
            }
        } else {
            $message = '<script>alert("Ini bukan file gambar"); window.location="../murid";</script>';
            echo $message;
            exit;
        }
    }

    // Update student data in the database
    if ($statusUpload == 1) {
        $query = mysqli_query($conn, "UPDATE tb_murid SET nama_murid='$nama_murid', kode_murid='$kode_murid', jen_kel='$jen_kel', alamat='$alamat', nohp='$nohp', kelas='$kelas', foto='$uploaded_filename'
            WHERE id_murid = '$id_murid'");
    } else {
        $query = mysqli_query($conn, "UPDATE tb_murid SET nama_murid='$nama_murid', kode_murid='$kode_murid', jen_kel='$jen_kel', alamat='$alamat', nohp='$nohp', kelas='$kelas'
            WHERE id_murid = '$id_murid'");
    }

    if ($query) {
        $message = '<script>alert("Data berhasil diupdate"); window.location="../murid";</script>';
    } else {
        $message = '<script>alert("Data gagal diupdate"); window.location="../murid";</script>';
    }

    echo $message;
}
?>
