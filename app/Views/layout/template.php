<?= $this->include('layout/header') ?>
<div class="container container-fluid" style="min-height:70vh;">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 mx-auto">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</div>
<!-- /content -->
<?= $this->include('layout/footer') ?>