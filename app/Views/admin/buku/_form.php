<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<?php
$kategoriModel = model('KategoriModel');
$penerbitModel = model('PenerbitModel');
$buku = isset($buku) ? $buku : null;
?>
<div class="row p-0 p-md-4">
    <div class="col-12">
        <h4 class="fw-bold"><?= $buku ? 'Perbarui' : 'Tambah' ?> <?= $title ?></h4>
        <?= session()->has('create_error') ? session()->getFlashdata('create_error') : '' ?>

        <form action="<?= $buku ? site_url('admin/buku/' . $buku->id) : site_url('admin/buku') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" onchange="previewImage()" class="form-control <?= $validation->hasError('gambar') ? 'is-invalid' : '' ?>" name="gambar" id="gambar" />
                        <?php if ($validation->hasError('gambar')) : ?>
                            <div id="validationServer05Feedback" class="invalid-feedback    ">
                                <?= $validation->getError('gambar') ?>
                            </div>
                        <?php endif; ?>
                        <div class="row mt-3 ">
                            <div class="col-12 col-sm-12 col-md-10 col-lg-12">
                                <?php if ($buku) : ?>
                                    <img id="imgPreview" class="rounded" src="<?= $buku->gambar != '' && $buku->gambar != 'default.png' ? base_url('public/uploads/buku/' . $buku->gambar) : base_url('public/default.png') ?>" style="width:100%;object-fit:cover;" />
                                <?php else : ?>
                                    <img id="imgPreview" class="rounded" src="<?= base_url('public/default.png') ?>" style="width:100%;object-fit:cover;" />
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <?php if ($buku) : ?>
                        <input type="hidden" name="_method" value="put" />
                        <input type="hidden" name="id" value="<?= $buku->id ?>" />
                        <input type="hidden" name="_gambar" value="<?= $buku->gambar ?>" />
                    <?php endif; ?>
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control<?= $validation->hasError('judul') ? ' is-invalid' : '' ?>" name="judul" id="judul" value="<?= old('judul') ? old('judul') : ($buku ? $buku->judul : '') ?>">
                        <div id="validationServerJudulFeedback" class="invalid-feedback">
                            <?= $validation->hasError('judul') ? $validation->getError('judul') : '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control<?= $validation->hasError('harga') ? ' is-invalid' : '' ?>" name="harga" id="harga" value="<?= old('harga') ? old('harga') : ($buku ? $buku->harga : '') ?>">
                        <div id="validationServerHargaFeedback" class="invalid-feedback">
                            <?= $validation->hasError('harga') ? $validation->getError('harga') : '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control<?= $validation->hasError('penulis') ? ' is-invalid' : '' ?>" name="penulis" id="penulis" value="<?= old('penulis') ? old('penulis') : ($buku ? $buku->penulis : '') ?>">
                        <div id="validationServerPenulisFeedback" class="invalid-feedback">
                            <?= $validation->hasError('penulis') ? $validation->getError('penulis') : '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="berat" class="form-label">Berat (kg)</label>
                        <input type="number" class="form-control<?= $validation->hasError('berat') ? ' is-invalid' : '' ?>" name="berat" id="berat" value="<?= old('berat') ? old('berat') : ($buku ? $buku->berat : '') ?>">
                        <div id="validationServerBeratFeedback" class="invalid-feedback">
                            <?= $validation->hasError('berat') ? $validation->getError('berat') : '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dimensi" class="form-label">Dimensi</label>
                        <input type="text" class="form-control<?= $validation->hasError('dimensi') ? ' is-invalid' : '' ?>" name="dimensi" id="dimensi" value="<?= old('dimensi') ? old('dimensi') : ($buku ? $buku->dimensi : '') ?>">
                        <div id="validationServerDimensiFeedback" class="invalid-feedback">
                            <?= $validation->hasError('dimensi') ? $validation->getError('dimensi') : '' ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Bahasa</label>
                        <select class="form-control<?= $validation->hasError('bahasa') ? ' is-invalid' : '' ?>" name="bahasa" id="exampleFormControlSelect1">
                            <option value="">Pilih Bahasa</option>
                            <option value="ID" <?= old('bahasa') ? (old('bahasa') == 'ID' ? 'selected' : '') : ($buku ? ($buku->bahasa == 'ID' ? 'selected' : '') : '') ?>>Indonesia</option>
                        </select>
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?= $validation->hasError('bahasa') ? $validation->getError('bahasa') : '' ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Cover</label>
                        <select class="form-control<?= $validation->hasError('cover') ? ' is-invalid' : '' ?>" name="cover" id="exampleFormControlSelect1">
                            <option value="">Pilih Cover</option>
                            <option value="hard" <?= old('cover') ? (old('cover') == 'hard' ? 'selected' : '') : ($buku ? ($buku->cover == 'hard' ? 'selected' : '') : '') ?>>Hard</option>
                            <option value="soft" <?= old('cover') ? (old('cover') == 'soft' ? 'selected' : '') : ($buku ? ($buku->cover == 'soft' ? 'selected' : '') : '') ?>>Soft</option>
                        </select>
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?= $validation->hasError('cover') ? $validation->getError('cover') : '' ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Penerbit</label>
                        <select class="form-control<?= $validation->hasError('penerbit_id') ? ' is-invalid' : '' ?>" name="penerbit_id" id="exampleFormControlSelect1">
                            <option value="">Pilih Penerbit</option>
                            <?php
                            foreach ($penerbitModel->find()  as $penerbit) : ?>
                                <option value="<?= $penerbit->id ?>" <?= old('penerbit_id') ? (old('penerbit_id') == $penerbit->id ? 'selected' : '') : ($buku ? ($buku->penerbit_id == $penerbit->id ? 'selected' : '') : '') ?>><?= $penerbit->penerbit ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?= $validation->hasError('penerbit_id') ? $validation->getError('penerbit_id') : '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Kategori</label>
                        <select class="form-control<?= $validation->hasError('kategori_id') ? ' is-invalid' : '' ?>" name="kategori_id" id="exampleFormControlSelect1">
                            <option value="">Pilih Kategori</option>
                            <?php
                            foreach ($kategoriModel->find()  as $kategori) : ?>
                                <option value="<?= $kategori->id ?>" <?= old('kategori_id') ? (old('kategori_id') == $kategori->id ? 'selected' : '') : ($buku ? ($buku->kategori_id == $kategori->id ? 'selected' : '') : '') ?>><?= $kategori->kategori ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?= $validation->hasError('kategori_id') ? $validation->getError('kategori_id') : '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control<?= $validation->hasError('deskripsi') ? ' is-invalid' : '' ?>" name="deskripsi" id="deskripsi"><?= old('deskripsi') ? old('deskripsi') : ($buku ? $buku->deskripsi : '') ?></textarea>
                        <div id="validationServerDeskripsiFeedback" class="invalid-feedback">
                            <?= $validation->hasError('deskripsi') ? $validation->getError('deskripsi') : '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="ISBN" class="form-label">ISBN</label>
                        <input type="text" class="form-control<?= $validation->hasError('ISBN') ? ' is-invalid' : '' ?>" name="ISBN" id="ISBN" value="<?= old('ISBN') ? old('ISBN') : ($buku ? $buku->ISBN : '') ?>">
                        <div id="validationServerISBNFeedback" class="invalid-feedback">
                            <?= $validation->hasError('ISBN') ? $validation->getError('ISBN') : '' ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-success"><?= $buku ? 'Perbarui' : 'Simpan' ?></button>
                    </div>
                </div>
        </form>
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