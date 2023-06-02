<?= $this->extend('User/layout/layout') ?>
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

    <div class="data-perangkat" data-perangkat="<?= session()->getFlashdata('success') ?>">
        <?php if (session()->getFlashdata('success')) : ?>
        <?php endif; ?>
    </div>
    <div class="data-error" data-error="<?= session()->getFlashdata('error') ?>">
        <?php if (session()->getFlashdata('error')) : ?>
        <?php endif; ?>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-sm">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $lokasi1 ?></h3>
                        <p>Jumlah Store Jabodetabek</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-store"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $lokasi ?></h3>
                        <p>Jumlah Store Luar Jabodetabek</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-store"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $maintenance ?></h3>
                        <p>Total Maintenace Store Jabodetabek</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= $maintenance1 ?></h3>

                        <p>Belum Dimaintenance Store Jabodetabek</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $result  ? '' . round($maintenance / $result * 100) . '' : '0' ?><sup style="font-size: 20px;">%</sup></h3>
                        <p>Total Persentase Maintenance</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-percent"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <label>Store Board <?= session('nama_user') ?></label>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive p-0">
                                    <table class="table table-bordered">
                                        <thead class="bg-light">
                                            <tr>
                                                <th style="text-align:center">Nama Store</th>
                                                <th style="text-align:center">Kategori</th>
                                                <th style="text-align:center">Nama Perangkat</th>
                                                <th style="text-align:center">Merk</th>
                                                <th style="text-align:center">Serial Number</th>
                                                <th style="text-align:center">Tahun Perangkat</th>
                                                <th style="text-align:center">Usia Perangkat</th>
                                                <th style="text-align:center">Satus</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            require ($_SERVER['DOCUMENT_ROOT']) . '/app/app/Database/koneksi.php';

                                            $query = mysqli_query($conn, "SELECT * FROM data_aset WHERE nik_user = $_SESSION[nik_user] ORDER BY kategori");
                                            $arr = array();
                                            while ($row  = mysqli_fetch_object($query)) {
                                                $arr[$row->code_store][] = $row;
                                            }
                                            ?>
                                            <?php foreach ($arr as $key => $val) : ?>
                                                <?php foreach ($val as $k => $v) : ?>
                                                    <tr>
                                                        <?php if ($k == 0) : ?>
                                                            <td style="vertical-align: middle; text-align: center;" rowspan="<?= count($val) ?>">
                                                                <label>HokBen <?= ucwords($v->nama_store) ?></label>
                                                            </td>
                                                        <?php endif ?>
                                                        <td><?= $v->kategori ?></td>
                                                        <td><?= strtoupper($v->perangkat) ?></td>
                                                        <td><?= strtoupper($v->merk) ?></td>
                                                        <td><?= strtoupper($v->sn) ?></td>
                                                        <td><?= $v->tahun != 0 ? "$v->tahun" : '-' ?></td>
                                                        <td><?= $v->tahun != 0 ? " " . date('Y') -  $v->tahun . "  Tahun" : "Tahun Tidak Diketahui" ?></td>
                                                        <?php
                                                        if ($v->status == 1) {
                                                            echo "
                                                            <td style='text-align: center;'><i style='font-size:16px; color:green;' class='fas fa-check-circle'></i></td>";
                                                        } elseif ($v->status == 2) {
                                                            echo "<td style='text-align: center;'><i style='font-size:16px; color:red;' class='fas fa-ban'></i></td>";
                                                        } elseif ($v->status == 3) {
                                                            echo "<td style='text-align: center;'><i style='font-size:16px; color:orange;' class='fas fa-exclamation-circle'></i></td>";
                                                        }
                                                        ?>

                                                    </tr>
                                                <?php endforeach ?>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>