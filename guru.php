<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_guru");
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
            Halaman Daftar Guru
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn " data-bs-toggle="modal" data-bs-target="#ModalTambahGuru" style="background-color:rgb(216, 191, 216)">Tambah Data Guru</button>
                </div>
            </div>
            <!-- Modal Tambah Guru Baru -->
            <div class="modal fade" id="ModalTambahGuru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Guru</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_guru.php" method="POST">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInputNama" placeholder="Nama Guru" name="nama_guru" required>
                                            <label for="floatingInputNama">Nama Guru</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInputAlamat" placeholder="Kode Guru" name="kode_guru" required>
                                            <label for="floatingInputAlamat">Kode Guru</label>
                                            <div class="invalid-feedback">
                                                Masukkan Kode guru.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="jen_kel" id="">
                                                <option value="1">Laki-laki</option>
                                                <option value="2">Perempuan</option>
                                            </select>
                                            <label for="floatingInput">Pilih Jenis Kelamin</label>
                                            <div class="invalid-feedback">
                                                Masukkan Jenis Kelamin.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInputNohp" placeholder="08xxxxx" name="nohp">
                                            <label for="floatingInputNohp">No HP</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" style="height:100px" name="alamat"></textarea>
                                    <label for="floatingInput">Alamat</label>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="input_guru_validate" value="12345">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal Tambah Kelas Baru -->


            <?php
            foreach ($result as $row) {
            ?>

                <!-- Modal View -->
                <div class="modal fade" id="ModalView<?php echo $row['id_guru'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data Guru</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_edit_guru.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_guru'] ?>" name="id_guru">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input disabled type="text" class="form-control" id="floatingInput" placeholder="Nama Guru" name="nama_guru" required value="<?php echo $row['nama_guru'] ?>">
                                                <label for="floatingInput">Nama Guru</label>
                                                <div class="invalid-feedback">
                                                    Edit Nama Guru.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input disabled type="text" class="form-control" id="floatingInput" placeholder="Kode guru" name="kode_guru" required value="<?php echo $row['kode_guru'] ?>">
                                                <label for="floatingInput">Kode guru</label>
                                                <div class="invalid-feedback">
                                                    Detail kode guru.
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
                                                <label for="floatingInput">Jenis Kelamin</label>
                                                <div class="invalid-feedback">
                                                    Pilih Jenis Kelamin.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="number" class="form-control" id="floatingInput" placeholder="08xxxxxxx" name="nohp" value="<?php echo $row['nohp'] ?>">
                                                    <label for="floatingInput">No HP</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea disabled class="form-control" id="" style="height: 100px" name="alamat"><?php echo $row['alamat'] ?></textarea>
                                        <label for="floatingInput">Alamat</label>
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
                <div class="modal fade" id="ModalEdit<?php echo $row['id_guru'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Guru</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_edit_guru.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_guru'] ?>" name="id_guru">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Nama Guru" name="nama_guru" required value="<?php echo $row['nama_guru'] ?>">
                                                <label for="floatingInput">Nama Guru</label>
                                                <div class="invalid-feedback">
                                                    Edit Nama Guru.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Kode Guru" name="kode_guru" required value="<?php echo $row['kode_guru'] ?>">
                                                <label for="floatingInput">Kode Guru</label>
                                                <div class="invalid-feedback">
                                                    Edit Kode Guru.
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
                                                <label for="floatingInput">Jenis Kelamin</label>
                                                <div class="invalid-feedback">
                                                    Pilih Jenis Kelamin.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="08xxxxxxx" name="nohp" value="<?php echo $row['nohp'] ?>">
                                                    <label for="floatingInput">No HP</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="" style="height: 100px" name="alamat"><?php echo $row['alamat'] ?></textarea>
                                        <label for="floatingInput">Alamat</label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="edit_guru_validate" value="12345">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Edit -->


                <!-- Modal Delete -->
                <div class="modal fade" id="ModalDelete<?php echo $row['id_guru'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data Guru</h1>
                                <button type="button" class="btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_delete_guru.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_guru'] ?>" name="id_guru">
                                    <div class="col-lg-12">
                                        Apakah Anda yakin ingin menghapus data guru <b><?php echo $row['nama_guru'] ?></b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" name="delete_guru_validate" value="12345">Hapus</button>
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
                echo "Data Guru tidak ada";
            } else {
            ?>

                <div class="table-responsive mt-3">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kode guru</th>
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
                                        <?php echo $no++ ?></th>
                                    <td>
                                        <?php echo $row['nama_guru'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['kode_guru'] ?>
                                    </td>
                                    <td>
                                        <?php echo ($row['jen_kel'] == 1) ? "Laki-laki" : "Perempuan" ?>
                                    </td>
                                    <td>
                                        <?php echo $row['nohp'] ?>
                                    </td>
                                    <td class="d-flex">
                                        <button style="background-color:rgb(138, 205, 215)" class="btn btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id_guru'] ?>"><i class="bi bi-eye"></i></button>
                                        <button style="background-color:rgb(247, 183, 135)" class="btn btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_guru'] ?>"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_guru'] ?>"><i class="bi bi-trash"></i></button>
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