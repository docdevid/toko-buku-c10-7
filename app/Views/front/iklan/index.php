<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<h1 class="display-6 fw-bold mb-4">Semua Iklan</h1>
<div class="row">
    <?php if ($iklans) : ?>
        <?php foreach ($iklans as $iklan) : ?>
            <div class="col-6 col-md-3 mb-4">
                <div class="card border-0 shadow">
                    <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                    <img src="<?= $iklan->gambar == 'default.png' ? base_url('default.png') : base_url('uploads/iklan/' . $iklan->gambar) ?>" class="card-img-top" style="height:120px;object-fit:cover" alt="...">
                    <div class="card-body text-center">
                        <span class="badge bg-primary"><?= $iklan->kategori ?></span> <span class="badge bg-<?= $iklan->status == 'aktif' ? 'success' : 'danger' ?>"><?= $iklan->status ?></span>
                        <h5 class="card-title text-success "><a href="<?= site_url('iklan/' . $iklan->id) ?>" class="btn btn-white text-success fw-bolder"><?= $iklan->judul ?></a></h5>
                        <small><?= $iklan->nama_lengkap ?></small>
                        <p class="card-text"><i class="bi bi-calendar-check-fill me-2"></i> <small class="text-muted"><?= date('d F Y', strtotime($iklan->created_at)) ?></small></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="d-flex justify-content-between align-item-center">
            <?= $pager->makeLinks($pager->getCurrentPage(), $pager->getPerPage(), $pager->getTotal(), 'bootstrap_full') ?>
        </div>
    <?php else : ?>
        <div class="col-12">
            <div class="alert alert-danger">
                <?php if (isset($_GET['search']) && $_GET['search'] != '') : ?>
                    <i class="fa fa-info-circle"></i> Kata kunci tidak cocok dengan iklan apapun disini, coba kata kunci lain.
                <?php else : ?>
                    <i class="fa fa-info-circle"></i> Tidak ada iklan di kategori ini
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>