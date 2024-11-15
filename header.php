<?php
include "proses/connect.php";
$query = mysqli_query($conn,  "SELECT * FROM tb_user WHERE username='$_SESSION[username_tabungku]'");
$record = mysqli_fetch_array($query);
?>

<style>
    .dropdown-item:focus,
    .dropdown-item:hover {
        background-color: #D8BFD8;
    }

</style>

<body>
    <nav class="navbar navbar-expand navbar-dark sticky-top" style="background-color:rgb(216, 191, 216)">
        <div class="container-lg">
            <a class="navbar-brand" href="."><i class="bi bi-bank"></i> TabungKu</a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $hasil['username']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li><a class="dropdown-item custom-dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahProfile"><i class="bi bi-person"></i> Profil</a></li>
                            <li><a class="dropdown-item custom-dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword"><i class="bi bi-key"></i> Ubah Password</a></li>
                            <li><a class="dropdown-item custom-dropdown-item" href="logout"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal Ubah Password-->
    <div class="modal fade" id="ModalUbahPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate action="proses/proses_ubah_password.php" method="POST">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $_SESSION['username_tabungku'] ?>">
                                    <label for="floatingInput">Username</label>
                                    <div class="invalid-feedback">
                                        Masukkan Username.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPasswordLama" name="passwordlama" required>
                                    <label for="floatingPasswordLama">Password Lama</label>
                                    <div class="invalid-feedback">
                                        Masukkan Password Lama.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPasswordBaru" name="passwordbaru" required>
                                    <label for="floatingPasswordBaru">Password Baru</label>
                                    <div class="invalid-feedback">
                                        Masukkan Password Baru.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingRePasswordBaru" name="repasswordbaru" required>
                                    <label for="floatingRePasswordBaru">Ulangi Password Baru</label>
                                    <div class="invalid-feedback">
                                        Masukkan Ulangi Password Baru.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="ubah_password_validate" value="1234">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  End Modal Edit Password-->

    <!-- Modal Ubah Profile-->
    <div class="modal fade" id="ModalUbahProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate action="proses/proses_ubah_profile.php" method="POST">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $_SESSION['username_tabungku'] ?>">
                                    <label for="floatingInput">Username</label>
                                    <div class="invalid-feedback">
                                        Masukkan Username.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingNama" name="nama" required value="<?php echo $record['nama'] ?>">
                                    <label for="floatingPasswordLama">Nama</label>
                                    <div class="invalid-feedback">
                                        Masukkan Nama Anda.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="floatingPasswordBaru" name="nohp" required value="<?php echo $record['nohp'] ?>">
                                    <label for="floatingPasswordBaru">Nomor HP</label>
                                    <div class="invalid-feedback">
                                        Masukkan Nomor Anda.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="" style="height: 100px" name="alamat"><?php echo $record['alamat'] ?></textarea>
                                    <label for="floatingRePasswordBaru">Alamat</label>
                                    <div class="invalid-feedback">
                                        Masukkan Alamat Anda.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="ubah_profile_validate" value="1234">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  Modal Edit Prpfile-->
</body>