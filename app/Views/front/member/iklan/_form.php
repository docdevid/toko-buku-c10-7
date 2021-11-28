<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<?php $iklan = isset($iklan) ? $iklan : null; ?>
<div class="card shadow border-0">
    <div class="card-body">
        <div class="row p-0 p-md-4">
            <div class="col-12">
                <h4 class="fw-bold"><?= $iklan ? 'Perbarui' : 'Tambah' ?> <?= $title ?></h4>
                <p class="text-muted">Berikut adalah formulir data <?= $title ?>. Silahkan daftarkan <?= $title ?> baru</p>
                <?= session()->has('create_error') ? session()->getFlashdata('create_error') : '' ?>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <form action="<?= $iklan ? base_url('member/iklan/' . $iklan->id) : base_url('member/iklan') ?>" method="post" enctype="multipart/form-data">
                            <?php if ($iklan) : ?>
                                <input type="hidden" name="_method" value="put" />
                                <input type="hidden" name="id" value="<?= $iklan->id ?>" />
                                <input type="hidden" name="_gambar" value="<?= $iklan->gambar ?>" />
                            <?php endif; ?>
                            <?= csrf_field() ?>
                            <input type="hidden" name="user_id" value="<?= session('userdata')->id ?>" />
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar Iklan*</label>
                                <input type="file" onchange="previewImage()" class="form-control <?= $validation->hasError('gambar') ? 'is-invalid' : '' ?>" name="gambar" id="gambar" />
                                <?php if ($validation->hasError('gambar')) : ?>
                                    <div id="validationServer05Feedback" class="invalid-feedback">
                                        <?= $validation->getError('gambar') ?>
                                    </div>
                                <?php endif; ?>
                                <div class="row mt-3 ">
                                    <div class="col-12 col-sm-8 col-md-10 col-lg-6">
                                        <?php if ($iklan) : ?>
                                            <img id="imgPreview" class="rounded" src="<?= $iklan->gambar != '' && $iklan->gambar != 'default.png' ? base_url('uploads/iklan/' . $iklan->gambar) : base_url('default.png') ?>" style="width:inherit;height:100px;object-fit:cover;" />
                                        <?php else : ?>
                                            <img id="imgPreview" class="rounded" src="<?= base_url('default.png') ?>" style="width:inherit;height:100px;object-fit:cover;" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control<?= $validation->hasError('judul') ? ' is-invalid' : '' ?>" name="judul" id="judul" value="<?= old('judul') ? old('judul') : ($iklan ? $iklan->judul : '') ?>" placeholder="John doe">
                                <div id="validationServerJudulFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('judul') ? $validation->getError('judul') : '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Kategori</label>
                                <select class="form-control<?= $validation->hasError('kategori_id') ? ' is-invalid' : '' ?>" name="kategori_id" id="exampleFormControlSelect1">
                                    <option value="">Pilih Kategori</option>
                                    <?php $kategoriModel = model('KategoriModel');
                                    foreach ($kategoriModel->find()  as $kategori) : ?>
                                        <option value="<?= $kategori->id ?>" <?= old('kategori_id') ? (old('kategori_id') == $kategori->id ? 'selected' : '') : ($iklan ? ($iklan->kategori_id == $kategori->id ? 'selected' : '') : '') ?>><?= $kategori->kategori ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('kategori_id') ? $validation->getError('kategori_id') : '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <textarea class="form-control<?= $validation->hasError('lokasi') ? ' is-invalid' : '' ?>" name="lokasi" id="lokasi"><?= old('lokasi') ? old('lokasi') : ($iklan ? $iklan->lokasi : '') ?></textarea>
                                <div id="validationServerLokasiFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('lokasi') ? $validation->getError('lokasi') : '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control<?= $validation->hasError('deskripsi') ? ' is-invalid' : '' ?>" name="deskripsi" id="deskripsi"><?= old('deskripsi') ? old('deskripsi') : ($iklan ? $iklan->deskripsi : '') ?></textarea>
                                <div id="validationServerDeskripsiFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('deskripsi') ? $validation->getError('deskripsi') : '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="aktif" class="form-label">Aktif</label>
                                <select class="form-control<?= $validation->hasError('status') ? ' is-invalid' : '' ?>" name="status" id="aktif">
                                    <option value="">Pilih Status</option>
                                    <option value="aktif" <?= old('status') ? (old('status') == "aktif" ? 'selected' : '') : ($iklan ? ($iklan->status == "aktif" ? 'selected' : '') : '') ?>>Aktif</option>
                                    <option value="nonaktif" <?= old('status') ? (old('status') == "nonaktif" ? 'selected' : '') : ($iklan ? ($iklan->status == "nonaktif" ? 'selected' : '') : '') ?>>Nonaktif</option>
                                </select>
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('status') ? $validation->getError('status') : '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-success"><?= $iklan ? 'Perbarui' : 'Simpan' ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    function previewImage() {
        const gambar = document.querySelector("#gambar");
        const gambarPreview = document.querySelector("#imgPreview");
        const fr = new FileReader();

        console.log(gambar);
        fr.readAsDataURL(gambar.files[0]);
        fr.onload = function(e) {
            gambarPreview.src = e.target.result;
        }

    }
</script>
<?= $this->endSection() ?>