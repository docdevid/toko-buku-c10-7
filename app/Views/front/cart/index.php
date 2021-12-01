<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12 col-md-8">
        <div class="d-flex justify-content-between">
            <h4 class="fw-bold mb-4">Informasi Pemesan</h4>
        </div>
        <?php if (!isLoggedIn()) : ?>
            <?= alert('success', 'Anda harus <a href="' . site_url('login') . '">login</a> sebagai member terlebih dahulu untuk melanjutkan proses pembayaran') ?>
        <?php else : ?>
            <?= $this->include('front/member/pemesanan/_form') ?>
        <?php endif; ?>
    </div>
    <div class="col-12 col-md-4">
        <div class="d-flex justify-content-between">
            <h4 class="fw-bold mb-4">Keranjang kamu</h4>
            <h4 class="fw-bold mb-4"><span class="badge bg-primary"><?= session()->has('cart_items') ? count(session()->get('cart_items')) : '0' ?></span></h4>
        </div>
        <ul class="list-group">
            <?php
            $total = array_sum(array_column($bukus, 'harga'));
            ?>
            <?php
            $qty = 0;
            $sub_total = 0;
            $total = 0;
            foreach ($bukus as $buku) :
                $qty = array_count_values(session()->get('cart_items'))[$buku->id];
                $sub_total  = $qty * $buku->harga;
                $total  += $sub_total;
            ?>

                <li class="list-group-item d-flex justify-content-between">
                    <div class="d-flex flex-column">
                        <span><?= $buku->judul ?></span>
                        <span class="fst-italic fw-light">(qty <?= $qty ?>)</span>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                        <span class="text-warning">Rp <?= number_format(($buku->harga), 2) ?> </span>
                        <span class="text-warning small">Sub total Rp <?= number_format(($sub_total), 2) ?> </span>
                    </div>
                </li>
            <?php endforeach; ?>

            <li class="list-group-item d-flex justify-content-between">
                <span>Total</span>
                <span>Rp <?= number_format($total, 2) ?></span>
            </li>
        </ul>

    </div>
</div>
<?= $this->endSection() ?>