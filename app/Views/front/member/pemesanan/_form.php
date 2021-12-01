<form action="<?= base_url('member/pemesanan') ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?= session()->get('userdata')->id ?>" />
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control<?= $validation->hasError('nama_lengkap') ? ' is-invalid' : '' ?>" name="nama_lengkap" id="nama_lengkap" value="<?= old('nama_lengkap') ? old('nama_lengkap') : ($user ? $user->nama_lengkap : '') ?>">
                <div id="validationServerNama_lengkapFeedback" class="invalid-feedback">
                    <?= $validation->hasError('nama_lengkap') ? $validation->getError('nama_lengkap') : '' ?>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control<?= $validation->hasError('username') ? ' is-invalid' : '' ?>" name="username" id="username" value="<?= old('username') ? old('username') : ($user ? $user->username : '') ?>">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    <?= $validation->hasError('username') ? $validation->getError('username') : '' ?>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label">No HP</label>
        <input type="text" class="form-control<?= $validation->hasError('no_hp') ? ' is-invalid' : '' ?>" name="no_hp" id="no_hp" value="<?= old('no_hp') ? old('no_hp') : ($user ? $user->no_hp : '') ?>">
        <div id="validationServerNo_hpFeedback" class="invalid-feedback">
            <?= $validation->hasError('no_hp') ? $validation->getError('no_hp') : '' ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control<?= $validation->hasError('email') ? ' is-invalid' : '' ?>" name="email" id="email" value="<?= old('email') ? old('email') : ($user ? $user->email : '') ?>">
        <div id="validationServerEmailFeedback" class="invalid-feedback">
            <?= $validation->hasError('email') ? $validation->getError('email') : '' ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Alamat</label>
        <textarea class="form-control<?= $validation->hasError('alamat') ? ' is-invalid' : '' ?>" name="alamat" id="alamat" rows="3"><?= old('alamat') ? old('alamat') : ($user ? $user->alamat : '') ?></textarea>
        <div id="validationServerAlamatFeedback" class="invalid-feedback">
            <?= $validation->hasError('alamat') ? $validation->getError('alamat') : '' ?>
        </div>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary">Konfirmasi</button>
    </div>
</form>