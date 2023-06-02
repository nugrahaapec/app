<?= $this->extend('Admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper" style="min-height: 1604.44px;">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile Detail</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="callout callout-warning">
                <h5>Info</h5>

                <p>Silahkan edit data user dibawah ini.</p>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-warning card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>/img/avatar5.png" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><?= $user->nama_user ?></h3>
                            <p class="text-muted text-center">ICT - Technical Support Store</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Status</b>
                                    <div class="float-right"><?= $user->level_user ?></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card card-warning card-outline">
                        <div class="card-body">
                            <form class="form-horizontal" action="<?= site_url('Update/' . $user->nik_user) ?>" method="post" onsubmit="return updateForm(this)">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="put">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">NIK</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nik_user" value="<?= $user->nik_user ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_user" value="<?= $user->nama_user ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="username" value="<?= $user->username ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email_user" value="<?= $user->email_user ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="pass_user" placeholder="Kosongkan jika password tidak diganti">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Posisi</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="level_user">
                                            <option selected="selected" value="<?= $user->level_user ?>"><?= ucwords($user->level_user) ?></option>
                                            <option value="admin">Admin</option>
                                            <option value="technical support">Technical Support</option>
                                            <option value="staff">Staff</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mt-5">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-success update">Simpan</button>
                                        <a href="<?= site_url('DataUser') ?>" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
</div>


<?= $this->endsection() ?>