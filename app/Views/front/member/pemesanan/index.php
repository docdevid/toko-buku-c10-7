<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="row p-0">
    <div class="col-12">
        <?= session()->has('create_success') ? session()->getFlashdata('create_success') : '' ?>
        <?= session()->has('delete_success') ? session()->getFlashdata('delete_success') : '' ?>
        <?= session()->has('get_failed') ? session()->getFlashdata('get_failed') : '' ?>
        <div class="table-responsive mb-3">
            <table class="table table-bordered table-striped table-sm text-nowrap">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Id Pemesanan</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">No HP</th>
                    <th scope="col-2">Alamat</th>
                    <th scope="col">Status</th>
                    <th scope="col">Dibuat</th>
                    <th scope="col">Aksi</th>
                </tr>
                <?php
                $no = 1 + ($pager->getPerPage() * ($pager->getCurrentPage() - 1));
                ?>
                <?php foreach ($pemesanans as $pemesanan) : ?>
                    <tr>
                        <td scope="col"><?= $no++ ?></td>
                        <td scope="col">#<?= $pemesanan->id ?></td>
                        <td scope="col"><?= $pemesanan->nama_lengkap ?></td>
                        <td scope="col"><?= $pemesanan->no_hp ?></td>
                        <td scope="col"><?= character_limiter($pemesanan->alamat, 50) ?></td>
                        <td scope="col"><?= $pemesanan->status_pembayaran_status == '' || $pemesanan->status_pembayaran_status == 'belum dibayar' ? '<span class="badge bg-warning">Belum dibayar</span>' : '<span class="badge bg-success">Dibayar</span>'  ?></td>
                        <td scope="col"><?= $pemesanan->created_at ?></td>
                        <td scope="col">
                            <a href="<?= site_url('member/pemesanan/' . $pemesanan->id) ?>" class="btn btn-sm text-primary"><i class="bi bi-info-circle"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="d-flex justify-content-between align-item-center">
            <?= $pager->makeLinks($pager->getCurrentPage(), $pager->getPerPage(), $pager->getTotal(), 'bootstrap_full') ?>
            <span class="text-muted small">
                Total data <?= $pager->getTotal() ?>
            </span>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    let dialogShowDelete = true;

    function deleteHandler(e) {
        if (dialogShowDelete) {
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
                    dialogShowDelete = false;
                    e.dispatchEvent(new Event('submit'));
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    dialogShowDelete = true;
                }
            })
        }
    }
</script>
<?= $this->endSection() ?>