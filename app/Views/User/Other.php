<?= $this->extend('User/layout/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1><?= $title ?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="data-perangkat" data-perangkat="<?= session()->getFlashdata('success') ?>">
            <?php if (session()->getFlashdata('success')) : ?>
            <?php endif; ?>
        </div>
        <div class="data-error" data-error="<?= session()->getFlashdata('error') ?>">
            <?php if (session()->getFlashdata('error')) : ?>
            <?php endif; ?>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="callout callout-warning">
                        <h5><i class="fas fa-info-circle"></i> Informasi</h5>
                        <p>Hanya dapat diisi dengan angka dan huruf</p>
                    </div>
                    <div class="card card-outline card-warning">
                        <div class="card-body">
                            <form action="" method="GET" accept-charset="utf-8">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Pilih Store</label>
                                            <select class="form-control" name="cari_store" onchange="this.form.submit()">
                                                <option selected="selected"><?= (isset($_GET['cari_store']) ? "$_GET[cari_store]" : 'Pilih Store'); ?></option>
                                                <?php foreach ($hasil as $data) :  ?>
                                                    <option data-selecte2 value="<?= ucwords($data['nama_store']) ?>">HokBen <?= ucwords($data['nama_store']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <?php
                            if (isset($_GET['cari_store'])) {
                                $cari = $_GET['cari_store'];

                            ?>
                                <form action="<?= site_url('SaveOther') ?>" class="form-horizontal" method="POST">
                                    <?= csrf_field() ?>
                                    <?php
                                    $db = \Config\Database::connect();
                                    $query = "SELECT * FROM store WHERE nama_store = '$cari'";
                                    $hasil = $db->query($query)->getRowArray();
                                    ?>
                                    <input type="hidden" class="form-control" name="code_store" value="<?= $hasil['code_store'] ?>">
                                    <input type="hidden" class="form-control" name="nama_store" value="<?= $hasil['nama_store'] ?>">
                                    <input type="hidden" class="form-control" name="nik_user" value="<?= session('nik_user') ?>">
                                    <input type="hidden" class="form-control" name="nama_user" value="<?= session('nama_user') ?>">
                                    <input type="hidden" class="form-control" name="status" value="1">

                                    <div class="fom-group row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="kategori" value="CCTV" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="kategori">DVR / NVR</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="dvr" pattern="^[a-zA-Z0-9_- ]{1,100}$" placeholder="Masukan Merk - SN DVR / NVR">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="kategori">Monitor</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="monitor" pattern="^[a-zA-Z0-9_- ]{1,100}$" placeholder="Masukan Merk - SN Monitor">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="kategori">UPS</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="ups" pattern="^[a-zA-Z0-9_- ]{1,100}$" placeholder="Masukan Merk - SN UPS">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="kategori">Jenis Kamera</label>
                                                <div class="form-group">
                                                    <select class="form-control select2" name="tipe">
                                                        <option>Analog</option>
                                                        <option>IP Camera</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="kategori">Jumlah Kamera</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="jumlah" pattern="[0-9]{1,4}" placeholder="Masukan Jumlah kamera">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="fom-group row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="kategori1" value="Network" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="sdwan">SDWAN</label>
                                                <div class="form-group">
                                                    <select class="form-control select2" name="sdwan">
                                                        <option>Ada</option>
                                                        <option>Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="wifi">Wifi</label>
                                                <div class="form-group">
                                                    <select class="form-control select2" name="wifi">
                                                        <option>Lobby</option>
                                                        <option>Office</option>
                                                        <option>Office & Lobby</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="kategori">IP Phone</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="phone" pattern="^[a-zA-Z0-9_- ]{1,100}$" placeholder="Masukan Merk - SN IP Phone">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-5">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="<?= site_url('Other') ?>" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endsection() ?>