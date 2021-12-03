  <?php
    $kategoriModel = model('KategoriModel');
    ?>
  <h4 class="fw-bold">Kategori</h4>
  <ul class="list-group">
      <?php foreach ($kategoriModel->find() as $kategori) : ?>
          <a href="<?= site_url('buku/kategori/' . $kategori->id) ?>" class="list-group-item list-group-item-action <?= url_is('buku/kategori/' . $kategori->id) ? 'active' : '' ?>" aria-current="true">
              <?= $kategori->kategori ?>
          </a>
      <?php endforeach; ?>
  </ul>