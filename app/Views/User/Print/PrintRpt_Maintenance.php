<!DOCTYPE html>
<html lang="en">
<?= $this->include('/auth/tanggal.php') ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">

<body>
    <div class="content-fluid">
        <div class="invoice px-1">
            <CENTER>
                <label class="mt-2 mb-5" style="font-size:25px ;"> FORM MAINTENANCE STORE </label>
            </CENTER>
            <div class="col-sm-12">
                <label style="width: 200px;"> Nama Store </label>
                <label style="width: 10px;">:</label>
                <label>HokBen <?= ucwords($store->nama_store) ?></label>
                <div>
                    <label style="width: 200px;"> Tanggal Maintenance </label>
                    <label style="width: 10px;">:</label>
                    <label><?= tgl_indo(date('Y-m-d')); ?></label>
                </div>
                <div class="mb-4">
                    <label style="width: 200px;"> Technical Support </label>
                    <label style="width: 10px;">:</label>
                    <label><?= session('nama_user') ?></label>
                </div>
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
                            <th style="text-align:center">Satus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once ($_SERVER['DOCUMENT_ROOT']) . '/app/app/Database/koneksi.php';
                        $query = mysqli_query($conn, "SELECT * FROM data_aset WHERE nik_user = $_SESSION[nik_user] AND nama_store = '$store->nama_store' ORDER BY kategori");
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
            <div class="callout callout-info" style="height: 150px;">
                <h5 style="font: bold;">Catatan :</h5>
            </div>
            <div class="form-group col-4">
                <label style="margin-top: 50px;"> Mengetahui,</label>
                <br>
                <label style="margin-top: 60px;"> PIC Store</label>
                <div style="font-size: 12px; color: red;">*Stampel</div>
            </div>
        </div>
    </div>
    <footer class="footer" style="position: fixed;bottom: 0;">
        <div class="d-none d-sm-inline-block">
            <b>Note : <br>
                <i class="fas fa-check-circle" style="color: green;">&nbsp;Baik</i></b> &nbsp;
            <b><i class="fas fa-exclamation-circle" style="color: orange;">&nbsp;Rekomendasi Penggantian</i></b>&nbsp;
            <b><i class="fas fa-ban" style="color: red;">&nbsp;Rusak</i></b>
        </div>
    </footer>
    <script type="text/javascript">
        window.print();
        window.close();
    </script>
</body>

</html>