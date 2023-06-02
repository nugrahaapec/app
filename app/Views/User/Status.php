<?= $this->extend('User/layout/layout') ?>
<?= $this->section('content') ?>

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
                                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Perangkat Baik</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Perangkat Rusak</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="timeline">
                                    <section class="content">
                                        <?php foreach ($dataa as $key => $ds) : ?>
                                            <div class="card collapsed-card">
                                                <div class="card-header">
                                                    <h3 class="card-title">HokBen <?= ucwords($ds['nama_store']) ?></h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                            <i class="fas fa-plus"></i>
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
                                                                        $this->db = \Config\Database::connect();
                                                                        $data = $this->db->table('data_aset')->where(['code_store' => $ds['code_store'], 'status !=' => 2])->orderby('kategori');
                                                                        $hasil = $data->get()->getResultArray();
                                                                        ?>
                                                                        <?php foreach ($hasil as $key => $dp) : ?>
                                                                            <tr>
                                                                                <td><?= $dp['kategori'] ?></td>
                                                                                <td><?= $dp['perangkat'] ?></td>
                                                                                <td><?= strtoupper($dp['merk']) ?></td>
                                                                                <td><?= strtoupper($dp['sn']) ?></td>
                                                                                <td><?= $dp['tahun'] != 0 ? "$dp[tahun]" : '-' ?></td>
                                                                                <td><?= $dp['tahun'] != 0 ? " " . date('Y') -  $dp['tahun'] . "  Tahun" : "Tahun Tidak Diketahui" ?></td>
                                                                                <?php if ($dp['status'] == 1) {
                                                                                    echo
                                                                                    "<td style='text-align: center;'><i style='font-size:16px; color:green;' class='fas fa-check-circle' data-bs-toggle='tooltip' title='Baik'></i></td>";
                                                                                }
                                                                                if ($dp['status'] == 3) {
                                                                                    echo
                                                                                    "<td style='text-align: center;'><i style='font-size:16px; color:orange;' class='fas fa-exclamation-circle' title='Rekomendasi'></i></td>";
                                                                                }
                                                                                if ($dp['status'] == 2) {
                                                                                    echo
                                                                                    "<td style='text-align: center;'><i style='font-size:16px; color:red;' class='fas fa-ban' title='Rusak'></i></td>";
                                                                                }
                                                                                ?>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </section>
                                </div>

                                <div class="tab-pane" id="settings">
                                    <section class="content">
                                        <?php foreach ($dataa as $key => $ds) : ?>
                                            <div class="card collapsed-card">
                                                <div class="card-header">
                                                    <h3 class="card-title">HokBen <?= ucwords($ds['nama_store']) ?></h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                            <i class="fas fa-plus"></i>
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
                                                                        $this->db = \Config\Database::connect();
                                                                        $data = $this->db->table('data_aset')->where(['code_store' => $ds['code_store'], 'status' => 2])->orderby('kategori');
                                                                        $hasil = $data->get()->getResultArray();
                                                                        ?>
                                                                        <?php foreach ($hasil as $key => $dp) : ?>
                                                                            <tr>
                                                                                <td><?= $dp['kategori'] ?></td>
                                                                                <td><?= $dp['perangkat'] ?></td>
                                                                                <td><?= strtoupper($dp['merk']) ?></td>
                                                                                <td><?= strtoupper($dp['sn']) ?></td>
                                                                                <td><?= $dp['tahun'] != 0 ? "$dp[tahun]" : '-' ?></td>
                                                                                <td><?= $dp['tahun'] != 0 ? " " . date('Y') -  $dp['tahun'] . "  Tahun" : "Tahun Tidak Diketahui" ?></td>
                                                                                <?php if ($dp['status'] == 1) {
                                                                                    echo
                                                                                    "<td style='text-align: center;'><i style='font-size:16px; color:green;' class='fas fa-check-circle' data-bs-toggle='tooltip' title='Baik'></i></td>";
                                                                                }
                                                                                if ($dp['status'] == 3) {
                                                                                    echo
                                                                                    "<td style='text-align: center;'><i style='font-size:16px; color:orange;' class='fas fa-exclamation-circle' title='Rekomendasi'></i></td>";
                                                                                }
                                                                                if ($dp['status'] == 2) {
                                                                                    echo
                                                                                    "<td style='text-align: center;'><i style='font-size:16px; color:red;' class='fas fa-ban' title='Rusak'></i></td>";
                                                                                }
                                                                                ?>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<?= $this->endsection() ?>