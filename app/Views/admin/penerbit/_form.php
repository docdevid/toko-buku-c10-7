<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<?php $penerbit = isset($penerbit) ? $penerbit : null; ?>
<div class="card shadow border-0">
    <div class="card-body">
        <div class="row p-0 p-md-4">
            <div class="col-12">
                <h4 class="fw-bold"><?= $penerbit ? 'Perbarui' : 'Tambah' ?> <?= $title ?></h4>
                <p class="text-muted">Berikut adalah formulir data <?= $title ?>. Silahkan daftarkan <?= $title ?> baru</p>
                <?= session()->has('create_error') ? session()->getFlashdata('create_error') : '' ?>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?= $penerbit ? base_url('admin/penerbit/' . $penerbit->id) : base_url('admin/penerbit') ?>" method="post" enctype="multipart/form-data">
                            <?php if ($penerbit) : ?>
                                <input type="hidden" name="_method" value="put" />
                                <input type="hidden" name="id" value="<?= $penerbit->id ?>" />
                            <?php endif; ?>
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="penerbit" class="form-label">Penerbit</label>
                                <input type="text" class="form-control<?= $validation->hasError('penerbit') ? ' is-invalid' : '' ?>" name="penerbit" id="penerbit" value="<?= old('penerbit') ? old('penerbit') : ($penerbit ? $penerbit->penerbit : '') ?>" placeholder="">
                                <div id="validationServerpenerbitFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('penerbit') ? $validation->getError('penerbit') : '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary"><?= $penerbit ? 'Perbarui' : 'Simpan' ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>