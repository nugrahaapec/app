<!DOCTYPE html>
<html lang="en">
<?= $this->include('auth/tanggal') ?>

<head>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content='#fab816' name='theme-color' />
        <meta content='#fab816' name='msapplication-navbutton-color' />
        <meta content='yes' name='apple-mobile-web-app-capable' />
        <meta content='#fab816' name='apple-mobile-web-app-status-bar-style' />
        <meta name="description" content="Technical Support System">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
        <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
        <link rel="icon" href="<?= base_url() ?>/img/logo.png">
    </head>
</head>

<body class="login-page" style="min-height: 466px;">
    <div class="login-box">
        <?php if (session()->getFlashdata('logout')) : ?>
            <div class="alert alert-primary alert-dismissible">
                <h5><i class="icon fas fa-info"></i> Log Out.</h5>
                <?= session()->getFlashdata('logout') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Gagal</h5>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="card card-outline card-warning">
            <div class="card-header text-center">
                <img src="<?= base_url() ?>/img/logo.png" width="150px" class="mt-2 mb-3">
                <h3>
                    <b>Technical Support</b> System
                </h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('Auth/loginProses') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="user" placeholder="Email Atau Username" autofocus value="<?= old('user'); ?>">
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" name="pass" placeholder="Password">
                    </div>
                    <div class="row mb-5">
                        <div class="col-md">
                            <button type="submit" class="btn btn-warning btn-block"><b>Sign In</b></button>
                        </div>
                    </div>
                </form>
                <center style="font-size: 14px;"> <b><?= tgl_indo(date('Y-m-d')); ?></b></center>
            </div>
        </div>
    </div>
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>

</body>

</html>