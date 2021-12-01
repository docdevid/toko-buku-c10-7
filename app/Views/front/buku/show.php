<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="row p-0">
    <div class="col-12 mb-4">
        <h1 class="fw-bold text-uppercase"><?= $buku->judul ?></h1>
        <span class="badge bg-secondary"><?= $buku->kategori ?></span>
    </div>

    <div class="col-12 col-md-2 mb-4 mb-md-0">
        <img src="<?= $buku->gambar == 'default.png' ? base_url('public/default.png') : base_url('public/uploads/buku/' . $buku->gambar) ?>" style="height:240px;width:100%;object-fit:cover" class="rounded shadow-sm" alt="...">
    </div>
    <div class="col-12 col-md-10">
        <div class="table-responsive">
            <table class="table table-striped table-sm table-borderless">
                <tr>
                    <td><b>ID</b></td>
                    <td><?= $buku->id ?></td>
                </tr>
                <tr>
                    <td><b>Judul</b></td>
                    <td><?= $buku->judul ?></td>
                </tr>
                <tr>
                    <td><b>Penerbit</b></td>
                    <td><?= $buku->penerbit ?></td>
                </tr>
                <tr>
                    <td><b>Kategori</b></td>
                    <td><?= $buku->kategori ?></td>
                </tr>
                <tr>
                    <td><b>Penulis</b></td>
                    <td><?= $buku->penulis ?></td>
                </tr>
                <tr>
                    <td><b>Berat</b></td>
                    <td><?= $buku->berat ?></td>
                </tr>
                <tr>
                    <td><b>Dimensi</b></td>
                    <td><?= $buku->dimensi ?></td>
                </tr>
                <tr>
                    <td><b>Bahasa</b></td>
                    <td><?= $buku->bahasa ?></td>
                </tr>
                <tr>
                    <td><b>ISBN</b></td>
                    <td><?= $buku->ISBN ?></td>
                </tr>
                <tr>
                    <td><b>Deskripsi</b></td>
                    <td><?= $buku->deskripsi ?></td>
                </tr>
                <tr>
                    <td><b>Harga</b></td>
                    <td>Rp <?= number_format($buku->harga, 2) ?></td>
                </tr>
            </table>
            <div class="d-flex justify-content-between mt-2">
                <a href="#" class="btn btn-success col-12 col-md-2"><i class="bi bi-cart4"></i></a>
            </div>
        </div>
    </div>
    <div class="col-12 mb-2">
    </div>
</div>

<?= $this->endSection() ?>