<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <a href="<?= route_to('admin/user/new') ?>" class="btn btn-primary text-nowrap me-1"><i class="bi bi-plus-lg"></i> <span class="d-none d-xl-inline">Tambah</span></a>
            <form class="d-flex" method="GET" action="">
                <input type="search" class="form-control me-1" name="search" value="<?= $_GET['search'] ?? null ?>" placeholder="Cari...">
                <button class="btn btn-primary"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <?= session()->has('create_success') ? session()->getFlashdata('create_success') : '' ?>
        <?= session()->has('delete_success') ? session()->getFlashdata('delete_success') : '' ?>
        <?= session()->has('get_failed') ? session()->getFlashdata('get_failed') : '' ?>

        <div class="table-responsive mb-3">
            <table class="table table-sm table-bordered table-striped text-nowrap">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Role</th>
                    <th scope="col">Dibuat</th>
                    <th scope="col">Aksi</th>
                </tr>
                <?php
                $no = 1 + ($pager->getPerPage() * ($pager->getCurrentPage() - 1));
                ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= word_limiter($user->username, 7, '...') ?></td>
                        <td><?= $user->password ?></td>
                        <td><?= $user->role ?></td>
                        <td><?= $user->created_at ?></td>
                        <td>
                            <a href="<?= site_url('admin/user/' . $user->id) ?>" class="btn btn-sm text-primary"><i class="bi bi-info-circle"></i></a>
                            <a href="<?= site_url('admin/user/' . $user->id . '/edit') ?>" class="btn btn-sm text-success"><i class="bi bi-pencil"></i></a>
                            <form onSubmit="event.preventDefault();deleteHandler(this);" action="<?= base_url('admin/user/' . $user->id) ?>" method="POST" class="form d-inline">
                                <input type="hidden" name="_method" value="DELETE" />
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-sm text-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="d-flex justify-content-between align-item-center">
            <?= $pager->makeLinks($pager->getCurrentPage(), $pager->getPerPage(), $pager->getTotal(), 'bootstrap_full') ?>
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