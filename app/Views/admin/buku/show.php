<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="row p-0">
    <div class="col-12 col-md-6">
        <img src="<?= $buku->gambar == 'default.png' ? base_url('public/default.png') : base_url('public/uploads/buku/' . $buku->gambar) ?>" style="height:140px;width:140px;object-fit:cover" alt="...">
        <div class="table-responsive my-5">
            <table class="table table-striped table-borderless">
                <tr>
                    <td>ID</td>
                    <td><?= $buku->id ?></td>
                </tr>
                <tr>
                    <td>Judul</td>
                    <td><?= $buku->judul ?></td>
                </tr>
                <tr>
                    <td>Penerbit</td>
                    <td><?= $buku->penerbit ?></td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td><?= $buku->kategori ?></td>
                </tr>
                <tr>
                    <td>Penulis</td>
                    <td><?= $buku->penulis ?></td>
                </tr>
                <tr>
                    <td>Berat</td>
                    <td><?= $buku->berat ?></td>
                </tr>
                <tr>
                    <td>Dimensi</td>
                    <td><?= $buku->dimensi ?></td>
                </tr>
                <tr>
                    <td>Bahasa</td>
                    <td><?= $buku->bahasa ?></td>
                </tr>
                <tr>
                    <td>ISBN</td>
                    <td><?= $buku->ISBN ?></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><?= $buku->deskripsi ?></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td><?= $buku->harga ?></td>
                </tr>

                <tr>
                    <td>Created At</td>
                    <td><?= $buku->created_at ?></td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td><?= $buku->updated_at ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>