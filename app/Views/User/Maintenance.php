<?= $this->extend('User/layout/layout') ?>
<?= $this->Section('content') ?>

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
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="callout callout-warning">
                <h5><i class="fas fa-info-circle"></i> Informasi</h5>
                <p>Hanya dapat diisi dengan angka dan huruf</p>
            </div>
            <div class="content">
                <div class="data-perangkat" data-perangkat="<?= session()->getFlashdata('success') ?>">
                    <?php if (session()->getFlashdata('success')) : ?>
                    <?php endif; ?>
                </div>
                <div class="card card-outline card-warning">
                    <form action="<?= site_url('Maintenance') ?>" method="GET" accept-charset="utf-8">
                        <div class="col-sm-12 p-4">
                            <label for="Store">Pilih Store</label>
                            <div class="form-group">
                                <select class="form-control select2" name="cari_store" onchange="this.form.submit()">
                                    <option selected="selected"><?= (isset($_GET['cari_store']) ? "$_GET[cari_store]" : 'Pilih Store'); ?></option>
                                    <?php foreach ($store as $data) :  ?>
                                        <option data-select2 value="<?= $data['nama_store'] ?>">HokBen <?= ucwords($data['nama_store']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <?php
                if (isset($_GET['cari_store'])) {
                    $cari = $_GET['cari_store'];
                ?>
                    <?php
                    $this->db = \Config\Database::connect();
                    $data = $this->db->table('cctv_network')->where('nama_store', $cari);
                    $hasil = $data->get()->getResultArray();
                    ?>
                    <?php foreach ($hasil as $key => $ds) : ?>
                        <form action="<?= site_url('SaveCctv/' . $ds['code_store']) ?>" class="form-horizontal" method="POST">
                            <?= csrf_field() ?>
                            <div class="card card-outline card-warning">
                                <div class="card-header">
                                    <h3 class="card-title"><b><?= $ds['kategori'] ?> & <?= $ds['kategori1'] ?> <?= ucwords($ds['nama_store']) ?></b></h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php
                                $this->db = \Config\Database::connect();
                                $data = $this->db->table('cctv_network')->where(['code_store' => $ds['code_store']]);
                                $hasil = $data->get()->getResultArray();
                                ?>
                                <div class="card-body">
                                    <?php foreach ($hasil as $key => $data)  ?>
                                    <input type="hidden" class="form-control" name="code_store" value="<?= $data['code_store'] ?>">
                                    <input type="hidden" class="form-control" name="nik_user" value="<?= session('nik_user') ?>">
                                    <input type="hidden" class="form-control" name="nama_store" value="<?= $data['nama_store'] ?>">
                                    <input type="hidden" class="form-control" name="nama_user" value="<?= session('nama_user') ?>">
                                    <div class="fom-group row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="kategori" value="<?= $data['kategori'] ?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="kategori">DVR / NVR</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="dvr" pattern="[A-Za-Z0-9- ]{0,100}" value="<?= $data['dvr'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="kategori">Monitor</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="monitor" pattern="[A-Za-Z0-9- ]{0,100}" value="<?= $data['monitor']  ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="kategori">UPS</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="ups" pattern="[A-Za-Z0-9- ]{4}" value="<?= $data['ups'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="kategori">Jenis Kamera</label>
                                                <div class="form-group">
                                                    <select class="form-control select2" name="tipe">
                                                        <option selected="selected"><?= $data['tipe'] ? "$data[tipe]" : ''; ?></option>
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
                                                    <input type="text" class="form-control" name="jumlah" pattern="[0-9]{1,4}" value="<?= $data['jumlah'] ?>">
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
                                                        <option selected="selected"><?= $data['sdwan'] ? "$data[sdwan]" : ''; ?></option>
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
                                                        <option selected="selected"><?= $data['wifi'] ? "$data[wifi]" : ''; ?></option>
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
                                                    <input type="text" class="form-control" name="phone" value="<?= $data['phone'] ?>">
                                                    <input type="hidden" class="form-control" name="status" value="1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="<?= site_url('Maintenance') ?>" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    <?php endforeach; ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>