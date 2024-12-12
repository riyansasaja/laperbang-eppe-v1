<?= $this->extend('dashboard/layout') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>

<div class="col-sm-6">
    <h1 class="m-0">Perkara Banding</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Perkara Banding</li>
    </ol>
</div><!-- /.col -->

<?= $this->endSection() ?>

<?= $this->section('main') ?>

<?php
d($perkara);
?>

<div class="row">
    <div class="col">

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm" id="dataPerkara">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nomor Perkara</th>
                        <th scope="col">Jenis Perkara</th>
                        <th scope="col">Nomor Banding</th>
                        <th scope="col">Tgl Upload</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>



    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/panitera_getbanding.js') ?>"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js"></script>
<?= $this->endSection() ?>