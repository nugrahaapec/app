<?= $this->extend('Staff/layout/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('/auth/tanggal.php'); ?>

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
                                <div class="col-12">
                                    <div class="table-responsive p-0">
                                        <table id="example2" class="table">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th style="text-align:center">No</th>
                                                    <th style="text-align:center">Kode Permintaan</th>
                                                    <th style="text-align:center">Nama Store</th>
                                                    <th style="text-align:center">Technical Support</th>
                                                    <th style="text-align:center">Tanggal Permintaan</th>
                                                    <th style="text-align:center">Tanggal Permintaan</th>
                                                    <th style="text-align:center">Proses</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($request as $data) :
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?= $no++ ?></td>
                                                        <td style="text-align: center;"><?= $data['code_permintaan'] ?></td>
                                                        <td style="text-align: center;"><?= $data['nama_store'] ?></td>
                                                        <td style="text-align: center;"><?= $data['nama_user'] ?></td>
                                                        <td style="text-align: center;"><?= tgl_indo($data['tanggal_permintaan']) ?></td>
                                                        <td style="text-align: center;"><?= $data['status'] == 1 ? "New" : "Proses" ?></td>
                                                        <form action="<?= site_url('newCancel/') . $data['code_permintaan'] ?>" method="post">
                                                            <?= csrf_field() ?>
                                                            <td style="text-align: center;">
                                                                <?php if ($data['status'] == 1) {
                                                                    echo "<button type='submit'class='btn btn-danger btn-sm mr-1'><i class='fas fa-ban'></i></button>";
                                                                    echo "<a href='" . site_url('NewProsesPermintaan/') . $data['code_permintaan'] . "' class='btn btn-info btn-sm mr-1'><i class='fas fa-sync'></i></a>";
                                                                }
                                                                if ($data['status'] == 2) {
                                                                    echo "<a href='" . site_url('PrintNew/') . $data['code_permintaan'] . "'target='blank' class='btn btn-primary btn-sm mr-1'><i class='fas fa-print'></i></a>";
                                                                } ?>
                                                            </td>
                                                        </form>
                                                    </tr>
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
</div>

<?= $this->endSection() ?>