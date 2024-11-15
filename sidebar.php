<style>
.custom-nav-pills .nav-item .nav-link.active {
    background-color: rgb(216, 191, 216);
    color: white;
    border-radius: 7px; 
}
</style>

<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<div class="col-lg-3">
    <nav class="navbar navbar-expand-lg bg-light rounded border mt-3">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="width:250px">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><i class="bi bi-journal-text"></i> Tabungku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                <ul class="navbar-nav custom-nav-pills flex-column justify-content-end flex-grow-1 pe-0">
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo ((isset($_GET['x']) && $_GET['x'] == 'home') || !isset($_GET['x'] )) ? 'active link-light' : 'link-dark'?>" aria-current="page" href="home"><i class="bi bi-house"></i> Dashboard</a>
                        </li>
                        <?php if ($hasil['level'] == 1) { ?>
                            <li class="nav-item">
                                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'kelas') ? 'active link-light' : 'link-dark'?>" href="kelas"><i class="bi bi-buildings"></i> Daftar Kelas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'guru') ? 'active link-light' : 'link-dark'?>" href="guru"><i class="bi bi-person-video3"></i> Daftar Guru</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'murid') ? 'active link-light' : 'link-dark'?>" href="murid"><i class="bi bi-people-fill"></i> Daftar Murid</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'transaksi') ? 'active link-light' : 'link-dark'?>" href="transaksi"><iconify-icon icon="tdesign:undertake-transaction"></iconify-icon> Transaksi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'user') ? 'active link-light' : 'link-dark'?>" href="user"><i class="bi bi-person-circle"></i> User</a>
                            </li>
                            <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'report') ? 'active link-light' : 'link-dark'?>" href="report"><i class="bi bi-bar-chart-line-fill"></i> Report</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div> 
</body>
</html>

