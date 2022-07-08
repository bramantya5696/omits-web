<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="card col-sm-12">
            <div class="card-body">
                <form class="form-inline" action="<?= route_to('Dashboard::listUser') ?>" method="get">
                    <div class="form-group mr-4">
                        <label for="kategori">Status:</label>
                        <select class="form-control ml-2" id="kategori" name="kategori">
                            <option value="0">Semua</option>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['id'] ?>" <?= $req->getGet('kategori') == $role['id'] ? 'selected' : '' ?>>
                                    <?= $role['name'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="search" id="search" placeholder="Cari nama / email..." autocomplete="off">
                    </div>
                    <button class="btn btn-primary" type="submit">Cari</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card shadow mb-4 w-100">
            <div class="card-header">
                <a class="btn btn-primary" href="<?= route_to('Admin::exportToExcel') ?>" target="_blank" rel="noopener noreferrer">Export</a>
            </div>
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