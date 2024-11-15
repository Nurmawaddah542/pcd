<?php
include "connect.php";
$id_kelas = (isset($_POST['id_kelas'])) ?  htmlentities($_POST['id_kelas']) : "";

if (!empty($_POST['delete_kelas_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_kelas WHERE id_kelas ='$id_kelas'");
    if ($query) {
        $message = '<script>alert("Data berhasil dihapus");
                    window.location="../kelas"</script>';
    } else {
        $message = '<script>alert("Data gagal dihapus");
                    window.location="../kelas"</script>';
    }
}
echo $message;
