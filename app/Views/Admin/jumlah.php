<?= $this->extend('Admin/layout/template') ?>
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
        <div class="container-fluid">
            <div class="card card-warning card-outline">
                <div class="card-body">
                    <table id="example1" class="table table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Store</th>
                                <th>CPU</th>
                                <th>POS</th>
                                <th>Printer</th>
                                <th>Monitor</th>
                                <th>UPS</th>
                                <th>CCTV</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($group as $key => $data) : ?>
                                <?php
                                include ($_SERVER['DOCUMENT_ROOT']) . '/app/app/Database/koneksi.php';
                                $dataPos = mysqli_query($conn, "SELECT * FROM data_aset WHERE code_store = '$data[code_store]' AND perangkat = 'pos'");
                                $dataCpu = mysqli_query($conn, "SELECT * FROM data_aset WHERE code_store = '$data[code_store]' AND perangkat = 'cpu'");
                                $dataPrinter = mysqli_query($conn, "SELECT * FROM data_aset WHERE code_store = '$data[code_store]' AND perangkat LIKE '%printer%'");
                                $dataMonitor = mysqli_query($conn, "SELECT * FROM data_aset WHERE code_store = '$data[code_store]' AND perangkat LIKE '%monitor%'");
                                $dataUps = mysqli_query($conn, "SELECT * FROM data_aset WHERE code_store = '$data[code_store]' AND perangkat = 'ups'");
                                $pos = mysqli_num_rows($dataPos);
                                $cpu = mysqli_num_rows($dataCpu);
                                $printer = mysqli_num_rows($dataPrinter);
                                $monitor = mysqli_num_rows($dataMonitor);
                                $ups = mysqli_num_rows($dataUps);
                                ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>HokBen <?= $data['nama_store'] ?></td>
                                    <td><?= $cpu ?></td>
                                    <td><?= $pos ?></td>
                                    <td><?= $printer ?></td>
                                    <td><?= $monitor ?></td>
                                    <td><?= $ups ?></td>
                                    <td><?= $ups ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
</div>
<?= $this->endsection(); ?>