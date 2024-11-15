<!--  -->

<body>
    <!-- Carousel -->
    <div class="col-lg-9 mt-3" id="grad1">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/sekolah.JPG" class="d-block w-100" alt="Sekolah">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Sekolah</h5>
                        <p>Tempat belajar yang nyaman dan inovatif untuk masa depan cerah anak-anak.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/kelas.jpg" class="d-block w-100" alt="Kelas">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Kelas</h5>
                        <p>Lingkungan pembelajaran yang inspiratif dan mendukung perkembangan anak.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/murid.jpeg" class="d-block w-100" alt="Murid">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Murid</h5>
                        <p>Anak-anak diajak tumbuh dan berkembang melalui kegiatan pembelajaran yang menyenangkan.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/taman.jpg" class="d-block w-100" alt="Murid">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Taman Bermain</h5>
                        <p>Anak-anak diajak tumbuh dan berkembang melalui tempat bermain yang mengasikkan.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- End Carousel -->

        <!-- Judul -->
        <div class="card mt-4 border-0 bg-light">
            <div class="card-body text-center">
                <h5 class="card-title">PAUD SBB AL-KHALIQ</h5>
                <p class="card-text text-center">Selamat datang di Aplikasi Tabungan untuk Murid Sekolah Paud SBB Al
                    Khaliq! Kami hadir dengan solusi keuangan inovatif yang dirancang khusus untuk mendukung pendidikan
                    finansial anak-anak.
                    Dengan aplikasi tabungan kami, setiap murid dapat dengan mudah mencatat setiap transaksi tabungan,
                    memantau saldo secara real-time,
                    dan mengeksplorasi riwayat transaksi mereka. Kami membawa pengalaman tabungan yang edukatif,
                    memberikan kesempatan kepada anak-anak untuk belajar tentang manajemen keuangan sejak dini.
                    Bergabunglah bersama kami dan dorong anak-anak untuk membentuk kebiasaan menabung yang positif
                    melalui Aplikasi Tabungan Sekolah Paud SBB Al Khaliq!
                </p>
                <a href="chart" class="btn justify-content-center" style="background-color:rgb(216, 191, 216)">Lihat
                    Pemasukan</a>
                <a href="qrlokasi.php" class="btn justify-content-center"
                    style="background-color:rgb(216, 191, 216)">Lokasi</a>
            </div>
        </div>
        <!-- End Judul -->


        <script>
            $(document).ready(function () {
                $('.carousel').carousel({
                    interval: 3000,
                    pause: 'hover'
                });
            });
        </script>