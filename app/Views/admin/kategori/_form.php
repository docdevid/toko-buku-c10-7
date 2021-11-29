<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<?php $kategori = isset($kategori) ? $kategori : null; ?>
<div class="card shadow border-0">
    <div class="card-body">
        <div class="row p-0 p-md-4">
            <div class="col-12">
                <h4 class="fw-bold"><?= $kategori ? 'Perbarui' : 'Tambah' ?> <?= $title ?></h4>
                <p class="text-muted">Berikut adalah formulir data <?= $title ?>. Silahkan daftarkan <?= $title ?> baru</p>
                <?= session()->has('create_error') ? session()->getFlashdata('create_error') : '' ?>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?= $kategori ? base_url('admin/kategori/' . $kategori->id) : base_url('admin/kategori') ?>" method="post" enctype="multipart/form-data">
                            <?php if ($kategori) : ?>
                                <input type="hidden" name="_method" value="put" />
                                <input type="hidden" name="id" value="<?= $kategori->id ?>" />
                            <?php endif; ?>
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control<?= $validation->hasError('kategori') ? ' is-invalid' : '' ?>" name="kategori" id="kategori" value="<?= old('kategori') ? old('kategori') : ($kategori ? $kategori->kategori : '') ?>" placeholder="">
                                <div id="validationServerkategoriFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('kategori') ? $validation->getError('kategori') : '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary"><?= $kategori ? 'Perbarui' : 'Simpan' ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>