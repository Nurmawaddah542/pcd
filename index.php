<!doctype html>
<html lang="en">

<head>
<link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <?php
    session_start();
    if (isset($_GET['x']) && $_GET['x'] == 'home') {
        $page = "home.php";
        include "main.php";
    } elseif (isset($_GET['x']) && $_GET['x'] == 'kelas') {
        if ($_SESSION['level_tabungku'] == 1 ) {
            $page = "kelas.php";
            include "main.php";
        } else {
            $page = "home.php";
            include "main.php";
        }
    } elseif (isset($_GET['x']) && $_GET['x'] == 'guru') {
        if ($_SESSION['level_tabungku'] == 1 ) {
            $page = "guru.php";
            include "main.php";
        } else {
            $page = "home.php";
            include "main.php";
        }
    } elseif (isset($_GET['x']) && $_GET['x'] == 'murid') {
        if ($_SESSION['level_tabungku'] == 1  ) {
            $page = "murid.php";
            include "main.php";
        } else {
            $page = "home.php";
            include "main.php";
        }
    } elseif (isset($_GET['x']) && $_GET['x'] == 'user') {
        if ($_SESSION['level_tabungku'] == 1) {
            $page = "user.php";
            include "main.php";
        } else {
            $page = "home.php";
            include "main.php";
        }
    } elseif (isset($_GET['x']) && $_GET['x'] == 'transaksi') {
        if ($_SESSION['level_tabungku'] == 1) {
            $page = "transaksi.php";
            include "main.php";
        } else {
            $page = "home.php";
            include "main.php";
        }
    } elseif (isset($_GET['x']) && $_GET['x'] == 'report') {
        $page = "report.php";
        include "main.php";
    } elseif (isset($_GET['x']) && $_GET['x'] == 'chart') {
        $page = "chart.php";
        include "main.php";
    } elseif (isset($_GET['x']) && $_GET['x'] == 'login') {
        include "login.php";
    } elseif (isset($_GET['x']) && $_GET['x'] == 'logout') {
        include "proses/proses_logout.php";
    } else {
        $page = "home.php";
        include "main.php";
    }
    ?>