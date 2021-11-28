<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<h1 class="display-6 fw-bold mb-4"><?= getAppName() ?></h1>
<div class="p-3 mb-4 bg-white rounded-3 shadow">
    <div class="container-fluid pb-5">
        <p class="col-md-8 fs-4">Apa itu caribaranghilang.com ?</p>
        <p>Salah satu media yang membantu orang-orang membuat iklan barang mereka yang hilang secara gratis. Media ini akan mempertemukan penemu barang dan pemilik untuk saling bertemu</p>
        <a href="<?= base_url('iklan') ?>" class="btn btn-success btn-lg" type="button">Lebih banyak ...</a>
        <a href="<?= base_url('login') ?>" class="btn btn-primary btn-lg" type="button">Login</a>
    </div>
</div>
<div class="row">
    <h6 class="display-6 fw-bold mb-4">Iklan terbaru</h6>
    <?php foreach ($iklans as $iklan) : ?>
        <div class="col-6 col-md-3 mb-4">
            <div class="card border-0 shadow">
                <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                <img src="<?= $iklan->gambar == 'default.png' ? base_url('default.png') : base_url('uploads/iklan/' . $iklan->gambar) ?>" class="card-img-top" style="height:120px;object-fit:cover" alt="...">
                <div class="card-body text-center">
                    <span class="badge bg-primary"><?= $iklan->kategori ?> </span> <span class="badge bg-<?= $iklan->status == 'aktif' ? 'success' : 'danger' ?>"><?= $iklan->status ?></span>
                    <h5 class="card-title text-success "><a href="<?= site_url('iklan/' . $iklan->id) ?>" class="btn btn-white text-success fw-bolder"><?= $iklan->judul ?></a></h5>
                    <small><?= $iklan->nama_lengkap ?></small>
                    <p class="card-text"><i class="bi bi-calendar-check-fill me-2"></i> <small class="text-muted"><?= date('d F Y', strtotime($iklan->created_at)) ?></small></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>