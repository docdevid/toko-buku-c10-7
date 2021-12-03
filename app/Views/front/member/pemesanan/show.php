<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12 col-md-8">
        <h4 class="fw-bold mb-4">Detail Pemesanan</h4>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td><b>Invoice</b></td>
                    <td>#<?= $pemesanan->id ?></td>
                </tr>
                <tr>
                    <td><b>Status Pembayaran</b></td>
                    <td><?= $pemesanan->status_pembayaran_status == '' || $pemesanan->status_pembayaran_status == 'belum dibayar' ? '<span class="badge bg-warning">Belum dibayar</span>' : '<span class="badge bg-success">Dibayar</span>'  ?></td>
                </tr>
                <tr>
                    <td><b>Nama lengkap</b></td>
                    <td><?= $pemesanan->nama_lengkap ?></td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td><?= $pemesanan->email ?></td>
                </tr>
                <tr>
                    <td><b>Alamat</b></td>
                    <td><?= character_limiter($pemesanan->alamat, 50) ?></td>
                </tr>
                <tr>
                    <td><b>Tanggal Pemesanan</b></td>
                    <td><?= $pemesanan->created_at ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="d-flex justify-content-between">
            <h4 class="fw-bold mb-4"></h4>
        </div>
        <ul class="list-group">
            <?php
            $total = 0;
            foreach ($detail_pemesanans as $detail) :
                $total += ($detail->qty * $detail->harga);
            ?>
                <li class="list-group-item d-flex justify-content-between">
                    <div class="d-flex flex-column">
                        <span><?= $detail->judul ?></span>
                        <span class="fst-italic fw-light">( QTY <?= $detail->qty ?>)</span>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                        <span class="text-warning">Rp <?= number_format($detail->harga, 2) ?> </span>
                        <span class="text-warning small">Sub total Rp <?= number_format($detail->sub_total, 2) ?></span>
                    </div>
                </li>
            <?php endforeach; ?>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total</span>
                <span>Rp <?= number_format($total, 2) ?></span>
            </li>
        </ul>

        <div class="card my-2">
            <div class="card-body bg-primary text-white">
                <h6 class="card-title">Petunjuk Pembayaran</h6>
                <small>Silahkan transfer ke :</small>
                <p>BANK BRI CAB. Bojongsoang A.n. PT Cloud Hosting Indonesia > No. Rekening 043-901-000-947-302 <span>Rp <?= number_format($total, 2) ?></span></p>
                <p class="small">Masukan berita <span class="fw-bold">INVOICE-<?= $pemesanan->id ?></span></p>
                <br />
                <p>Setelah proses pembayaran selesai, kami akan menghubungi via telp untuk memberikan informasi pengiriman, dan memastikan kelengkapan alamat anda </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>