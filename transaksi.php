<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_transaksi");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

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

<div class="col-lg-9 mt-3" id="grad1">
    <div class="card">
        <div class="card-header">
            Halaman transaksi
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#ModalTambahTransaksi" style="background-color:rgb(216, 191, 216)">Tambah transaksi</button>
                </div>
            </div>


            <!-- Tambah Transaksi Baru Modal -->
            <div class="modal fade" id="ModalTambahTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Transaksi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Pilihan metode input -->
                            <div class="mb-3 text-center">
                                <button type="button" class="btn btn-primary" onclick="setInputMethod('manual')">Input Manual</button>
                                <button type="button" class="btn btn-secondary" onclick="setInputMethod('qr')">Input via QR</button>
                                <button type="button" class="btn btn-success" onclick="setInputMethod('ocr')">Scan Mata Uang (OCR)</button>
                            </div>

                            <!-- Form Transaksi -->
                            <div id="transaksiFormContainer" style="display: none;">
                                <form class="needs-validation" novalidate action="proses/proses_input_transaksi.php" method="POST" id="transaksiForm">
                                    <input type="hidden" id="inputMethod" name="input_method" value="manual">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="nama_nasabah" placeholder="Nama" name="nama_nasabah" required>
                                                <label for="nama_nasabah">Nama Nasabah</label>
                                                <div class="invalid-feedback">Masukkan Nama Nasabah.</div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="jabatan" required>
                                                    <option value="1">Guru</option>
                                                    <option value="2">Murid</option>
                                                </select>
                                                <label for="jabatan">Jabatan</label>
                                                <div class="invalid-feedback">Pilih Jabatan.</div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" value="<?php echo date('Y-m-d'); ?>" required>
                                                <label for="tgl_transaksi">Tanggal Transaksi</label>
                                                <div class="invalid-feedback">Masukkan Tanggal Transaksi.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="status" required>
                                                    <option value="1">PENDING</option>
                                                    <option value="2">COMPLETE</option>
                                                    <option value="3">CANCELLED</option>
                                                </select>
                                                <label for="status">Status Transaksi</label>
                                                <div class="invalid-feedback">Pilih Status.</div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="jumlah" placeholder="jumlah" name="jumlah" required>
                                                <label for="jumlah">Jumlah Transaksi</label>
                                                <div class="invalid-feedback">Masukkan Jumlah Transaksi.</div>
                                            </div>
                                            <!-- Container untuk video kamera -->
                                            <div id="cameraContainer" style="display: none;">
                                                <video id="video" width="100%" autoplay></video>
                                                <button type="button" class="btn btn-primary mt-3" onclick="captureOCR()">Scan Jumlah Uang</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="input_transaksi_validate" value="12345">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- JavaScript untuk Mengatur Input Method dan OCR -->
            <script>
                function setInputMethod(method) {
                    const formContainer = document.getElementById('transaksiFormContainer');
                    document.getElementById('inputMethod').value = method;

                    if (method === 'manual') {
                        formContainer.style.display = 'block';
                        document.getElementById('cameraContainer').style.display = 'none';
                    } else if (method === 'qr') {
                        window.location.href = 'qrcode2.png';
                    } else if (method === 'ocr') {
                        formContainer.style.display = 'block';
                        document.getElementById('cameraContainer').style.display = 'block';
                        startCamera();
                    }
                }

                function startCamera() {
                    const video = document.getElementById('video');
                    navigator.mediaDevices.getUserMedia({
                            video: true
                        })
                        .then((stream) => {
                            video.srcObject = stream;
                        })
                        .catch((error) => {
                            console.error("Gagal membuka kamera", error);
                        });
                }

                function captureOCR() {
                    const video = document.getElementById('video');
                    const canvas = document.createElement('canvas');
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    const context = canvas.getContext('2d');
                    context.drawImage(video, 0, 0);

                    canvas.toBlob((blob) => {
                        const formData = new FormData();
                        formData.append('image', blob, 'currency.jpg');

                        fetch('http://127.0.0.1:5000/scan', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById('jumlah').value = data.amount || 'Tidak terdeteksi';
                                document.getElementById('nama_nasabah').value = data.nama || 'Tidak dikenali';
                            })
                            .catch(error => {
                                console.error("Error:", error);
                            });
                    }, 'image/jpeg');
                }
            </script>


            <?php
            foreach ($result as $row) {
            ?>


                <!-- Modal View -->
                <div class="modal fade" id="ModalView<?php echo $row['id_transaksi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Transaksi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_input_transaksi.php" method="POST">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Nama Nasabah" name="nama_nasabah" value="<?php echo $row['nama_nasabah']; ?>" disabled>
                                                <label for="floatingInput">Nama Nasabah</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select disabled class="form-select" aria-label="Default select example" required name="jabatan" id="">
                                                    <?php
                                                    $dataJabatan = array("Guru", "Murid");
                                                    foreach ($dataJabatan as $key => $value) {
                                                        if ($row['jabatan'] == $key + 1) {
                                                            echo "<option selected value='" . ($key + 1) . "'>$value</option>";
                                                        } else {
                                                            echo "<option value='" . ($key + 1) . "'>$value</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInput">Jabatan</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="tgl_transaksi" placeholder="Tanggal Transaksi" name="tgl_transaksi" value="<?php echo $row['tgl_transaksi']; ?>" disabled>
                                                <label for="tgl_transaksi">Tanggal Transaksi</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <select disabled class="form-select" aria-label="Default select example" required name="status" id="">
                                                    <?php
                                                    $dataStatus = array("PENDING", "COMPLETE", "CANCELLED");
                                                    foreach ($dataStatus as $key => $value) {
                                                        if ($row['status'] == $key + 1) {
                                                            echo "<option selected value='" . ($key + 1) . "'>$value</option>";
                                                        } else {
                                                            echo "<option value='" . ($key + 1) . "'>$value</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="status">Status Transaksi</label>
                                                <div class="invalid-feedback">
                                                    Pilih Status.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="Jumlah Transaksi" name="jumlah" value="<?php echo $row['jumlah']; ?>" disabled>
                                                <label for="floatingInput">Jumlah Transaksi</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating">
                                        <textarea class="form-control" style="height:100px" name="catatan" disabled><?php echo $row['catatan']; ?></textarea>
                                        <label for="floatingInput">Catatan</label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal View -->



                <!-- Modal Edit -->
                <div class="modal fade" id="ModalEdit<?php echo $row['id_transaksi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah transaksi Baru</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_edit_transaksi.php" method="POST">
                                    <input type="hidden" name="edit_transaksi" value="<?php echo $row['id_transaksi']; ?>">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="Nama Nasabah" name="nama_nasabah" value="<?php echo $row['nama_nasabah']; ?>">
                                                    <label for="floatingInput">Nama Nasabah</label>
                                                    <div class="invalid-feedback">
                                                        Edit nama nasabah.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="jabatan" required value="<?php echo ($row['jabatan']); ?>">
                                                    <option value="1">Guru</option>
                                                    <option value="2">Murid</option>
                                                </select>
                                                <label for="status">Jabatan</label>
                                                <div class="invalid-feedback">
                                                    Pilih Jabatan.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" value="<?php echo isset($result[0]['tgl_transaksi']) ? $result[0]['tgl_transaksi'] : date('Y-m-d'); ?>" required>
                                                <label for="tgl_transaksi">Tanggal Transaksi</label>
                                                <div class="invalid-feedback">
                                                    Edit Tanggal Transaksi.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="status" id="" required value="<?php echo ($row['status']); ?>">
                                                    <option value="1">PENDING</option>
                                                    <option value="2">COMPLETE</option>
                                                    <option value="3">CANCELLED</option>
                                                </select>
                                                <label for="floatingInput">Status Transaksi</label>
                                                <div class="invalid-feedback">
                                                    Pilih Status.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="jumlah" name="jumlah" required value="<?php echo $row['jumlah'] ?>">
                                                <label for="floatingInput">Jumlah Transaksi</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Jumlah Transaksi.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating">
                                        <textarea class="form-control" style="height:100px" name="catatan"></textarea>
                                        <label for="floatingInput">Catatan</label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="edit_transaksi_validate" value="12345">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Edit -->


                <!-- Modal Delete -->
                <div class="modal fade" id="ModalDelete<?php echo $row['id_transaksi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data transaksi</h1>
                                <button type="button" class="btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_delete_transaksi.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_transaksi'] ?>" name="id_transaksi">
                                    <div class="col-lg-12">
                                        Apakah Anda yakin ingin menghapus data transaksi nasabah <b><?php echo $row['nama_nasabah'] ?></b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" name="delete_transaksi_validate" value="12345">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Delete-->

            <?php
            }
            if (empty($result)) {
                echo "Data transaksi tidak ada";
            } else {
            ?>

                <div class="table-responsive mt-3">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Nasabah</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Tanggal Transaksi</th>
                                <th scope="col">Status</th>
                                <th scope="col">Saldo</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $no++ ?>
                                    </th>
                                    <td>
                                        <?php echo $row['nama_nasabah'] ?>
                                    </td>
                                    <td>
                                        <?php echo ($row['jabatan'] == 1) ? "Guru" : "Murid" ?>
                                    </td>
                                    <td>
                                        <?php echo $row['tgl_transaksi'] ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['status'] == 1) {
                                            echo "PENDING";
                                        } elseif ($row['status'] == 2) {
                                            echo "COMPLETE";
                                        } elseif ($row['status'] == 3) {
                                            echo "CANCELLED";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($row['jumlah'], 2, '.', ',') ?>
                                    </td>

                                    <td class="d-flex">
                                        <button style="background-color:rgb(138, 205, 215)" class="btn btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id_transaksi'] ?>"><i class="bi bi-eye"></i></button>
                                        <button style="background-color:rgb(247, 183, 135)" class="btn btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_transaksi'] ?>"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_transaksi'] ?>"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })();
</script>