<?= $this->extend('User/layout/layout') ?>
<?= $this->Section('content') ?>
<?= $this->include('/auth/tanggal'); ?>


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
        <div class="content">
            <div class="card card-outline card-warning">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive p-0">
                                <table id="example1" class="table table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="text-align:center">No</th>
                                            <th style="text-align:center">Nomor DO</th>
                                            <th style="text-align:center">Nama Store</th>
                                            <th style="text-align:center">Nama Perangkat</th>
                                            <th style="text-align:center">Tanggal</th>
                                            <th style="text-align:center">Keterangan</th>
                                            <th style="text-align:center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($result as $data) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $no++ ?></td>
                                                <td style="text-align: center;"><?= strtoupper($data['no_do']) ?></td>
                                                <td style="text-align: center;">HokBen <?= ucwords($data['nama_store']) ?></td>
                                                <td style="text-align: center;"><?= strtoupper($data['perangkat']) ?></td>
                                                <td style="text-align: center;"><?= tgl_indo($data['tgl_proses']) ?></td>
                                                <td style="text-align: center;"><?= strtoupper($data['keterangan']) ?></td>
                                                <td style="text-align: center;"><?= $data['status'] != 3 ? "Dikirim" : "Diterima" ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <?= $this->endSection() ?>