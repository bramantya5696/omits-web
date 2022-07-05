<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <?= $table ?>
        </div>
        <div class="ml-4">
            <?= $pager->links() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>