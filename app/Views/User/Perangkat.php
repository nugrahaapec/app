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
            <div class="content">
                <div class="data-perangkat" data-perangkat="<?= session()->getFlashdata('success') ?>">
                    <?php if (session()->getFlashdata('success')) : ?>
                    <?php endif; ?>
                </div>
                <div class="callout callout-warning">
                    <h5><i class="fas fa-info-circle"></i> Informasi</h5>
                    <p>Hanya dapat diisi dengan angka dan huruf</p>
                </div>
                <div class="card card-outline card-warning">
                    <form action="<?= site_url('Perangkat') ?>" method="GET" accept-charset="utf-8">
                        <div class="col-sm-12 p-4">
                            <label for="Store">Pilih Store</label>
                            <div class="form-group">
                                <select class="form-control select2" name="cari_store" onchange="this.form.submit()">
                                    <option selected="selected"><?= (isset($_GET['cari_store']) ? "$_GET[cari_store]" : 'Pilih Store'); ?></option>
                                    <?php foreach ($hasil as $data) :  ?>
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

                    <form action="<?= site_url('SavePerangkat') ?>" class="form-horizontal" method="POST">
                        <?= csrf_field() ?>
                        <?php
                        $db = \Config\Database::connect();
                        $query = "SELECT * FROM store WHERE nama_store = '$cari'";
                        $hasil = $db->query($query)->getRowArray();
                        ?>
                        <div class="card card-outline card-warning">
                            <div class="card-header">
                                <label>Input Data Perangkat Store HokBen <?= ucwords($hasil['nama_store']) ?></label>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <input type="hidden" class="form-control" name="code_store" value="<?= $hasil['code_store'] ?>">
                            <input type="hidden" class="form-control" name="nik_user" value="<?= session('nik_user') ?>">
                            <input type="hidden" class="form-control" name="nama_store" value="<?= $hasil['nama_store'] ?>">
                            <input type="hidden" class="form-control" name="nama_user" value="<?= session('nama_user') ?>">
                            <input type="hidden" class="form-control" name="status" value="1">
                            <div class="card-body">
                                <div class="form-group row add-more">
                                    <div class="col-sm-2 mt-2">
                                        <label for="kategori">Kategori</label>
                                        <select class="form-control select2" name="kategori[]">
                                            <option>Pos 1</option>
                                            <option>Pos 2</option>
                                            <option>Pos 3</option>
                                            <option>Pos 4</option>
                                            <option>Pos Booth</option>
                                            <option>Pos 7</option>
                                            <option>Back Office</option>
                                            <option>OSDS</option>
                                            <option>New Counter</option>
                                            <option>Drive Thru</option>
                                            <option>Drive IN</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 mt-2">
                                        <label for="perangkat">Perangkat</label>
                                        <select class="form-control select2" name="perangkat[]">
                                            <?php foreach ($dataperangkat as $d) : ?>
                                                <option><?= $d['nama_perangkat'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 mt-2">
                                        <label for="merk">Merk</label>
                                        <input type="text" class="form-control" name="merk[]" pattern="[a-zA-Z0-9]{1,100}" placeholder="Masukkan Merk Perangkat" required>
                                    </div>
                                    <div class="col-sm-2 mt-2">
                                        <label for="sn">Serial Number</label>
                                        <input type="text" class="form-control" name="sn[]" pattern="[a-zA-Z0-9]{1,100}" placeholder="Masukkan Serial Number" required>
                                    </div>
                                    <div class="col-sm-2 mt-2">
                                        <label for="Tahun">Tahun</label>
                                        <input type="text" class="form-control" name="tahun[]" pattern="[0-9]{4}" maxlength="4" placeholder="Masukkan Tahun" required>
                                    </div>
                                    <div class="col-sm-2 mt-2">
                                        <label for="tambah">Tambah</label>
                                        <br>
                                        <button type="button" class="btn btn-info add"><i class="fas fa-plus"></i> Tambah</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="<?= site_url('PermintaanPerangkat') ?>" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<div class="copy collapse">
    <div class="form-group row">
        <div class="col-sm-2 mt-2">
            <label for="kategori">Kategori</label>
            <select class="form-control select2" name="kategori[]">
                <option>Pos 1</option>
                <option>Pos 2</option>
                <option>Pos 3</option>
                <option>Pos 4</option>
                <option>Pos Booth</option>
                <option>Pos 7</option>
                <option>Back Office</option>
                <option>OSDS</option>
                <option>New Counter</option>
                <option>Drive Thru</option>
                <option>Drive IN</option>
            </select>
        </div>
        <div class="col-sm-2 mt-2">
            <label for="perangkat">Perangkat</label>
            <select class="form-control select2" name="perangkat[]">
                <?php foreach ($dataperangkat as $d) : ?>
                    <option><?= $d['nama_perangkat'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-sm-2 mt-2">
            <label for="merk">Merk</label>
            <input type="text" class="form-control" name="merk[]" placeholder="Masukkan Merk Perangkat" required>
        </div>
        <div class="col-sm-2 mt-2">
            <label for="sn">Serial Number</label>
            <input type="text" class="form-control" name="sn[]" placeholder="Masukkan Serial Number" required>
        </div>
        <div class="col-sm-2 mt-2">
            <label for="tahun">Tahun</label>
            <input type="text" class="form-control" name="tahun[]" placeholder="Masukkan Tahun" required>
        </div>
        <div class="col-sm-2 mt-2">
            <div class="form-group">
                <label for="hapus">Hapus</label>
                <br>
                <button class="btn btn-danger remove" type="button"><i class="fas fa-times"></i> Hapus</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>