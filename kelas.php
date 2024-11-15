<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_kelas");
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
            Halaman Daftar Kelas
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn " data-bs-toggle="modal" data-bs-target="#ModalTambahKelas" style="background-color:rgb(216, 191, 216)">Tambah Kelas</button>
                </div>
            </div>

            <!-- Modal Tambah Kelas Baru -->
            <div class="modal fade" id="ModalTambahKelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelas</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_kelas.php" method="POST">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Nama Kelas" name="nama_kelas" required>
                                            <label for="floatingInput">Nama Kelas</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama Kelas.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="tingkat" id="">
                                                <option value="1">A</option>
                                                <option value="2">B</option>
                                            </select>
                                            <label for="floatingInput">Tingkat Kelas</label>
                                            <div class="invalid-feedback">
                                                Pilih Tingkat Kelas.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Kapasitas Kelas" name="kapasitas" required>
                                            <label for="floatingInput">Kapasitas Kelas</label>
                                            <div class="invalid-feedback">
                                                Masukkan Kapasitas Kelas.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Wali Kelas" name="wali_kelas" required>
                                            <label for="floatingInput">Nama Wali Kelas</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama Wali Kelas.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_kelas_validate" value="12345">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Tambah Kelas Baru -->

            <?php
            foreach ($result as $row) {
            ?>

                <!-- Modal Edit -->
                <div class="modal fade" id="ModalEdit<?php echo $row['id_kelas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data kelas</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_edit_kelas.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_kelas'] ?>" name="id_kelas">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Nama Kelas" name="nama_kelas" required value="<?php echo $row['nama_kelas'] ?>">
                                                <label for="floatingInput">Nama Kelas</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Nama Kelas.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" required name="tingkat" id="">
                                                <?php
                                                    $data = array("A", "B");
                                                    foreach ($data as $key => $value) {
                                                        if ($row['tingkat'] == $key + 1) {
                                                            echo "<option selected value = ".($key+1).">$value</option>";
                                                        } else {
                                                            echo "<option value = ".($key+1).">$value</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInput">Tingkat Kelas</label>
                                                <div class="invalid-feedback">
                                                    Pilih Tingkat Kelas.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Kapasitas Kelas" name="kapasitas" required value="<?php echo $row['kapasitas'] ?>">
                                                <label for="floatingInput">Kapasitas Kelas</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Kapasitas Kelas.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Wali Kelas" name="wali_kelas" required value="<?php echo $row['wali_kelas'] ?>">
                                                <label for="floatingInput">Wali Kelas</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Nama Wali Kelas.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="edit_kelas_validate" value="12345">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Edit -->


                <!-- Modal Delete -->
                <div class="modal fade" id="ModalDelete<?php echo $row['id_kelas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data Kelas</h1>
                                <button type="button" class="btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_delete_kelas.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_kelas'] ?>" name="id_kelas">
                                    <div class="col-lg-12">
                                        Apakah Anda yakin ingin menghapus Kelas <b><?php echo $row['nama_kelas'] ?></b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" name="delete_kelas_validate" value="12345">Hapus</button>
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
                echo "Data kelas tidak ada";
            } else {
            ?>

                <div class="table-responsive mt-3">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Kelas</th>
                                <th scope="col">Tingkat</th>
                                <th scope="col">Kapasitas</th>
                                <th scope="col">Wali Kelas</th>
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
                                        <?php echo $row['nama_kelas'] ?>
                                    </td>
                                    <td>
                                        <?php echo ($row['tingkat']==1) ? "A" : "B" ?>
                                    </td>
                                    <td>
                                        <?php echo $row['kapasitas'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['wali_kelas'] ?>
                                    </td>
                                    <td class="d-flex">
                                        <button style="background-color:rgb(247, 183, 135)" class="btn btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_kelas'] ?>"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_kelas'] ?>"><i class="bi bi-trash"></i></button>
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