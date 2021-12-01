<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <?= session()->has('cart_create_success') ? session()->getFlashdata('cart_create_success') : '' ?>
    <?php foreach ($bukus as $buku) : ?>
        <div class="col-6 col-md-2 mb-4">
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
<?= $this->endSection() ?>