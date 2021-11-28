<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <h6 class="display-6 fw-bold me-2">Iklan</h6>
        </div>

        <div class="dropdown">
            <a class="btn btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Kategori
            </a>
            <?php $kategoriModel = model('KategoriModel') ?>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="<?= site_url('admin/iklan') ?>">Semua Kategori</a></li>
                <?php foreach ($kategoriModel->find() as $kategori) : ?>
                    <li><a class="dropdown-item" href="<?= site_url('admin/iklan/kategori/' . $kategori->id) ?>"><?= $kategori->kategori ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <?= session()->has('create_success') ? session()->getFlashdata('create_success') : '' ?>
    <?= session()->has('delete_success') ? session()->getFlashdata('delete_success') : '' ?>
    <?= session()->has('get_failed') ? session()->getFlashdata('get_failed') : '' ?>

    <?php if ($iklans) : ?>
        <?php foreach ($iklans as $iklan) : ?>
            <div class="col-6 col-md-3 mb-4">
                <div class="card border-0 shadow">
                    <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                    <img src="<?= $iklan->gambar == 'default.png' ? base_url('default.png') : base_url('uploads/iklan/' . $iklan->gambar) ?>" class="card-img-top" style="height:120px;object-fit:cover" alt="...">
                    <div class="card-body text-center">
                        <span class="badge bg-primary"><?= $iklan->kategori ?></span> </span> <span class="badge bg-<?= $iklan->status == 'aktif' ? 'success' : 'danger' ?>"><?= $iklan->status ?></span>
                        <h5 class="card-title text-success "><a href="<?= site_url('iklan/' . $iklan->id) ?>" class="btn btn-white text-success fw-bolder"><?= $iklan->judul ?></a> </h5>
                        <p class="card-text"><i class="bi bi-calendar-check-fill me-2"></i> <small class="text-muted"><?= date('d F Y', strtotime($iklan->created_at)) ?></small></p>
                        <div>
                            <a href="<?= site_url('admin/iklan/' . $iklan->id . '/edit') ?>" class="btn btn-sm text-success"><i class="bi bi-pencil"></i></a>
                            <form onSubmit="event.preventDefault();deleteHandler(this);" action="<?= base_url('admin/iklan/' . $iklan->id) ?>" method="POST" class="form d-inline">
                                <input type="hidden" name="_method" value="DELETE" />
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="col-12">
            <div class="alert alert-danger">
                <?php if (isset($_GET['search']) && $_GET['search'] != '') : ?>
                    <i class="fa fa-info-circle"></i> Kata kunci tidak cocok dengan iklan anda. coba kata kunci lain.
                <?php else : ?>
                    <i class="fa fa-info-circle"></i> Belum ada iklan terbaru
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="d-flex justify-content-between align-item-center">
        <?= $pager->makeLinks($pager->getCurrentPage(), $pager->getPerPage(), $pager->getTotal(), 'bootstrap_full') ?>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    function deleteHandler(e) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light me-2'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                e.submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                dialogShowDelete = true;
            }
        })
    }
</script>
<?= $this->endSection() ?>