<?= $this->extend('Admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper" style="min-height: 1604.44px;">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Store Detail</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="callout callout-warning">
                <h5>Info Store <?= ucwords($store->nama_store) ?></h5>
                <p>Silahkan edit data dibawah ini.</p>
            </div>
            <div class="card card-outline card-warning">
                <form class="form-horizontal" action="<?= site_url('UpdateStore/' . $store->code_store) ?>" method="post" onsubmit="return updateForm(this)">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="put">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kode Store</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kode_store" value="<?= $store->code_store ?>">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-2 col-form-label">Nama Store</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_store" value="<?= ucwords($store->nama_store) ?>">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-2 col-form-label">Technical Support Saat Ini</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?= $store->nama_user ?>" readonly>
                                <input type="hidden" name="nik_user" required>
                            </div>
                        </div>

                        <div class=" form-group row mb-4">
                            <label class="col-sm-2 col-form-label">Ubah Technical Support</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="nama_user" name="nama_user">
                                    <?php
                                    $db   = \Config\Database::connect();
                                    $builder = $db->table('user')->where('level_user', 'technical support')->orderBy('nama_user');
                                    $query = $builder->get()->getResultArray();
                                    ?>
                                    <option selected="selected">Pilih Technical Support</option>
                                    <?php foreach ($query as $key => $data) : ?>
                                        <option data-nik="<?= $data['nik_user'] ?>" data-nama="<?= $data['nama_user'] ?>"> <?= $data['nama_user'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <a href="<?= site_url('DataStore') ?>" class="btn btn-danger float-right ml-2">Cancel</a>
                        <button type="submit" class="btn btn-success float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>


<?= $this->endsection() ?>