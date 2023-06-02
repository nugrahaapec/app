<?= $this->extend('staff/layout/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('/auth/tanggal.php');  ?>


<div class="data-error" data-error="<?= session()->getFlashdata('error') ?>">
    <?php if (session()->getFlashdata('error')) : ?>
    <?php endif; ?>
</div>
<div class="content-wrapper">
    <div class="content-header">
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-warning">
                        <div class="card-header">
                            <h1 class="m-0"><?= $title ?></h1>
                        </div>
                        <div class="card-body">
                            <?php foreach ($result as $data)  ?>
                            <form action="<?= site_url('ProsesPermintaanStore/' . $data['code_permintaan']) ?>" method="POST">
                                <?= csrf_field() ?>
                                <input type="hidden" class="form-control" name="code_store" value="<?= $data['code_store'] ?>">
                                <input type="hidden" class="form-control" name="nik_user" value="<?= $data['nik_user'] ?>">
                                <input type="hidden" class="form-control" name="code_permintaan" value="<?= $data['code_permintaan'] ?>">
                                <input type="hidden" class="form-control" name="approved" value="<?= session('nama_user') ?>">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Kode Permintaan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="<?= $data['code_permintaan'] ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tanggal Permintaan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="<?= tgl_indo($data['tanggal_permintaan']) ?>" readonly>
                                            <input type="hidden" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nama Store</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="up1" name="nama_store" value="<?= $data['nama_store'] ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Technical Support</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_user" value="<?= $data['nama_user'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Masukan Nomor DO</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="up" onchange="upperCase()" name="no_do" pattern="[a-zA-Z0-9/-]{1,100}" value="<?= old('no_do') ?>" required>
                                        </div>
                                    </div>
                                    <?php foreach ($result as $data) : ?>
                                        <div class=" form-group row">
                                            <div class="col-sm mt-3">
                                                <label>Lokasi</label>
                                                <input type="text" class="form-control" name="kategori[]" pattern="[a-zA-Z0-9 ]{1,100}" value="<?= strtoupper($data['kategori']) ?>" readonly>
                                            </div>
                                            <div class="col-sm mt-3">
                                                <label>Nama Perangkat</label>
                                                <input type="text" class="form-control" name="perangkat[]" pattern="[a-zA-Z0-9 ]{1,100}" value="<?= strtoupper($data['nama_perangkat']) ?>" required>
                                            </div>
                                            <div class="col-sm mt-3">
                                                <label>Merk</label>
                                                <input type="text" class="form-control" name="merk[]" pattern="[a-zA-Z0-9/-]{1,100}" value="<?= strtoupper($data['merk']) ?>" required>
                                            </div>
                                            <div class="col-sm mt-3">
                                                <label>Serial Number</label>
                                                <input type="text" class="form-control" id="sn" name="sn[]" pattern="[a-zA-Z0-9/-]{1,100}" value="<?= strtoupper($data['sn']) ?>" required>
                                                <div id="result"></div>
                                            </div>
                                            <div class="col-sm mt-3">
                                                <label>Tahun </label>
                                                <input type="text" class="form-control" name="tahun[]" pattern="[0-9]{4}" maxlength="4" placeholder="Masukkan Tahun" value="<?= date('Y') ?>" readonly required>
                                            </div>
                                            <div class="col-sm mt-3">
                                                <label>Keterangan</label>
                                                <input type="text" class="form-control" name="keterangan[]" pattern="[a-zA-Z0-9/- ]{1,100}" placeholder="Masukkan Tahun" value="<?= ucwords($data['keterangan']) ?>" required>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Proses</button>
                                        <a href="<?= site_url('Proses') ?>" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- </div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#sn").keyup(function() {
            var sn = $("#sn").val();
            if (sn != '') {
                $("#result").show();
                $.ajax({
                    url: '/app/public/cekSN/',
                    method: 'get',
                    data: {
                        sn: sn
                    },
                    success: function(response) {
                        if (sn > 0) {
                            $("#result").html("<span class='exists'>Available.</span>");
                        } else {
                            $("#result").html("<span class='not-exists'>* Username Already in use.</span>");
                        }
                    }
                });
            } else {
                $("#result").hide();
            }
        });
    });
</script> -->
    <?= $this->endSection() ?>