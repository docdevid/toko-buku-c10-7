<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<?php $user = isset($user) ? $user : null; ?>
<div class="card shadow border-0">
    <div class="card-body">
        <div class="row p-0 p-md-4">
            <div class="col-12">
                <h4 class="fw-bold"><?= $user ? 'Perbarui' : 'Tambah' ?> Pengguna</h4>
                <p class="text-muted">Berikut adalah formulir data pengguna. Silahkan daftarkan pengguna baru</p>
                <?= session()->has('create_error') ? session()->getFlashdata('create_error') : '' ?>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?= $user ? base_url('admin/user/' . $user->id) : base_url('admin/user') ?>" method="post" enctype="multipart/form-data">
                            <?php if ($user) : ?>
                                <input type="hidden" name="_method" value="put" />
                                <input type="hidden" name="id" value="<?= $user->id ?>" />
                                <input type="hidden" name="_gambar" value="<?= $user->gambar ?>" />
                            <?php endif; ?>
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control<?= $validation->hasError('username') ? ' is-invalid' : '' ?>" name="username" id="username" value="<?= old('username') ? old('username') : ($user ? $user->username : '') ?>" placeholder="John doe">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('username') ? $validation->getError('username') : '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="password" class="form-control<?= $validation->hasError('password') ? ' is-invalid' : '' ?>" name="password" id="exampleFormControlInput1" value="<?= old('password') ? old('password') : '' ?>" placeholder="*******">
                                <div id="passwordHelpBlock" class="form-text">
                                    Password harus lebih dari 7 karakter. Disarankan menggunakan kombinasi huruf, angka, dan simbol.
                                </div>
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('password') ? $validation->getError('password') : '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Ulangi Password</label>
                                <input type="password" class="form-control<?= $validation->hasError('_password') ? ' is-invalid' : '' ?>" name="_password" id="exampleFormControlInput1" value="<?= old('_password') ? old('_password') : '' ?>" placeholder="*******">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('_password') ? $validation->getError('_password') : '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Foto Profil *</label>
                                <input type="file" onchange="previewImage()" class="form-control <?= $validation->hasError('gambar') ? 'is-invalid' : '' ?>" name="gambar" id="gambar" />
                                <?php if ($validation->hasError('gambar')) : ?>
                                    <div id="validationServer05Feedback" class="invalid-feedback">
                                        <?= $validation->getError('gambar') ?>
                                    </div>
                                <?php endif; ?>
                                <div class="row mt-3 ">
                                    <div class="col-12 col-sm-8 col-md-10 col-lg-6">
                                        <?php if ($user) : ?>
                                            <img id="imgPreview" class="rounded" src="<?= $user->gambar != '' && $user->gambar != 'default.png' ? base_url('public/upload/user/' . $user->gambar) : base_url('public/default.png') ?>" style="width:inherit;height:100px;object-fit:cover;" />
                                        <?php else : ?>
                                            <img id="imgPreview" class="rounded" src="<?= base_url('public/default.png') ?>" style="width:inherit;height:100px;object-fit:cover;" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary"><?= $user ? 'Perbarui' : 'Simpan' ?></button>
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