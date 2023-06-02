<?= $this->extend('User/layout/layout') ?>
<?= $this->Section('content') ?>
<?= $this->include('/auth/tanggal') ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title ?></h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="content">
                <div class="card card-outline card-warning">
                    <form action="<?= site_url('ReportFormMaintenance') ?>" method="GET" accept-charset="utf-8">
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
                ?>
                    <div class="card card-outline card-warning">
                        <div class="card-header">
                            <a href="<?= site_url('PrintRpt_Maintenance/' . $cari) ?>" target="_blank" class="fa-pull-right btn btn-success btn-sm"><i class="fas fa-print"></i> Print</a>
                        </div>
                        <label class="mt-5" style="font-size: 22px;">
                            <center>FORM MAINTENANCE STORE</center>
                        </label>
                        <div class="col-sm-12 p-3">
                            <div class="col-sm-3">
                                <label style="width: 200px;"> Nama Store </label>
                                <label style="width: 10px;">:</label>
                                <label><?= $cari ?></label>
                            </div>
                            <div class="col-sm-3">
                                <label style="width: 200px;"> Tanggal Maintenance </label>
                                <label style="width: 10px;">:</label>
                                <label><?= tgl_indo(date('Y-m-d')); ?></label>
                            </div>
                            <div class="col-sm-3 mb-4">
                                <label style="width: 200px;"> Technical Support </label>
                                <label style="width: 10px;">:</label>
                                <label><?= session('nama_user') ?></label>
                            </div>

                            <div class="table-responsive p-0">
                                <table class="table table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="text-align:center">Kategori</th>
                                            <th style="text-align:center">Nama Perangkat</th>
                                            <th style="text-align:center">Merk</th>
                                            <th style="text-align:center">Serial Number</th>
                                            <th style="text-align:center">Tahun Perangkat</th>
                                            <th style="text-align:center">Usia Perangkat</th>
                                            <th style="text-align:center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // dd(base_url() . 'Database/koneksi.php');
                                        require_once ($_SERVER['DOCUMENT_ROOT']) . '/app/app/Database/koneksi.php';
                                        $query = mysqli_query($conn, "SELECT * FROM data_aset WHERE nik_user = $_SESSION[nik_user] AND nama_store = '$cari' ORDER BY kategori");
                                        $arr = array();
                                        while ($row  = mysqli_fetch_object($query)) {
                                            $arr[$row->kategori][] = $row;
                                        }
                                        ?>
                                        <?php foreach ($arr as $key => $val) : ?>
                                            <?php foreach ($val as $k => $v) : ?>
                                                <tr>
                                                    <?php if ($k == 0) : ?>
                                                        <td style="vertical-align: middle; text-align: center;" rowspan="<?= count($val) ?>">
                                                            <label><?= $v->kategori ?></label>
                                                        </td>
                                                    <?php endif ?>
                                                    <td><?= strtoupper($v->perangkat) ?></td>
                                                    <td><?= strtoupper($v->merk) ?></td>
                                                    <td><?= strtoupper($v->sn) ?></td>
                                                    <td style="text-align: center;"><?= $v->tahun != 0 ? "$v->tahun" : '-' ?></td>
                                                    <td style="text-align: center;"><?= $v->tahun != 0 ? " " . date('Y') -  $v->tahun . "  Tahun" : "Tahun Tidak Diketahui" ?></td>
                                                    <?php if ($v->status == 1) {
                                                        echo
                                                        "<td style='text-align: center;'><i style='font-size:16px; color:green;' class='fas fa-check-circle' data-bs-toggle='tooltip' title='Baik'></i></td>";
                                                    }
                                                    if ($v->status == 3) {
                                                        echo
                                                        "<td style='text-align: center;'><i style='font-size:16px; color:orange;' class='fas fa-exclamation-circle' title='Rekomendasi'></i></td>";
                                                    }
                                                    if ($v->status == 2) {
                                                        echo
                                                        "<td style='text-align: center;'><i style='font-size:16px; color:red;' class='fas fa-ban' title='Rusak'></i></td>";
                                                    }
                                                    ?>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Catatan :</label>
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label style="margin-top: 50px;"> Mengetahui,</label>
                                <br>
                                <label style="margin-top: 60px;"> PIC Store</label>
                                <div style="font-size: 12px; color: red;">*Stampel</div>
                            </div>
                            <footer class="card-footer">
                                <div class="d-none d-sm-inline-block">
                                    <b>Note : <br>
                                        <i class="fas fa-check-circle" style="color: green;">&nbsp;Baik</i></b> &nbsp;
                                    <b><i class="fas fa-exclamation-circle" style="color: orange;">&nbsp;Rekomendasi Penggantian</i></b>&nbsp;
                                    <b><i class="fas fa-ban" style="color: red;">&nbsp;Rusak</i></b>
                                </div>
                            </footer>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>