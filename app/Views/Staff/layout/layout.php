<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='#fab816' name='theme-color' />
    <meta content='#fab816' name='msapplication-navbutton-color' />
    <meta content='yes' name='apple-mobile-web-app-capable' />
    <meta content='#fab816' name='apple-mobile-web-app-status-bar-style' />
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
    <link rel="icon" href="<?= base_url() ?>/img/logo.png">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url() ?>/img/logo.png" height="60" width="60">
        </div>

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-light-secondary elevation-4">
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url() ?>/img/logo.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info d-block">
                        <b><?= session('nama_user') ?></b>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-sidebar" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= site_url('Staff') ?>" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    <i class="fas fa-angle-left right"></i>
                                    Permintaan
                                    <?php
                                    $db = \Config\Database::connect();
                                    $data = $db->table('tbl_permintaan');
                                    $dataa = $db->table('tbl_newpermintaan');
                                    $hasil = $data->distinct('code_permintaan')->select('code_permintaan')->where('status', 1)->CountAllResults();
                                    $hasil1 = $dataa->distinct('code_permintaan')->select('code_permintaan')->where('status', 1)->CountAllResults();
                                    ?>
                                    <?= $hasil != 0 || $hasil1 != 0 ? "<span class='badge badge-info right'> New </span>" : "" ?>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('Proses') ?>" class="nav-link">
                                        <i class="nav-icon fas fa-file"></i>
                                        <p>
                                            Existing Store
                                            <?= $hasil != 0 ? "<span class='right badge badge-info'> " . $hasil . "</span>" : "" ?>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('NewProses') ?>" class="nav-link">
                                        <i class="nav-icon fas fa-file"></i>
                                        <p>New Store</p>
                                        <?= $hasil1 != 0 ? "<span class='right badge badge-info'> " . $hasil1 . "</span>" : "" ?>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-print"></i>
                                <p>
                                    <i class="fas fa-angle-left right"></i>
                                    Cetak DO
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('PrintDo') ?>" class="nav-link">
                                        <i class="nav-icon fas fa-file"></i>
                                        <p>
                                            Existing Store
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('NewPrint') ?>" class="nav-link">
                                        <i class="nav-icon fas fa-file"></i>
                                        <p>New Store</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    <i class="fas fa-angle-left right"></i>
                                    Laporan
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('Laporan') ?>" class="nav-link">
                                        <i class="nav-icon fas fa-file"></i>
                                        <p>
                                            Existing Store
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('LaporanNew') ?>" class="nav-link">
                                        <i class="nav-icon fas fa-file"></i>
                                        <p>New Store</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Sign Out
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <?= $this->renderSection('content') ?>


        <footer class="main-footer">
            <strong>Copyright &copy; ICT - Technical Support Store</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b><?= session('nama_user') ?></b>
            </div>
        </footer>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Sign Out</h5>
                    </div>
                    <div class="modal-body">
                        Anda Akan Keluar ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a href="<?= site_url('/logout') ?>" class="btn btn-primary">Sign Out</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="<?= base_url() ?>/plugins/toastr/toastr.min.js"></script>
        <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
        <script src="<?= base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url() ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url() ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>/plugins/jszip/jszip.min.js"></script>
        <script src="<?= base_url() ?>/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="<?= base_url() ?>/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="<?= base_url() ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="<?= base_url() ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="<?= base_url() ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script src="<?= base_url() ?>/plugins/toastr/toastr.min.js"></script>
        <script src="<?= base_url() ?>/dist/js/custome.js"></script>
        <script src="<?= base_url() ?>/dist/js/swal.js"></script>
        <script src="<?= base_url() ?>/dist/sweetalert/sweetalert2.all.min.js"></script>
        <script src="<?= base_url() ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
</body>

</html>

<?= $this->renderSection('content') ?>