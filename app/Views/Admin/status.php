<?= $this->extend('Admin/layout/template') ?>
<?= $this->section('content') ?>
<div class="data-cancel" data-cancel="<?= session()->getFlashdata('success') ?>">
    <?php if (session()->getFlashdata('success')) : ?>
    <?php endif; ?>
</div>
<div class="data-error" data-error="<?= session()->getFlashdata('error') ?>">
    <?php if (session()->getFlashdata('error')) : ?>
    <?php endif; ?>
</div>

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
                                <!-- <th>Lokasi</th> -->
                                <th>Nama Perangkat</th>
                                <th>Merk</th>
                                <th>SN</th>
                                <th>Usia Perangkat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($status as $key => $data) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>HokBen <?= ucwords($data->nama_store) ?></td>
                                    <!-- <td><?= ucwords($data->kategori) ?></td> -->
                                    <td><?= ucwords($data->perangkat) ?></td>
                                    <td><?= ucwords($data->merk) ?></td>
                                    <td><?= strtoupper($data->sn) ?></td>
                                    <td><?= date('Y') - $data->tahun ?> Tahun</td>
                                    <td>
                                        <?php
                                        if ($data->status == 1) {
                                            echo "Baik";
                                        }
                                        if ($data->status == 2) {
                                            echo "Rusak";
                                        }
                                        if ($data->status == 3) {
                                            echo "Rekomendasi Penggantian";
                                        }  ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
</div>
<?= $this->endsection(); ?>