<?php
if (isset($_GET['person_code'])) {
    $person_code = escapeshellarg($_GET['person_code']);
    $output = shell_exec("python3 dataset.py $person_code start_capture");
    echo '<div class="alert alert-success" role="alert">File sudah disimpan</div>'; // Tampilkan pesan bubble
} else {
    echo '<div class="alert alert-danger" role="alert">Person code missing!</div>';
}
?>
