<?php
include "proses/connect.php";
include "C:\laragon\www\Project_base_learning\Project_base_learning\TabungKu\libs\phpqrcode\qrlib.php";

$namaNasabah = isset($_POST['nama_nasabah']) ? $_POST['nama_nasabah'] : '';
$result = null;
$total_saldo = 0;
$qrCodeData = '';

if ($namaNasabah != '') {
    $query = "SELECT * FROM tb_transaksi WHERE nama_nasabah LIKE '%$namaNasabah%' ORDER BY id_transaksi ASC";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo ("Query Error: " . mysqli_error($conn));
    }

    // Hitung total saldo
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $total_saldo += $row['jumlah'];
        }

        // Membuat hash unik untuk data nasabah ini
        $uniqueHash = hash('sha256', $namaNasabah . $total_saldo . time());

        // Data untuk QR Code hanya berisi jumlah saldo dan hash unik
        $qrCodeData = json_encode([
            'nama_nasabah' => $namaNasabah,
            'total_saldo' => $total_saldo
        ]);
    }
}

// Menghasilkan QR Code
$tempDir = 'temp/';
if (!file_exists($tempDir)) {
    mkdir($tempDir);
}
$fileName = 'qrcode_' . $namaNasabah . '.png';
$filePath = $tempDir . $fileName;
QRcode::png($qrCodeData, $filePath); // Menghasilkan QR Code dan menyimpannya

?>

<style>
    body {
        background-color: #f8f9fa;
    }

    #grad1 {
        background-color: red;
        background-image: linear-gradient(to bottom right, #D8BFD8, #FFDAB9);
        padding: 20px;
        border-radius: 10px;
        margin-top: 20px;
    }
</style>

<!-- Halaman Utama: Menampilkan Mutasi Transaksi -->
<div class="col-lg-9 mt-3" id="grad1">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <form action="report" method="post" class="w-100">
                <div class="mb-3">
                    <label for="nama_nasabah" class="form-label">Masukkan nama nasabah yang ingin anda cari:</label>
                    <div class="d-flex">
                        <input type="text" class="form-control me-1" id="nama_nasabah" name="nama_nasabah">
                        <button type="submit" class="btn" style="background-color:rgb(216, 191, 216)">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body <?php echo (!$result) ? 'd-none' : '' ?>">
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto; width: 100%;">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Nama Nasabah</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && mysqli_num_rows($result) > 0) {
                            mysqli_data_seek($result, 0); // Reset pointer hasil query
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['nama_nasabah'] . "</td>";
                                echo "<td>" . $row['tgl_transaksi'] . "</td>";
                                echo "<td>" . ($row['jabatan'] == 1 ? "Guru" : "Murid") . "</td>";
                                echo "<td>" . number_format($row['jumlah'], 2, '.', ',') . "</td>";
                                echo "</tr>";
                            }
                            echo "<tr>";
                            echo "<td colspan='3'><strong>Total Saldo</strong></td>";
                            echo "<td><strong>" . number_format($total_saldo, 2) . "</strong></td>";
                            echo "</tr>";
                        } else {
                            echo "<tr><td colspan='4'>Tidak ada data ditemukan</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <button class="btn btn-secondary" onclick="cetakHasilPencarian()">Cetak</button>
            </div>
            <div class="mt-3">
                <h5>QR Code untuk Report:</h5>
                <img src="<?php echo $filePath; ?>" alt="QR Code" />
            </div>
        </div>
    </div>

    <script>
        function cetakHasilPencarian() {
            var printContents = document.querySelector('.table-responsive').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</div>