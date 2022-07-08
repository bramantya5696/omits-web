<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <?php if ($msg = session()->getFlashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= $msg ?>
        </div>
    <?php endif ?>
    <?php if ($msg = session()->getFlashdata('msg')) : ?>
        <div class="alert alert-danger">
            <?= $msg ?>
        </div>
    <?php endif; ?>
    <form action="<?= route_to('Peserta::changePassword') ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="old_pass">Password sekarang</label>
            <input type="password" class="form-control" name="old_pass" id="old_pass" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="password">Password baru</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password Baru">
        </div>
        <div class="form-group">
            <label for="confirm_pass">Konfirmasi password baru</label>
            <input type="password" class="form-control" name="confirm_pass" id="confirm_pass" placeholder="Konfirmasi Password Baru">
        </div>

        <button class="btn btn-primary" type="submit">Simpan</button>

    </form>
</div>

<?= $this->endSection() ?>