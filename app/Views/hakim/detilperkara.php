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
        <li class="breadcrumb-item"><a href="<?= base_url('getbanding') ?>">Perkara Banding</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detil Perkara</li>
    </ol>
</div><!-- /.col -->

<?= $this->endSection() ?>

<?= $this->section('main') ?>

<?php
// d($perkara);
// d($bundela);
// d($bundelb);
// d(user()->getRoles());
?>

<div class="row">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <h4>Data Perkara</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th width='35%'>No Perkara</th>
                            <td><?= $perkara['no_perkara']; ?></td>
                        </tr>
                        <tr>
                            <th>No Banding</th>
                            <td><?= $perkara['no_banding']; ?></td>
                        </tr>
                        <tr>
                            <th>Nama Pihak P</th>
                            <td><?= $perkara['pihak_p']; ?></td>
                        </tr>
                        <tr>
                            <th>Nama Pihak T</th>
                            <td><?= $perkara['pihak_t']; ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Perkara</th>
                            <td><?= $perkara['jenis_perkara']; ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?= $perkara['status']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div> <!-- end Col -->
</div> <!-- end row -->


<div class="row">

    <div class="col">
        <div class="card">
            <div class="card-header bg-info">
                Bundel A
            </div>
            <div class="card-body">
                <table class="table">
                    <?php foreach ($bundela as $a) : ?>
                        <tr>
                            <td>
                                <a href="<?= base_url('uploads/') . $user->username . '/' . clear($perkara['no_perkara'])  . '/' . 'bundela/' . $a['nama_file_a'] ?>" target="_blank" class="text-reset text-decoration-none">
                                    <?= $a['label_a'] ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div> <!-- End Col -->

    <div class="col">
        <div class="card">
            <div class="card-header bg-info">
                Bundel B
            </div>
            <div class="card-body">
                <table class="table">
                    <?php foreach ($bundelb as $b) : ?>
                        <tr>
                            <a href="<?= base_url('uploads/') . $user->username . '/' . clear($perkara['no_perkara'])  . '/' . 'bundelb/' . $b['nama_file_b'] ?>" target="_blank" class="text-reset text-decoration-none">
                                <?= $b['label_b'] ?>
                            </a>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div> <!-- End Col -->


</div> <!-- end Row -->



<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/hakim_getbanding.js') ?>"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js"></script>
<?= $this->endSection() ?>