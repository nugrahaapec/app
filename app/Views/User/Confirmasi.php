<?= $this->extend('User/layout/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('/auth/tanggal.php'); ?>

<div class="data-cancel" data-cancel="<?= session()->getFlashdata('success') ?>">
    <?php if (session()->getFlashdata('success')) : ?>
    <?php endif; ?>
</div>

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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <div class="card card-outline card-warning">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills" id="myTab">
                                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Existing Store <?= $hasil != 0 ? "<sup class='right badge badge-info'> New </sup>" : "" ?> </a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">New Store <?= $hasil1 != 0 ? "<sup class='right badge badge-info'> New </sup>" : "" ?> </a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="timeline">
                                    <section class="content">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive p-0">
                                                        <table class="table">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th style="text-align:center">No</th>
                                                                    <th style="text-align:center">Kode Permintaan</th>
                                                                    <th style="text-align:center">Nama Store</th>
                                                                    <th style="text-align:center">Technical Support</th>
                                                                    <th style="text-align:center">Tanggal Permintaan</th>
                                                                    <th style="text-align:center">Konfirmasi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $no = 1;
                                                                foreach ($result as $data) :
                                                                ?>
                                                                    <tr>
                                                                        <td style="text-align: center;"><?= $no++ ?></td>
                                                                        <td style="text-align: center;"><?= $data['no_do'] ?></td>
                                                                        <td style="text-align: center;">HokBen <?= ucwords($data['nama_store']) ?></td>
                                                                        <td style="text-align: center;"><?= ucwords($data['nama_user']) ?></td>
                                                                        <td style="text-align: center;"><?= tgl_indo($data['tgl_proses']) ?></td>
                                                                        <td style="text-align: center;">
                                                                            <form action="<?= base_url('Conf/') . $data['code_permintaan'] ?>" method="POST" onsubmit="return submitForm(this)">
                                                                                <?= csrf_field() ?>
                                                                                <?php foreach ($list as $data1) :  ?>
                                                                                    <?php
                                                                                    if ($data['no_do'] == $data1['no_do']) { ?>
                                                                                        <input type="hidden" class="form-control" name="code_store" value="<?= $data1['code_store'] ?>">
                                                                                        <input type="hidden" class="form-control" name="nik_user" value="<?= $data1['nik_user'] ?>">
                                                                                        <input type="hidden" class="form-control" name="nama_store" value="<?= $data1['nama_store'] ?>">
                                                                                        <input type="hidden" class="form-control" name="nama_user" value="<?= $data1['nama_user'] ?>">
                                                                                        <input type="hidden" class="form-control" name="kategori[]" value="<?= $data1['kategori'] ?>">
                                                                                        <input type="hidden" class="form-control" name="perangkat[]" value="<?= $data1['perangkat'] ?>">
                                                                                        <input type="hidden" class="form-control" name="merk[]" value="<?= $data1['merk'] ?>">
                                                                                        <input type="hidden" class="form-control" name="sn[]" value="<?= $data1['sn'] ?>">
                                                                                        <input type="hidden" class="form-control" name="tahun[]" value="<?= $data1['tahun'] ?>">
                                                                                        <input type="hidden" class="form-control" name="status" value="1">
                                                                                    <?php } ?>
                                                                                <?php endforeach; ?>
                                                                                <button type="submit" class="btn btn-success btn-sm" style="border-radius: 50%; font-size: 15px; color: white;" title="Confirm"><i class="fas fa-check"></i></button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>

                                <div class="tab-pane" id="settings">
                                    <section class="content">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive p-0">
                                                        <table class="table">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th style="text-align:center">No</th>
                                                                    <th style="text-align:center">Kode Permintaan</th>
                                                                    <th style="text-align:center">Nama Store</th>
                                                                    <th style="text-align:center">Technical Support</th>
                                                                    <th style="text-align:center">Tanggal Permintaan</th>
                                                                    <th style="text-align:center">Konfirmasi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $no = 1;
                                                                foreach ($result1 as $data) :
                                                                ?>
                                                                    <tr>
                                                                        <td style="text-align: center;"><?= $no++ ?></td>
                                                                        <td style="text-align: center;"><?= $data['no_do'] ?></td>
                                                                        <td style="text-align: center;">HokBen <?= ucwords($data['nama_store']) ?></td>
                                                                        <td style="text-align: center;"><?= ucwords($data['nama_user']) ?></td>
                                                                        <td style="text-align: center;"><?= tgl_indo($data['tgl_proses']) ?></td>
                                                                        <td style="text-align: center;">
                                                                            <form action="<?= base_url('Confirm/') . $data['code_permintaan'] ?>" method="POST" onsubmit="return submitForm(this)">
                                                                                <?= csrf_field() ?>
                                                                                <?php foreach ($list1 as $data1) :  ?>
                                                                                    <?php
                                                                                    if ($data['no_do'] == $data1['no_do']) { ?>
                                                                                        <input type="hidden" class="form-control" name="code_store" value="<?= $data1['code_store'] ?>">
                                                                                        <input type="hidden" class="form-control" name="nik_user" value="<?= $data1['nik_user'] ?>">
                                                                                        <input type="hidden" class="form-control" name="nama_store" value="<?= $data1['nama_store'] ?>">
                                                                                        <input type="hidden" class="form-control" name="nama_user" value="<?= $data1['nama_user'] ?>">
                                                                                        <input type="hidden" class="form-control" name="kategori[]" value="<?= $data1['kategori'] ?>">
                                                                                        <input type="hidden" class="form-control" name="perangkat[]" value="<?= $data1['perangkat'] ?>">
                                                                                        <input type="hidden" class="form-control" name="merk[]" value="<?= $data1['merk'] ?>">
                                                                                        <input type="hidden" class="form-control" name="sn[]" value="<?= $data1['sn'] ?>">
                                                                                        <input type="hidden" class="form-control" name="tahun[]" value="<?= $data1['tahun'] ?>">
                                                                                        <input type="hidden" class="form-control" name="status" value="1">
                                                                                    <?php } ?>
                                                                                <?php endforeach; ?>
                                                                                <button type="submit" class="btn btn-success btn-sm" style="border-radius: 50%; font-size: 15px; color: white;" title="Confirm"><i class="fas fa-check"></i></button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<?= $this->endSection() ?>