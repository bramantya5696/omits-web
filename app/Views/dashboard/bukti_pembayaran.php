<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            Data berhasil disimpan
        </div>
    <?php endif ?>
    <?php if ($msg = session()->getFlashdata('msg')) : ?>
        <div class="alert alert-danger">
            <?= $msg ?>
        </div>
    <?php endif; ?>
    <form action="<?= route_to('Peserta::uploadPembayaran') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="bukti_bayar">Upload bukti pembayaran</label>
            <input type="file" class="form-control-file" id="bukti_bayar" name="bukti_bayar">
        </div>

        <button class="btn btn-primary" type="submit">Simpan</button>

    </form>
</div>

<?= $this->endSection() ?>