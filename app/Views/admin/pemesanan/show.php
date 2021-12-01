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
                    <td><b>Status Pemabayaran</b></td>
                    <td><span class="badge bg-success">Berhasil</span></td>
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
        <div class="card my-2">
            <div class="card-body">
                <h4>Status Pembayaran</h4>
                <form method="POST" action="<?= site_url('admin/status-pembayaran') ?>">
                    <?= csrf_field() ?>
                    <input type="hidden" name="pemesanan_id" value="<?= $pemesanan->id  ?>" />
                    <select name="status" class="form-control">
                        <option value="">Pilih Status</option>
                        <option value="dibayar" <?= old('status') == 'dibayar' ? 'selected' : '' ?>>Dibayar</option>
                        <option value="belum dibayar" <?= old('status') == 'belum dibayar' ? 'selected' : '' ?>>Belum Dibayar</option>
                    </select>
                    <button type="submit" class="btn btn-success mt-3">Ubah Status</button>
                </form>
            </div>
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


    </div>
</div>
<?= $this->endSection() ?>