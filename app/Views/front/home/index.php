<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <?php foreach ($bukus as $buku) : ?>
        <div class="col-6 col-md-2 mb-4">
            <div class="card">
                <img src="<?= $buku->gambar == 'default.png' ? base_url('default.png') : base_url('uploads/buku/' . $buku->gambar) ?>" class="card-img-top" style="height:150px;object-fit:cover" alt="...">
                <div class="card-body">
                    <div class="my-2">
                        <span class="d-block"><a href="<?= site_url('iklan/' . $buku->id) ?>" class="text-decoration-none fw-bold text-secondary"><?= $buku->judul ?></a></span>
                        <span class="d-block">Rp<?= number_format($buku->harga, 2, '.', ',') ?></span>
                        <span class="badge bg-secondary d-inline-block"><?= $buku->kategori ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-sm btn-primary col me-1"><i class="bi bi-info-circle"></i></a>
                        <a href="#" class="btn btn-sm btn-success col"><i class="bi bi-cart4"></i></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>