<?= $this->include('layout/header') ?>
<div class="container-fluid" style="margin-top:-48px;padding:0px;overflow:hidden;">
    <?= $this->renderSection('content') ?>
</div>
<!-- /content -->
<div style="margin-top:-48px;">
    <?= $this->include('layout/footer') ?>
</div>