<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-2">

</div>

<div class="row p-0">
    <div class="col-12">
        <h4>Laporan Penjualan</h4>
        <?= session()->has('create_success') ? session()->getFlashdata('create_success') : '' ?>
        <?= session()->has('delete_success') ? session()->getFlashdata('delete_success') : '' ?>
        <?= session()->has('get_failed') ? session()->getFlashdata('get_failed') : '' ?>
        <div class="table-responsive mb-3">
            <table class="table table-bordered table-striped table-sm text-nowrap">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tahun/Bulan</th>
                    <th scope="col">Total Terjual</th>
                    <th scope="col">Transaksi</th>
                    <th scope="col">Jumlah</th>
                </tr>
                <?php
                $no = 1 + ($pager->getPerPage() * ($pager->getCurrentPage() - 1));
                ?>
                <?php foreach ($laporans as $laporan) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('Y / F', strtotime("$laporan->tahun-$laporan->bulan")) ?></td>
                        <td><?= $laporan->total_terjual ?> Buku terjual</td>
                        <td><?= $laporan->total_transaksi ?> Transaksi</td>
                        <td>Rp <?= number_format($laporan->total_pemasukan, 2, '.', ',') ?></td>
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
    function deleteHandle(e, el) {
        e.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ms-1',
                cancelButton: 'btn btn-danger'
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
                el.submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
        return false;

    }
</script>
<?= $this->endSection() ?>