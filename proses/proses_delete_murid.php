<?php
include "connect.php";

$id_murid = (isset($_POST['id_murid'])) ?  htmlentities($_POST['id_murid']) : "";

if (!empty($_POST['delete_murid_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_murid WHERE id_murid ='$id_murid'");
    if ($query) {
        $message = '<script>alert("Data berhasil dihapus");
                    window.location="../murid"</script>';
    } else {
        $message = '<script>alert("Data gagal dihapus");
                    window.location="../murid"</script>';
    }
}
echo $message;
?>
