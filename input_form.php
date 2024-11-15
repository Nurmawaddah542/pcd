<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Transaksi</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1>Input Transaksi</h1>
        <form action="proses/proses_input_transaksi.php" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="nama_nasabah" class="form-label">Nama Nasabah</label>
                <input type="text" class="form-control" id="nama_nasabah" name="nama_nasabah" required>
                <div class="invalid-feedback">Masukkan Nama Nasabah.</div>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select class="form-select" id="jabatan" name="jabatan" required>
                    <option value="">Pilih Jabatan</option>
                    <option value="1">Guru</option>
                    <option value="2">Murid</option>
                </select>
                <div class="invalid-feedback">Pilih Jabatan.</div>
            </div>
            <div class="mb-3">
                <label for="tgl_transaksi" class="form-label">Tanggal Transaksi</label>
                <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" required>
                <div class="invalid-feedback">Masukkan Tanggal Transaksi.</div>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status Transaksi</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="">Pilih Status</option>
                    <option value="1">PENDING</option>
                    <option value="2">COMPLETE</option>
                    <option value="3">CANCELLED</option>
                </select>
                <div class="invalid-feedback">Pilih Status.</div>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah Transaksi</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                <div class="invalid-feedback">Masukkan Jumlah Transaksi.</div>
            </div>
            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea class="form-control" id="catatan" name="catatan"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script>
        // Bootstrap validation
        (() => {
            'use strict';

            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>
</html>