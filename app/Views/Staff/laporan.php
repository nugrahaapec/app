<?= $this->extend('Staff/layout/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('/auth/tanggal') ?>

<div class="data-cancel" data-cancel="<?= session()->getFlashdata('success') ?>">
    <?php if (session()->getFlashdata('success')) : ?>
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
                            <div class="row">
                                <div class="table-responsive p-0">
                                    <table id="example1" class="table">
                                        <thead class="bg-light">
                                            <tr>
                                                <th style="text-align:center">No</th>
                                                <th style="text-align:center">Nomor DO</th>
                                                <th style="text-align:center">Nama Store</th>
                                                <th style="text-align:center">Technical Support</th>
                                                <th style="text-align:center">Tanggal Proses</th>
                                                <th style="text-align:center">Perangkat</th>
                                                <th style="text-align:center">Serial Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($listDo as $data) :
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;"><?= $no++ ?></td>
                                                    <td style="text-align: center;"><?= $data['no_do'] ?></td>
                                                    <td style="text-align: center;">HokBen <?= ucwords($data['nama_store']) ?></td>
                                                    <td style="text-align: center;"><?= $data['nama_user'] ?></td>
                                                    <td style="text-align: center;"><?= tgl_indo($data['tgl_proses']) ?></td>
                                                    <td style="text-align: center;"><?= $data['perangkat'] ?></td>
                                                    <td style="text-align: center;"><?= $data['sn'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


<?= $this->endSection() ?>