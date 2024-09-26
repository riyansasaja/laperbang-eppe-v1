v<?= $this->extend('dashboard/layout') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>

<!--begin::Row-->
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Validasi Berkas</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('validator/') ?>">Verifikasi Berkas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Check File</li>
        </ol>
    </div>
</div> <!--end::Row-->

<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="row">
    <div class="col-md-9">

        <div class="ratio ratio-4x3">
            <iframe src="<?= base_url('uploads/') . $file['username'] . '/' . clear($file['no_perkara']) . '/' . $file['bundel'] . '/' . $file['nama_file'] ?>" frameborder="0" allowfullscreen></iframe>
        </div>


    </div> <!-- End Col -->

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <?= form_open('validator/validate'); ?>
                <?= form_hidden('nama_file', $file['nama_file']); ?>
                <?= form_hidden('bundel', $file['bundel']); ?>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Komentar</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="komentar"></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-sm" name="sesuai">Sesuai</button>
                    <button type="submit" class="btn btn-danger btn-sm" name="tidak">Tidak Sesuai</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div> <!-- end col -->

</div> <!-- End row -->

<!-- Modal -->
<div class="modal fade" id="actionValidasi" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/user_banding.js') ?>"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js"></script>
<?= $this->endSection() ?>