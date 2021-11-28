<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12 col-sm-10 col-md-8 mx-auto">

        <?= session()->has('success_logout') ? session()->getFlashdata('success_logout') : '' ?>
        <?= session()->has('error_login') ? session()->getFlashdata('error_login') : '' ?>

        <div class="card shadow border-0">
            <div class="card-body p-4">
                <div class="card-title">
                    <h3>Registrasi </h3>
                </div>
                <p class="text-muted">Silahkan masukan email dan password anda</p>

                <?php $user = isset($user) ? $user : null; ?>
                <form action="<?= $user ? base_url('registrasi/' . $user->id) : base_url('registrasi') ?>" method="post" enctype="multipart/form-data">
                    <?php if ($user) : ?>
                        <input type="hidden" name="_method" value="put" />
                        <input type="hidden" name="id" value="<?= $user->id ?>" />
                        <input type="hidden" name="_gambar" value="<?= $user->gambar ?>" />
                    <?php endif; ?>
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control<?= $validation->hasError('nama_lengkap') ? ' is-invalid' : '' ?>" name="nama_lengkap" id="nama_lengkap" value="<?= old('nama_lengkap') ? old('nama_lengkap') : ($user ? $user->nama_lengkap : '') ?>" placeholder="John doe">
                                <div id="validationServerNama_lengkapFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('nama_lengkap') ? $validation->getError('nama_lengkap') : '' ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control<?= $validation->hasError('username') ? ' is-invalid' : '' ?>" name="username" id="username" value="<?= old('username') ? old('username') : ($user ? $user->username : '') ?>" placeholder="John doe">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('username') ? $validation->getError('username') : '' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" class="form-control<?= $validation->hasError('no_hp') ? ' is-invalid' : '' ?>" name="no_hp" id="no_hp" value="<?= old('no_hp') ? old('no_hp') : ($user ? $user->no_hp : '') ?>" placeholder="John doe">
                        <div id="validationServerNo_hpFeedback" class="invalid-feedback">
                            <?= $validation->hasError('no_hp') ? $validation->getError('no_hp') : '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control<?= $validation->hasError('email') ? ' is-invalid' : '' ?>" name="email" id="email" value="<?= old('email') ? old('email') : ($user ? $user->email : '') ?>" placeholder="John doe">
                        <div id="validationServerEmailFeedback" class="invalid-feedback">
                            <?= $validation->hasError('email') ? $validation->getError('email') : '' ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="password" class="form-control<?= $validation->hasError('password') ? ' is-invalid' : '' ?>" name="password" id="exampleFormControlInput1" value="<?= old('password') ? old('password') : '' ?>" placeholder="*******">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('password') ? $validation->getError('password') : '' ?>
                                </div>
                                <div id="passwordHelpBlock" class="form-text">
                                    Password harus lebih dari 7 karakter. Disarankan menggunakan kombinasi huruf, angka, dan simbol.
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Ulangi Password</label>
                                <input type="password" class="form-control<?= $validation->hasError('_password') ? ' is-invalid' : '' ?>" name="_password" id="exampleFormControlInput1" value="<?= old('_password') ? old('_password') : '' ?>" placeholder="*******">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    <?= $validation->hasError('_password') ? $validation->getError('_password') : '' ?>
                                </div>
                            </div>
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
                                    <img id="imgPreview" class="rounded" src="<?= $user->gambar != '' && $user->gambar != 'default.png' ? base_url('upload/user/' . $user->gambar) : base_url('default.png') ?>" style="width:inherit;height:100px;object-fit:cover;" />
                                <?php else : ?>
                                    <img id="imgPreview" class="rounded" src="<?= base_url('default.png') ?>" style="width:inherit;height:100px;object-fit:cover;" />
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