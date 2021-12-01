<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="card shadow border-0">
    <div class="card-body">
        <div class="row p-0 p-md-4">
            <div class="col-12">
                <h4 class="fw-bold">Detail <?= $title ?></h4>
                <p class="text-muted">Berikut adalah detail data pengguna</p>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Username</td>
                                    <td><?= $user->username ?></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>*******</td>
                                </tr>
                                <tr>
                                    <td>Dibuat Pada</td>
                                    <td><?= $user->created_at ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                    </td>
                                </tr>
                            </table>
                            <img class="img-thumbnail" src="<?= $user->gambar != '' && $user->gambar != 'default.png' ? base_url('public/upload/user/' . $user->gambar) : base_url('public/default.png') ?>" class="rounded" style="width:100%;height:200px;object-fit:cover;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>