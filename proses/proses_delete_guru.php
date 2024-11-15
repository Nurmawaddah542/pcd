<?php
include "connect.php";

$id_guru = (isset($_POST['id_guru'])) ?  htmlentities($_POST['id_guru']) : "";

if (!empty($_POST['delete_guru_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_guru WHERE id_guru ='$id_guru'");
    if ($query) {
        $message = '<script>alert("Data berhasil dihapus");
                    window.location="../guru"</script>';
    } else {
        $message = '<script>alert("Data gagal dihapus");
                    window.location="../guru"</script>';
    }
}
echo $message;
?>
