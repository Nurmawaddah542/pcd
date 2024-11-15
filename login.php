<?php
//session_start();
if (!empty($_SESSION['username_tabungku'])) {
    header('location:home');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>TabungKu - Aplikasi Pencatatan Tabungan PAUD SBB AL-KHALIQ</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .form-signin {
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(253, 218, 185);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 400px;
        }

        .form-signin i {
            color: #D8BFD8;
        }

        .form-floating input:focus {
            border-color: #D8BFD8 !important;
            box-shadow: 0 0 0 0.25rem rgb(216, 191, 216) !important;
        }


        .btn-login {
            background-color: #D8BFD8 !important;
            border-color: #D8BFD8 !important;
            color: #fff !important;
        }

        .btn-login:hover {
            background-color: #D8BFD8 !important;
        }

        .btn-login:active,
        .btn-login:focus {
            background-color: #D8BFD8 !important;
            border-color: #D8BFD8 !important;
            color: #D8BFD8 !important;
        }

        body {
            background-color: #f8f9fa;
        }

        #grad1 {
            background-color: red;
            background-image: linear-gradient(to bottom right, #D8BFD8, #FFDAB9);
            padding: 20px;
            border-radius: 10px;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary text-center" id="grad1">

    <main class="form-signin w-100 m-auto">
        <form class="needs-validation" novalidate action="proses/proses_login.php" method="POST">
            <iconify-icon icon="fluent-emoji:bank" width="64" height="64"></iconify-icon>
            <h1 class="h3 mb-3 fw-normal">TabungKu</h1>

            <div class="form-floating">
                <input name="username" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
                <div class="invalid-feedback">
                    Masukkan email yang valid.
                </div>
            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
                <div class="invalid-feedback">
                    Masukkan Password.
                </div>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg" type="submit" name="submit_validate" value="acd" style="background-color:rgb(216, 191, 216)">Login</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2022 - <?php echo date("Y") ?></p>
            <p>admin@guru.com = password</p>
            <p>guru@guru.com = password</p>
            <p>wali1@murid.com = password</p>
        </form>
    </main>

    

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
</body>

</html>