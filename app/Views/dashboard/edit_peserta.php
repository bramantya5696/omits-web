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
    <form action="<?= route_to('Peserta::editProfil') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="id" id="id" value="<?= $user['id'] ?>">
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nama" value="<?= $user['name'] ?>">
        </div>
        <div class="form-group">
            <label for="sekolah">Sekolah</label>
            <input type="text" class="form-control" name="sekolah" id="sekolah" placeholder="Sekolah" value="<?= $user['sekolah'] ?>">
        </div>
        <div class="form-group">
            <label for="nisn">NISN/NIM</label>
            <input type="text" class="form-control" name="nisn" id="nisn" placeholder="NISN/NIM" value="<?= $user['nisn'] ?>">
        </div>
        <div class="form-group">
            <label for="wa">No. WA</label>
            <input type="text" class="form-control" name="wa" id="wa" placeholder="No. WA" value="<?= $user['wa'] ?>">
        </div>
        <div class="form-group">
            <label for="kota">Kota</label>
            <input type="text" class="form-control" name="kota" id="kota" placeholder="Kota" value="<?= $user['kota'] ?>">
        </div>
        <div class="form-group">
            <label for="provinsi">Provinsi</label>
            <input type="text" class="form-control" name="provinsi" id="provinsi" placeholder="Provinsi" value="<?= $user['provinsi'] ?>">
        </div>
        <div class="form-group">
            <label for="bukti_nisn">Upload bukti NISN</label>
            <input type="file" class="form-control-file" id="bukti_nisn" name="bukti_nisn">
        </div>

        <button class="btn btn-primary" type="submit">Simpan</button>

    </form>
</div>

<?= $this->endSection() ?>