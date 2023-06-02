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
                <div class="card-header">
                    <button type="button" class="btn btn-primary btn-md d-inline" data-toggle="modal" data-target="#tambah">
                        <i class="far fa-folder"></i> &nbsp; Add Perangkat
                    </button>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Perangkat</th>
                                <th>Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $key => $data) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= ucwords($data->nama_perangkat) ?></td>
                                    <td>
                                        <form action="<?= site_url('HapusPerangkat/' . $data->id_perangkat) ?>" method="post" class="d-inline" onsubmit="return hapusForm(this)">
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
    </section>
</div>
<div class="modal fade" id="tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= site_url('TambahPerangkat') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Perangkat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Perangkat</label>
                        <input type="text" class="form-control" name="perangkat" id="perangkat" placeholder="Contoh : POS" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?= $this->endsection(); ?>