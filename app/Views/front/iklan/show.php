<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<p class="card-text"><i class="bi bi-calendar-check-fill me-2"></i> <small class="text-muted"><?= date('d F Y', strtotime($iklan->created_at)) ?></small></p>
<h1 class="display-6 fw-bold mb-4"><?= $iklan->judul ?></h1>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="card shadow border-0">
            <div class="card-body">
                <h1 class="display-7 fw-bold mb-4 text-muted">Info Barang</h1>
                <p>Berikut adalah informasi barang hilang</p>
                <hr />
                <div class="table-responsive">
                    <table class="table table-lg table-borderless">
                        <tr>
                            <td colspan="2"><img src="<?= $iklan->gambar == 'default.png' ? base_url('default.png') : base_url('uploads/iklan/' . $iklan->gambar) ?>" style="width:100%;object-fit:cover"></td>
                        </tr>
                        <tr>
                            <td>ID Iklan</td>
                            <td><b>#<?= $iklan->id ?></b></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td><b><small class="text-muted"><?= date('d F Y', strtotime($iklan->created_at)) ?></small></b></td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td><b><?= $iklan->kategori ?></b></td>
                        </tr>
                        <tr>
                            <td>Lokasi Barang Hilang</td>
                            <td><b><?= $iklan->lokasi ?></b></td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td><b><?= $iklan->deskripsi ?></b></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><b><span class="badge bg-<?= $iklan->status == 'aktif' ? 'success' : 'danger' ?>"><?= $iklan->status ?></span></b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card shadow border-0">
            <div class="card-body">
                <h1 class="display-7 fw-bold mb-4 text-muted">Info Pengiklan</h1>
                <p>Berikut adalah informasi pengiklan lengkap beserta informasi kontak</p>
                <hr />
                <div class="table-responsive">
                    <table class="table table-lg table-borderless">
                        <tr>
                            <td>Pengiklan</td>
                            <td><b><?= $iklan->nama_lengkap ?></b></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><b><?= $iklan->user_email ?></b></td>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td><b><?= $iklan->user_no_hp ?></b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>