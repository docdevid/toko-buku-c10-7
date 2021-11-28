<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row p-0 p-md-4">
    <div class="col-12">
        <h4 class="fw-bold text-success mb-5"><?= $title ?></h4>
        <div class="row">
            <div class="col-12 col-md-4 mb-2 mb-md-0">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h2 class="card-title"><i class="bi bi-people"></i></h2>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-subtitle mb-2">Total</h6>
                            <h4><?= count($count_user) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>