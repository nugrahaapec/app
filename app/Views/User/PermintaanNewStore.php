<?= $this->extend('User/layout/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('/auth/tanggal.php'); ?>


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
                <div class="card card-outline card-warning">
                    <form action="<?= site_url('PermintaanNewStore') ?>" method="GET" accept-charset="utf-8">
                        <div class="col-sm-12 p-3">
                            <div class="form-group">
                                <select class="form-control select2" name="cari_store" onchange="this.form.submit()">
                                    <option selected="selected"><?= (isset($_GET['cari_store']) ? "$_GET[cari_store]" : 'Pilih Store'); ?></option>
                                    <?php foreach ($hasil as $data) :  ?>
                                        <option data-selecte2 value="<?= ucwords($data['nama_store']) ?>">HokBen <?= ucwords($data['nama_store']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <?php
                if (isset($_GET['cari_store'])) {
                    $cari = $_GET['cari_store'];
                    function getCode($length)
                    {
                        $str        = "";
                        $characters = '0123456789';
                        $max        = strlen($characters) - 1;
                        for ($i = 0; $i < $length; $i++) {
                            $rand = mt_rand(0, $max);
                            $str .= $characters[$rand];
                        }
                        return $str;
                    }
                ?>
                    <form action="<?= site_url('SaveNewPermintaan') ?>" class="form-horizontal" method="POST">
                        <?= csrf_field() ?>
                        <?php
                        $db = \Config\Database::connect();
                        $query = "SELECT * FROM store WHERE nama_store = '$cari'";
                        $hasil = $db->query($query)->getRowArray();
                        ?>
                        <div class="card card-outline card-warning">
                            <div class="card-header">
                                <label>Perangkat New Store HokBen <?= ucwords($hasil['nama_store']) ?></label>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="code_store" value="<?= $hasil['code_store'] ?>">
                            <input type="hidden" class="form-control" name="nik_user" value="<?= session('nik_user') ?>">
                            <input type="hidden" class="form-control" name="status" value="1">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kode Permintaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="code_permintaan" value="<?= getCode(15); ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Permintaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= tgl_indo(date('Y-m-d')) ?>" readonly>
                                        <input type="hidden" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Store</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_store" value="<?= $hasil['nama_store'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Technical Support</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_user" value="<?= $hasil['nama_user'] ?>" readonly>
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row add-more">
                                    <div class="col-sm-2 mt-2">
                                        <label for="loaksi">Lokasi</label>
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
                                                <option value="<?= $d['id_perangkat'] ?>"><?= $d['nama_perangkat'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 mt-2">
                                        <label for="merk">Merk</label>
                                        <input type="text" class="form-control" name="merk[]" pattern="[a-zA-Z0-9]{1,100}" placeholder="Masukkan Merk Perangkat" required>
                                    </div>
                                    <div class="col-sm-2 mt-2">
                                        <label for="serial number">Serial Number</label>
                                        <input type="text" class="form-control" name="sn[]" pattern="[a-zA-Z0-9]{1,100}" placeholder="Masukkan Serial Number" required>
                                    </div>
                                    <div class="col-sm-2 mt-2">
                                        <label for="serial number">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan[]" pattern="[a-zA-Z0-9 ]{1,100}" placeholder="Masukkan Keterangan" required>
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
            <label for="loaksi">Lokasi</label>
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
                    <option value="<?= $d['id_perangkat'] ?>"><?= $d['nama_perangkat'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-sm-2 mt-2">
            <label for="merk">Merk</label>
            <input type="text" class="form-control" name="merk[]" pattern="[a-zA-Z0-9]{1,100}" placeholder="Masukkan Merk Perangkat" required>
        </div>
        <div class="col-sm-2 mt-2">
            <label for="serial number">Serial Number</label>
            <input type="text" class="form-control" name="sn[]" pattern="[a-zA-Z0-9]{1,100}" placeholder="Masukkan Serial Number" required>
        </div>
        <div class="col-sm-2 mt-2">
            <label for="serial number">Keterangan</label>
            <input type="text" class="form-control" name="keterangan[]" pattern="[a-zA-Z0-9 ]{1,100}" placeholder="Masukkan Keterangan" required>
        </div>
        <div class="col-sm-2 mt-2">
            <label for="hapus">Hapus</label>
            <br>
            <div class="form-group">
                <button class="btn btn-danger remove" type="button"><i class="fas fa-times"></i> Hapus</button>
            </div>
        </div>
    </div>
</div>


<?= $this->endsection() ?>