<?= $this->extend('dashboard/layout') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>

<div class="col-sm-6">
    <h1 class="m-0">Edit Perkara Banding</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('/user/banding') ?>">Perkara Banding</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Perkara Banding</li>
    </ol>
</div><!-- /.col -->

<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <!-- form add perkara -->
                <?= form_open('user/editbanding/' . $detilperkara['id_perkara']) ?>
                <?= form_hidden('status', 'Perubahan Detil Perkara'); ?>
                <div class="row mb-3">
                    <label for="no_perkara" class="col-sm-4 col-form-label">Nomor Perkara</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="no_perkara" name="no_perkara" value="<?= $detilperkara['no_perkara'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jenis_perkara" class="col-sm-4 col-form-label">Jenis Perkara</label>
                    <div class="col-sm-5">
                        <select id="jenis_perkara" class="form-control">
                            <option value="">--Pilih Salah Satu--</option>
                            <?php foreach ($perkaras as $perkara): ?>
                                <option value="<?= $perkara['nama_jp'] ?>" <?= ($perkara['nama_jp'] == "Lain-lain") ? 'selected' : '' ?>><?= $perkara['nama_jp'] ?></option>
                            <?php endforeach ?>

                        </select>
                        <input class="form-control mt-3" type="text" name="jenis_perkara" placeholder="Input Jenis Perkara Lainnya" id="otheroption" value="<?= $detilperkara['jenis_perkara'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pihak_p" class="col-sm-4 col-form-label">Nama Pihak Penggugat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control text-uppercase" id="pihak_p" name="pihak_p" value="<?= $detilperkara['pihak_p'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="hp_pihak_p" class="col-sm-4 col-form-label">Whatsapp Pihak Penggugat</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="hp_pihak_p" name="hp_pihak_p" value="<?= $detilperkara['hp_pihak_p'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pihak_t" class="col-sm-4 col-form-label">Nama Pihak Tergugat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control text-uppercase" id="pihak_t" name="pihak_t" value="<?= $detilperkara['pihak_t'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="hp_pihak_t" class="col-sm-4 col-form-label">Whatsapp Pihak Tergugat</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" id="hp_pihak_t" name="hp_pihak_t" value="<?= $detilperkara['hp_pihak_t'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/edit_banding.js') ?>"></script>
<?= $this->endSection() ?>