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
                            <a href="<?= site_url('User') ?>" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" data-toggle="modal" data-target="#addStore" class="nav-link">
                                <i class="nav-icon fas fa-store"></i>
                                <p>
                                    Add Store
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= site_url('Status') ?>" class="nav-link">
                                <i class="nav-icon fas fa-list-ol"></i>
                                <p>
                                    Status Perangkat
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= site_url('Konfirmasi') ?>" class="nav-link">
                                <i class="nav-icon fas fa-check-circle"></i>
                                <p>
                                    Konfirmasi
                                    <?php
                                    $db = \Config\Database::connect();
                                    $data = $db->table('tbl_permintaan');
                                    $dataq = $db->table('tbl_newpermintaan');
                                    $hasil = $data->distinct('code_permintaan')->select('code_permintaan')->where('status', 2)->where('nik_user', session('nik_user'))->CountAllResults();
                                    $hasil1 = $dataq->distinct('code_permintaan')->select('code_permintaan')->where('status', 2)->where('nik_user', session('nik_user'))->CountAllResults();
                                    ?>
                                    <?= $hasil || $hasil1 != 0 ? "<sup class='right badge badge-info'> New </sup>" : "" ?>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= site_url('Perangkat') ?>" class="nav-link">
                                <i class="nav-icon fas fa-desktop"></i>
                                <p>
                                    Data Perangkat
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= site_url('Other') ?>" class="nav-link">
                                <i class="nav-icon fas fa-project-diagram"></i>
                                <p>
                                    Data CCTV & Network
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Form Maintenance
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('FormMaintenance') ?>" class="nav-link">
                                        <i class="fas fa-desktop nav-icon"></i>
                                        <p>Perangkat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('Maintenance') ?>" class="nav-link">
                                        <i class="fas fa-network-wired nav-icon"></i>
                                        <p>CCTV & Network</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-window-restore"></i>
                                <p>
                                    Report
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('ReportFormMaintenance') ?>" class="nav-link">
                                        <i class="nav-icon fas fa-file"></i>
                                        <p>Cetak Form Maintenance</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('ReportPermintaan') ?>" class="nav-link">
                                        <i class="nav-icon fas fa-file"></i>
                                        <p>History Permintaan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Permintaan Perangkat
                                </p>
                                <i class="fas fa-angle-left right"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('PermintaanNewStore') ?>" class="nav-link">
                                        <i class="nav-icon fas fa-file"></i>
                                        <p>New Store</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('PermintaanPerangkat') ?>" class="nav-link">
                                        <i class="nav-icon fas fa-file"></i>
                                        <p>Existing Store</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('EditProfile/' . session("nik_user") . '') ?>" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Edit Profile
                                </p>
                            </a>
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

        <div class="modal fade" id="addStore" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Store</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="<?= site_url('addStore') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="put">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" class="form-control" name="nik_user" value="<?= session('nik_user') ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Technical Support</label>
                                    <input type="text" class="form-control" name="nama_user" value="<?= session('nama_user') ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Kode Store</label>
                                    <input type="text" class="form-control" name="code_store" pattern="[a-zA-Z0-9]{1,5}" placeholder="Masukan Kode Store" value="<?= old('code_store') ?>" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Nama Store</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">HokBen</span>
                                        <input type="text" class="form-control" name="nama_store" pattern="[a-zA-Z0-9 ]{1,100}" placeholder="Masukan Nama Store" value="<?= old('nama_store') ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <select class="form-control select2" name="lokasi">
                                        <option value="0">----Pilih Lokasi----</option>
                                        <option value="1">Jabodetabek</option>
                                        <option value="2">Luar Jabodetabek</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="<?= base_url() ?>/plugins/toastr/toastr.min.js"></script>
        <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
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
        <script src="<?= base_url() ?>/dist//js/custome.js"></script>
        <script src="<?= base_url() ?>/dist//js/swal.js"></script>
        <script src="<?= base_url() ?>/dist//sweetalert/sweetalert2.all.min.js"></script>
        <script src="<?= base_url() ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

</body>

</html>