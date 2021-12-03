<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div id="carouselExampleCaptions" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php foreach ($bukus_slide as $key => $buku_slide) : ?>
            <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
                <img src="<?= $buku_slide->gambar == '' || $buku_slide->gambar == 'default.png' ? base_url('public/default.png') : base_url('public/uploads/buku/' . $buku_slide->gambar) ?>" class="d-block w-100" style="height:400px;object-fit:cover;" alt="...">
                <div class="carousel-caption d-none d-md-block text-dark">
                    <h5 class="fw-bold"><?= $buku_slide->judul ?></h5>
                    <p><?= character_limiter($buku_slide->deskripsi, 50) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="row">
    <?= session()->has('cart_create_success') ? session()->getFlashdata('cart_create_success') : '' ?>
    <div class="col-12 col-md-3">
        <?= $this->include('front/buku/_side_kategori') ?>
    </div>
    <div class="col-12 col-md-9 row">
        <?php foreach ($bukus as $buku) : ?>
            <div class="col-6 col-md-3 mb-4">
                <div class="card">
                    <img src="<?= $buku->gambar == 'default.png' ? base_url('public/default.png') : base_url('public/uploads/buku/' . $buku->gambar) ?>" class="card-img-top" style="height:250px;object-fit:cover" alt="...">
                    <div class="card-body">
                        <div class="my-2">
                            <span class="d-block"><a href="<?= site_url('iklan/' . $buku->id) ?>" class="text-decoration-none fw-bold text-secondary"><?= $buku->judul ?></a></span>
                            <span class="d-block">Rp<?= number_format($buku->harga, 2, '.', ',') ?></span>
                            <span class="badge bg-secondary d-inline-block"><?= $buku->kategori ?></span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('buku/' . $buku->id) ?>" class="btn btn-sm btn-primary flex-fill me-1"><i class=" bi bi-info-circle"></i></a>
                            <form method="POST" action="<?= site_url('cart') ?>" class="flex-fill d-flex">
                                <?= csrf_field() ?>
                                <input type="hidden" name="buku_id" value="<?= $buku->id ?>">
                                <button type="submit" class="btn btn-sm btn-success flex-fill"><i class="bi bi-cart4"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="d-flex justify-content-between align-item-center">
            <?= $pager->makeLinks($pager->getCurrentPage(), $pager->getPerPage(), $pager->getTotal(), 'bootstrap_full') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>