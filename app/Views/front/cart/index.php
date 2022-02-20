<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12 col-md-7">
        <div class="d-flex justify-content-between">
            <h4 class="fw-bold mb-4">Informasi Pemesan</h4>
        </div>
        <?php if (!isLoggedIn()) : ?>
            <?= alert('success', 'Anda harus <a href="' . site_url('login') . '">login</a> sebagai member terlebih dahulu untuk melanjutkan proses pembayaran') ?>
        <?php else : ?>
            <?= $this->include('front/member/pemesanan/_form') ?>
        <?php endif; ?>
    </div>
    <div class="col-12 col-md-5">
        <div class="d-flex justify-content-between">
            <h4 class="fw-bold mb-4">Keranjang kamu</h4>
            <h4 class="fw-bold mb-4"><span class="badge bg-primary"><?= count($bukus) ?></span></h4>
        </div>
        <ul class="list-group">
            <?php
            $sub_total = 0;
            foreach ($bukus as $buku) : ?>

                <li class="list-group-item d-flex justify-content-between">
                    <div class="d-flex flex-column">
                        <span><?= $buku['name'] ?></span>
                        <div class="col-5 d-flex justify-content-around">
                            <form class="d-flex me-5" method="POST" action="<?= site_url('cart/' . $buku['id']) ?>">
                                <input type="hidden" name="_method" value="put" />
                                <input type="hidden" name="rowid" value="<?= $buku['rowid'] ?>" />
                                <input type="number" class="form-control form-control-sm col-1 me-1" name="qty" value="<?= $buku['qty'] ?>">
                                <button class="btn btn-sm btn-success"><i class="bi bi-check-lg"></i></button>
                            </form>
                            <form method="POST" action="<?= site_url('cart/' . $buku['rowid']) ?>">
                                <input type="hidden" name="_method" value="delete" />
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                        <span class="text-warning">Rp <?= number_format(($buku['price']), 2) ?> </span>
                        <span class="text-warning small">Sub total Rp <?= number_format(($buku['subtotal']), 2) ?> </span>
                    </div>
                </li>
            <?php $sub_total += $buku['subtotal'];
            endforeach; ?>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total</span>
                <span>Rp <?= number_format($sub_total, 2) ?></span>
            </li>
        </ul>

    </div>
</div>
<?= $this->endSection() ?>