<?= $this->extend('dashboard/layout') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>
<div class="col-sm-6">
    <h1 class="m-0">Penentuan PRA PMH / PMH</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">PMH/Pra PMH</li>
    </ol>
</div><!-- /.col -->
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="row">
    <div class="col">
        <?php $prapmh = false; ?>

        <?php if (!$prapmh) : ?>

            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col text-center">
                            <img src="assets/img/undraw_ok.png" alt="image-ok" class="img-fluid" width="75%">
                        </div>
                        <div class="col">
                            <h2 class="text-info">Belum ada perkara untuk ditentukan PMH. <br> Terimakasih!!</h2>
                        </div>
                    </div>

                </div>
            </div>

        <?php else : ?>

            <div class="card ">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nomor Perkara</th>
                                    <th scope="col">PA Pengaju</th>
                                    <th scope="col">Jenis Berkas</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>




                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <?php endif; ?>



    </div>
</div>

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
<script src="<?= base_url('assets/js/validator.js') ?>"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js"></script>
<?= $this->endSection() ?>