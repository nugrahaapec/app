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
                <div class="data-perangkat" data-perangkat="<?= session()->getFlashdata('maintenance') ?>">
                    <?php if (session()->getFlashdata('maintenance')) : ?>
                    <?php endif; ?>
                </div>
                <div class="card card-outline card-warning">
                    <form action="<?= site_url('FormMaintenance') ?>" method="GET" accept-charset="utf-8">
                        <div class="col-sm-12 p-4">
                            <label for="Store">Pilih Store</label>
                            <div class="form-group">
                                <select class="form-control select2" name="cari_store" onchange="this.form.submit()">
                                    <option selected="selected"><?= (isset($_GET['cari_store']) ? "$_GET[cari_store]" : 'Pilih Store'); ?></option>
                                    <?php foreach ($store as $data) :  ?>
                                        <option data-select2 value="<?= ucwords($data['nama_store']) ?>">HokBen <?= ucwords($data['nama_store']) ?></option>
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
                    <form action="<?= site_url('SaveMaintenance/' . $data['code_store']) ?>" class="form-horizontal" method="POST">
                        <?= csrf_field() ?>
                        <?php
                        $this->db = \Config\Database::connect();
                        $data = $this->db->table('data_aset')->where(['nama_store' => $cari, 'status !=' => 2])->orderby('kategori')->groupby('kategori');
                        $hasil = $data->get()->getResultArray();
                        ?>
                        <?php foreach ($hasil as $key => $ds) : ?>
                            <div class="card card-outline card-warning collapsed-card">
                                <div class="card-header">
                                    <h3 class="card-title"><b><?= $ds['kategori'] ? "$ds[kategori]" : '' ?> </b></h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php
                                $this->db = \Config\Database::connect();
                                $data = $this->db->table('data_aset')->where(['code_store' => $ds['code_store'], 'kategori' => $ds['kategori'], 'status !=' => 2]);
                                $hasil = $data->get()->getResultArray();
                                ?>

                                <div class="card-body">
                                    <?php foreach ($hasil as $key => $data) : ?>
                                        <input type="hidden" class="form-control" name="code_store" value="<?= $data['code_store'] ?>">
                                        <input type="hidden" class="form-control" name="nik_user" value="<?= session('nik_user') ?>">
                                        <input type="hidden" class="form-control" name="nama_store" value="<?= $data['nama_store'] ?>">
                                        <input type="hidden" class="form-control" name="nama_user" value="<?= session('nama_user') ?>">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="perangkat"> Kategori</label>
                                                    <input type="text" class="form-control" name="kategori[]" value="<?= ucwords($data['kategori']) ?>" readonly>
                                                    <input type="hidden" class="form-control" name="id_data[]" value="<?= $data['id_data'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="perangkat"> Perangkat</label>
                                                    <input type="text" class="form-control" name="perangkat[]" value="<?= ucwords($data['perangkat']) ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="perangkat"> Merk</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="merk[]" value="<?= ucwords($data['merk']) ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="perangkat"> Tahun Perangkat</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="tahun[]" maxlength="4" pattern="[0-9]{4}" value="<?= strtoupper($data['tahun']) ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="perangkat"> Serial Number</label>
                                                    <input type="text" class="form-control" name="sn[]" pattern="[a-zA-Z0-9]{1,100}" value="<?= strtoupper($data['sn']) ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="perangkat"> Status</label>
                                                <select class="form-control select2" name="status[]">
                                                    <?php if ($data['status'] == 1) {
                                                        echo "
                                                        <option selected='selected' value='1'>Baik</option>";
                                                    } elseif ($data['status'] == 2) {
                                                        echo "
                                                        <option selected='selected' value='2'>Rusak</option>";
                                                    } elseif ($data['status'] == 3) {
                                                        echo "
                                                        <option selected='selected' value='3'>Rekomendasi Penggantian</option>";
                                                    }
                                                    ?>
                                                    <option value="1">Baik</option>
                                                    <option value="2">Rusak</option>
                                                    <option value="3">Rekomendasi Penggantian</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="<?= site_url('FormMaintenance') ?> " class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>