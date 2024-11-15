<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_murid
LEFT JOIN tb_kelas ON tb_kelas.id_kelas = tb_murid.kelas ");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_kelas = mysqli_query($conn, "SELECT * FROM tb_kelas");

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
            Halaman Daftar Murid
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn " data-bs-toggle="modal" data-bs-target="#ModalTambahMurid" style="background-color:rgb(216, 191, 216)">Tambah Data Murid</button>
                </div>
            </div>


            <!-- Modal Tambah Murid Baru -->
            <div class="modal fade" id="ModalTambahMurid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Murid</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_murid.php" method="POST" id="studentForm">
                                <input type="hidden" name="input_murid_validate" value="1">
                                <div class="row">
                                    <!-- Field Data Murid -->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="floatingInputNama" class="form-label">Nama Murid</label>
                                            <input type="text" class="form-control" id="nama_murid" name="nama_murid" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kode_murid" class="form-label">Kode Murid</label>
                                            <input type="text" class="form-control" id="kode_murid" name="kode_murid" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jen_kel" class="form-label">Jenis Kelamin</label>
                                            <select class="form-control" id="jen_kel" name="jen_kel" required>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nohp" class="form-label">Nomor HP</label>
                                            <input type="text" class="form-control" id="nohp" name="nohp" required>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="kelas" required>
                                                <option selected hidden value="">Pilih Kelas</option>
                                                <?php
                                                foreach ($select_kelas as $value) {
                                                    echo "<option value=" . $value['id_kelas'] . ">" . $value['nama_kelas'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingInput">Kelas</label>
                                            <div class="invalid-feedback">
                                                Pilih Kelas.
                                            </div>
                                        </div>

                                        <!-- Tombol untuk memulai pengambilan foto -->
                                        <button type="button" id="startCapture" class="btn btn-primary mb-3">Mulai Pengambilan Foto</button>

                                        <!-- Bubble status untuk status pengambilan foto -->
                                        <div id="captureStatus" class="mt-2"></div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-success">Simpan Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                // Script untuk menangani tombol capture
                let isCapturing = false; // Variabel untuk menandakan apakah sedang capture
                let captureInterval; // Untuk menyimpan interval pengambilan gambar

                // Fungsi untuk memulai pengambilan foto
                function startCapture() {
                    const personCode = document.getElementById('kode_murid').value;

                    if (!personCode) {
                        document.getElementById('captureStatus').innerHTML = '<div class="alert alert-warning">Isi Kode Murid terlebih dahulu sebelum mengambil foto.</div>';
                        return;
                    }

                    // Mulai pengambilan foto
                    isCapturing = true;
                    document.getElementById('captureStatus').innerHTML = '<div class="alert alert-info">Pengambilan foto dimulai...</div>';

                    // Pengambilan foto hanya sekali
                    fetch(`run_capture.php?person_code=${personCode}`)
                        .then(response => response.text())
                        .then(data => {
                            // Update status dengan informasi capture terbaru
                            document.getElementById('captureStatus').innerHTML = data;
                        })
                        .catch(error => {
                            document.getElementById('captureStatus').innerHTML = '<div class="alert alert-danger" role="alert">Gagal mengambil foto, coba lagi.</div>';
                        });
                }

                // Fungsi untuk menghentikan pengambilan foto
                function stopCapture() {
                    isCapturing = false;
                    document.getElementById('captureStatus').innerHTML = '<div class="alert alert-success">Pengambilan foto dihentikan.</div>';
                }

                // Menambahkan event listener untuk tombol "Q"
                document.addEventListener('keydown', (event) => {
                    if (event.key === 'q' || event.key === 'Q') {
                        stopCapture(); // Menyudahi pengambilan gambar jika "Q" ditekan
                    }
                });

                // Event listener untuk memulai pengambilan foto saat tombol diklik
                document.getElementById('startCapture').addEventListener('click', startCapture);
            </script>


            <!-- End Modal Tambah Kelas Baru -->

            <?php
            foreach ($result as $row) {
            ?>


                <!-- Modal View -->
                <div class="modal fade" id="ModalView<?php echo $row['id_murid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data Murid</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_edit_murid.php" method="POST">
                                    <input disabled type="hidden" value="<?php echo $row['id_murid'] ?>" name="id_murid">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <input disabled type="text" class="form-control" id="floatingInputNama" placeholder="Nama Murid" name="nama_murid" required value="<?php echo $row['nama_murid'] ?>">
                                                <label for="floatingInputNama">Nama Murid</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Nama.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <input disabled type="text" class="form-control" id="floatingInputAlamat" placeholder="Kode Murid" name="kode_murid" required value="<?php echo $row['kode_murid'] ?>">
                                                <label for="floatingInputAlamat">kode Murid</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Kode Murid.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select disabled class="form-select" aria-label="Default select example" name="kelas" value="<?php echo $row['nama_kelas'] ?>">
                                                    <option selected hidden value="">Pilih Kelas</option>
                                                    <?php
                                                    foreach ($select_kelas as $value) {
                                                        if ($row['kelas'] == $value['id_kelas']) {
                                                            echo "<option selected value=" . $value['id_kelas'] . ">" . $value['nama_kelas'] . "</option>";
                                                        } else {
                                                            echo "<option value=" . $value['id_kelas'] . ">" . $value['nama_kelas'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInput">Kelas</label>
                                                <div class="invalid-feedback">
                                                    Pilih Kelas.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <select disabled class="form-select" aria-label="Default select example" required name="jen_kel" id="">
                                                    <?php
                                                    $data = array("Laki-laki", "Perempuan");
                                                    foreach ($data as $value) {
                                                        if ($row['jen_kel'] == $value) {
                                                            echo "<option selected value='$value'>$value</option>";
                                                        } else {
                                                            echo "<option value='$value'>$value</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInputJenisKelamin">Pilih Jenis Kelamin</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input disabled type="number" class="form-control" id="floatingInputNohp" placeholder="08xxxxx" name="nohp" value="<?php echo $row['nohp'] ?>">
                                                <label for="floatingInputNohp">No HP</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea disabled class="form-control" id="" style="height: 100px" name="alamat"><?php echo $row['alamat'] ?></textarea>
                                        <label for="floatingInput">Alamat</label>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="edit_murid_validate" value="12345">Save</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal View -->


                <!-- Modal Edit -->
                <div class="modal fade" id="ModalEdit<?php echo $row['id_murid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Murid</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_edit_murid.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_murid'] ?>" name="id_murid">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control py-3" id="uploadFoto" placeholder="Your Name" name="foto" required value="<?php echo $row['foto'] ?>">
                                                <label class="input-group-text" for="uploadFoto">Upload Photo Murid</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Foto
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInputNama" placeholder="Nama Murid" name="nama_murid" required value="<?php echo $row['nama_murid'] ?>">
                                                <label for="floatingInputNama">Nama Murid</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Nama.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInputAlamat" placeholder="Kode Murid" name="kode_murid" required value="<?php echo $row['kode_murid'] ?>">
                                                <label for="floatingInputAlamat">kode Murid</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Kode Murid.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" name="kelas" value="<?php echo $row['nama_kelas'] ?>">
                                                    <option selected hidden value="">Pilih Kelas</option>
                                                    <?php
                                                    foreach ($select_kelas as $value) {
                                                        if ($row['kelas'] == $value['id_kelas']) {
                                                            echo "<option selected value=" . $value['id_kelas'] . ">" . $value['nama_kelas'] . "</option>";
                                                        } else {
                                                            echo "<option value=" . $value['id_kelas'] . ">" . $value['nama_kelas'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInput">Kelas</label>
                                                <div class="invalid-feedback">
                                                    Pilih Kelas.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" required name="jen_kel" id="">
                                                    <?php
                                                    $data = array("Laki-laki", "Perempuan");
                                                    foreach ($data as $value) {
                                                        if ($row['jen_kel'] == $value) {
                                                            echo "<option selected value='$value'>$value</option>";
                                                        } else {
                                                            echo "<option value='$value'>$value</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInputJenisKelamin">Pilih Jenis Kelamin</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInputNohp" placeholder="08xxxxx" name="nohp" value="<?php echo $row['nohp'] ?>">
                                                <label for="floatingInputNohp">No HP</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="" style="height: 100px" name="alamat"><?php echo $row['alamat'] ?></textarea>
                                        <label for="floatingInput">Alamat</label>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="edit_murid_validate" value="12345">Save</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal Edit -->


                <!-- Modal Delete -->
                <div class="modal fade" id="ModalDelete<?php echo $row['id_murid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data Murid</h1>
                                <button type="button" class="btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_delete_murid.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_murid'] ?>" name="id_murid">
                                    <div class="col-lg-12">
                                        Apakah Anda yakin ingin menghapus data murid <b><?php echo $row['nama_murid'] ?></b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" name="delete_murid_validate" value="12345">Hapus</button>
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
                echo "Data Murid tidak ada";
            } else {
            ?>

                <div class="table-responsive mt-3">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Foto Murid</th>
                                <th scope="col">Nama</th>
                                <th scope="col">kode Murid</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">No HP</th>
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
                                        <div style="width: 70px"><img src="assets/img/<?php echo $row['foto'] ?>" class="img-thumbnail" alt="..."></div>
                                    </td>
                                    <td>
                                        <?php echo $row['nama_murid'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['kode_murid'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['nama_kelas'] ?>
                                    </td>
                                    <td>
                                        <?php echo ($row['jen_kel'] == 1) ? "Laki-laki" : "Perempuan" ?>
                                    </td> <!-- Tambahkan tag penutup di sini -->
                                    <td>
                                        <?php echo $row['nohp'] ?>
                                    </td>
                                    <td class="d-flex align-items-stretch justify-content-center">
                                        <button style="background-color:rgb(138, 205, 215); height: 100%;" class="btn btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id_murid'] ?>"><i class="bi bi-eye"></i></button>
                                        <button style="background-color:rgb(247, 183, 135); height: 100%;" class="btn btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_murid'] ?>"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-danger btn-sm me-1" style="height: 100%;" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_murid'] ?>"><i class="bi bi-trash"></i></button>
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
    })()
</script>