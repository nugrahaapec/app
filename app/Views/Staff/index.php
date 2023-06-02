<?= $this->extend('Staff/layout/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title ?></h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-sm">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $data ?></h3>
                        <p>Permintaan Perangkat Baru</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-laptop-house"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= $proses ?></h3>
                        <p>Proses Permintaan </p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $kirim ?></h3>
                        <p>Permintaan Terkirim</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>