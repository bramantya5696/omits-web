<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-sm-12">
            <a class="btn btn-primary" href="<?= route_to('Admin::exportToExcel') ?>" target="_blank" rel="noopener noreferrer">Export</a>
        </div>
    </div>
    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-body">
                <?= $table ?>
            </div>
            <div class="ml-4">
                <?= $pager->links() ?>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>