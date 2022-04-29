<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= env('APP_NAME') ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= url('bootstrap-4.0.0-dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= url('font-awesome-4.7.0/css/font-awesome.min.css') ?>">

    <link rel="stylesheet" href="<?= url('DataTables_1/DataTables-1.11.5/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= url('DataTables_1/Buttons-2.2.2/css/buttons.bootstrap4.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= url('daterangepicker-master/daterangepicker.css') ?>" />


    <script src="<?= url('js-plugin/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= url('bootstrap-4.0.0-dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= url('js-plugin/knockout-3.5.1.js') ?>"></script>
    <script src="<?= url('js-loading-overlay-1.2.0/dist/js-loading-overlay.min.js') ?>"></script>



    <script src="<?= url('DataTables_1/datatables.min.js') ?>"></script>
    <script src="<?= url('DataTables_1/DataTables-1.11.5/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= url('DataTables_1/Buttons-2.2.2/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= url('DataTables_1/JSZip-2.5.0/jszip.min.js') ?>"></script>
    <script src="<?= url('DataTables_1/pdfmake-0.1.36/pdfmake.min.js') ?>"></script>
    <script src="<?= url('DataTables_1/pdfmake-0.1.36/vfs_fonts.js') ?>"></script>
    <script src="<?= url('DataTables_1/Buttons-2.2.2/js/buttons.html5.min.js') ?>"></script>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
    <script type="text/javascript" src="<?= url('daterangepicker-master/moment.min.js') ?>"></script>
    <script type="text/javascript" src="<?= url('daterangepicker-master/daterangepicker.js') ?>"></script>

</head>

<body>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#"><?= env('APP_NAME') ?></a>

        <!-- Links -->
        <ul class="navbar-nav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Peserta
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?=url('admin/kelompok_peserta')?>">Kelompok Peserta</a>
                        <a class="dropdown-item" href="<?=url('admin/daftar_peserta')?>">Daftar Peserta</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Kuis
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?=url('admin/kelompok_kuis')?>">Kelompok Kuis</a>
                        <a class="dropdown-item" href="<?=url('admin/daftar_kuis')?>">Daftar Kuis</a>
                    </div>
                </li>

            </ul>

        </ul>
        <ul class="navbar-nav ml-auto">
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    {{ ucwords( Session::get('username') ) }}
                </a>
                <div class="dropdown-menu" style="left: -80px;">
                    <!-- <a class="dropdown-item" href="#">Link 1</a> -->
                    <!-- <a class="dropdown-item" href="#">Link 2</a> -->
                    <a class="dropdown-item" href="<?= url('admin/logout') ?>">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2> <?= $title ?></h2>
                <?= $contents ?>
            </div>
        </div>
    </div>

</body>

</html>