<?= $this->extend('Admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title ?> </h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                        <i class="far fa-folder"></i> &nbsp; Add User
                    </button>
                </div>
                <div class="data-cancel" data-cancel="<?= session()->getFlashdata('success') ?>">
                    <?php if (session()->getFlashdata('success')) : ?>
                    <?php endif; ?>
                </div>
                <div class="data-error" data-error="<?= session()->getFlashdata('error') ?>">
                    <?php if (session()->getFlashdata('error')) : ?>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-sm text-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($query as $key => $result) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $result->nik_user ?></td>
                                        <td><?= $result->nama_user ?></td>
                                        <td><?= $result->username ?></td>
                                        <td><?= $result->email_user ?></td>
                                        <td><?= $result->pass_user ?></td>
                                        <td><?= ucwords($result->level_user) ?></td>
                                        <td>
                                            <a href="<?= site_url('EditUser/' . $result->nik_user); ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url('Delete/' . $result->nik_user) ?>" class="btn btn-danger btn-sm hapus"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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
                <h4 class="modal-title">Tambah Data User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="<?= site_url('CreateUser') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nikuser" id="nik_user" placeholder="NIK" value="<?= old('nikuser') ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Nama Lengkap" value="<?= old('nama_user') ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?= old('username') ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email_user" id="email_user" placeholder="Email" value="<?= old('email_user') ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="pass_user" id="password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Level</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="level_user">
                                    <option selected="selected">Pilih Level User</option>
                                    <option value="admin">Admin</option>
                                    <option value="technical support">Technical Support</option>
                                    <option value="staff">Staff</option>
                                </select>
                            </div>
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