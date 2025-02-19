<?= $this->extend('dashboard/layout') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>

<div class="col-sm-6">
    <h1 class="m-0">Tambah Perkara Banding</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('/user/banding') ?>">Perkara Banding</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Perkara Banding</li>
    </ol>
</div><!-- /.col -->

<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <!-- form add perkara -->
                <?= form_open('user/addbanding') ?>
                <?= form_hidden('id_user', user()->id) ?>
                <?= form_hidden('status', 'Input Perkara'); ?>
                <div class="row mb-3">
                    <label for="no_perkara" class="col-sm-4 col-form-label">Nomor Perkara</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="no_perkara" name="no_perkara" value="<?= set_value('no_perkara') ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jenis_perkara" class="col-sm-4 col-form-label">Jenis Perkara</label>
                    <div class="col-sm-5">
                        <select name="jenis_perkara" id="jenis_perkara" class="form-control">
                            <option value="">--Pilih Salah Satu--</option>
                            <?php foreach ($perkaras as $perkara): ?>
                                <option value="<?= $perkara['nama_jp'] ?>"><?= $perkara['nama_jp'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <input class="form-control mt-3" type="text" placeholder="Input Jenis Perkara Lainnya" id="otheroption" hidden>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pihak_p" class="col-sm-4 col-form-label">Nama Pihak Penggugat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control text-uppercase" id="pihak_p" name="pihak_p" value="<?= set_value('pihak_p') ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="hp_pihak_p" class="col-sm-4 col-form-label">Whatsapp Pihak Penggugat</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="hp_pihak_p" name="hp_pihak_p" value="<?= set_value('hp_pihak_p') ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pihak_t" class="col-sm-4 col-form-label">Nama Pihak Tergugat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control text-uppercase" id="pihak_t" name="pihak_t" value="<?= set_value('pihak_t') ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="hp_pihak_t" class="col-sm-4 col-form-label">Whatsapp Pihak Tergugat</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" id="hp_pihak_t" name="hp_pihak_t" value="<?= set_value('hp_pihak_t') ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/add_banding.js') ?>"></script>
<?= $this->endSection() ?>