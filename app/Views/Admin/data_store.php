<?= $this->extend('Admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Store</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="data-cancel" data-cancel="<?= session()->getFlashdata('success') ?>">
        <?php if (session()->getFlashdata('success')) : ?>
        <?php endif; ?>
    </div>
    <div class="data-error" data-error="<?= session()->getFlashdata('error') ?>">
        <?php if (session()->getFlashdata('error')) : ?>
        <?php endif; ?>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <button type="button" class="btn btn-primary btn-md d-inline" data-toggle="modal" data-target="#modal-default">
                        <i class="far fa-folder"></i> &nbsp; Add Store
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-md d-inline" data-toggle="dropdown">
                            <i class="fas fa-upload"></i></i> &nbsp; Import Data
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button class="dropdown-item" data-toggle="modal" data-target="#upload">
                                    Upload File
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item" data-toggle="modal" data-target="#updateBatch">
                                    Update Data
                                </button>
                            </li>
                            <li><a class="dropdown-item" href="<?= site_url('DataStore.xlsx') ?>">Download template</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-sm text-wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Store Code</th>
                                        <th>Nama Store</th>
                                        <th>Tecnical Support</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($query as $key => $data) : ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= ucwords($data->code_store) ?></td>
                                            <td>HokBen <?= ucwords($data->nama_store) ?></td>
                                            <td><?= ucwords($data->nama_user) ?></td>
                                            <td>
                                                <a href="<?= site_url('EditStore/' . $data->code_store); ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="<?= site_url('HapusStore/' . $data->code_store) ?>" method="post" class="d-inline" onsubmit="return hapusForm(this)">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Store</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="<?= site_url('CreateStore') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Kode Store</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kode_store" placeholder="Masukan Kode Store" autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama Store</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_store" placeholder="Masukan Nama Store" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Lokasi</label>
                            <div class="col-sm-8">
                                <select type="text" class="form-control" name="lokasi">
                                    <option value="1">Jabodetabek</option>
                                    <option value="2">Luar Jabodetabek</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Technical Support</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="nama_user" name="nama_user">
                                    <option selected="selected">Pilih Technical Support</option>
                                    <?php
                                    ?>
                                    <?php foreach ($query1 as $key => $data) : ?>
                                        <option data-nik="<?= $data['nik_user'] ?>" data-nama="<?= $data['nama_user'] ?>"> <?= $data['nama_user'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <input type="hidden" name="nik_user" required>
                            <input type="hidden" name="status" value="0" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection() ?>