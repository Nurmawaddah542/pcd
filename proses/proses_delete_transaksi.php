<?php
include "connect.php";

$id_transaksi = isset($_POST['id_transaksi']) ? htmlentities($_POST['id_transaksi']) : "";

if (!empty($_POST['delete_transaksi_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_transaksi WHERE id_transaksi ='$id_transaksi'");
    if ($query) {
        echo '<script>alert("Data berhasil dihapus"); window.location="../transaksi"</script>';
    } else {
        echo '<script>alert("Data gagal dihapus"); window.location="../transaksi"</script>';
    }
}
?>