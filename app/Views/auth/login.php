<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6 mx-auto">

        <?= session()->has('success_register') ? session()->getFlashdata('success_register') : '' ?>
        <?= session()->has('success_logout') ? session()->getFlashdata('success_logout') : '' ?>
        <?= session()->has('error_login') ? session()->getFlashdata('error_login') : '' ?>

        <div class="card shadow border-0">
            <div class="card-body p-4">
                <div class="card-title">
                    <h3>Login </h3>
                </div>
                <p class="text-muted">Silahkan masukan email dan password anda</p>

                <form method="POST" action="<?= site_url('login') ?>">
                    <?= csrf_field() ?>
                    <div class="mb-2 has-validation">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control<?= $validation->hasError('username') ? ' is-invalid' : '' ?>" id="exampleInputEmail1" value="<?= old('username') ?>" placeholder="Masukan username">
                        <div class="invalid-feedback">
                            <?= $validation->getError('username') ?>
                        </div>
                        <div id="emailHelp" class="form-text">Masukan username yang sudah terdaftar.</div>
                    </div>
                    <div class="mb-3 has-validation">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control <?= $validation->hasError('password') ? ' is-invalid' : '' ?>" id="exampleInputPassword1" value="<?= old('password') ?>" placeholder="Masukan password">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password') ?>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="submit" class="btn d-block btn-success me-2">Login</button>
                        <a href="<?= site_url('registrasi') ?>" class="btn btn-white">Buat Akun Baru</a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>