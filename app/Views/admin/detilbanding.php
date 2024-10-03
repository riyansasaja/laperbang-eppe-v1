<?= $this->extend('dashboard/layout') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>

<!--begin::Row-->
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Detil Perkara Banding</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detil Banding</li>
        </ol>
    </div>
</div> <!--end::Row-->

<?= $this->endSection() ?>

<?= $this->section('main') ?>


<?php
// dd($bundela);
?>


<div class="row">
    <div class="col-5">


        <div class="card"> <!-- menampilkan detail perkara -->
            <div class="card-header">
                <span class="fs-4">Data Perkara</span>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <th class="col-4">Nomor Perkara</th>
                            <td id="noper"><?= $perkara->no_perkara ?></td>
                        </tr>
                        <tr>
                            <th class="col-4">Jenis Perkara</th>
                            <td id="jeper"><?= $perkara->jenis_perkara ?></td>
                        </tr>
                        <tr>
                            <th class="col-4">Tanggal Pengajuan</th>
                            <td id="tepang"><?= date('d-m-Y', strtotime($perkara->created_at))  ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



    </div>
</div>

<div class="row mt-3">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <span class="fs-5">Bundel B</span>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <?php foreach ($bundelb as $b => $bundel) : ?>
                            <tr>
                                <td>
                                    <a href="<?= base_url('uploads/') . $perkara->username . '/' . clear($perkara->no_perkara)  . '/' . 'bundelb/' . $bundel['nama_file_b'] ?>" target="_blank" class="text-reset text-decoration-none">
                                        <?= $bundel['label_b'] ?>
                                    </a>


                                </td>

                                <?php if ($bundel['verval_status'] == 1): ?>
                                    <td><span class="badge text-bg-secondary text-white">Uploaded</span></td>
                                <?php elseif ($bundel['verval_status'] == 2) : ?>
                                    <td><span class="badge text-bg-info text-white">Validated</span></td>
                                <?php elseif ($bundel['verval_status'] == 3) : ?>
                                    <td><span class="badge text-bg-primary text-white">Verified</span></td>
                                <?php else : ?>
                                    <td><span class="badge text-bg-danger text-white">Rejected</span></td>
                                <?php endif; ?>
                                <td>
                                    <?= $bundel['komentar']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>



        </div>
    </div>

    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <span class="fs-5">Bundle A</span>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <?php foreach ($bundela as $b => $bundel) : ?>
                            <tr>
                                <td>
                                    <a href="<?= base_url('uploads/') . $perkara->username . '/' . clear($perkara->no_perkara)  . '/' . 'bundela/' . $bundel['nama_file_a'] ?>" target="_blank" class="text-reset text-decoration-none">
                                        <?= $bundel['label_a'] ?>
                                    </a>


                                </td>

                                <?php if ($bundel['verval_status'] == 1): ?>
                                    <td><span class="badge text-bg-secondary text-white">Uploaded</span></td>
                                <?php elseif ($bundel['verval_status'] == 2) : ?>
                                    <td><span class="badge text-bg-info text-white">Validated</span></td>
                                <?php elseif ($bundel['verval_status'] == 3) : ?>
                                    <td><span class="badge text-bg-primary text-white">Verified</span></td>
                                <?php else : ?>
                                    <td><span class="badge text-bg-danger text-white">Rejected</span></td>
                                <?php endif; ?>
                                <td>
                                    <?= $bundel['komentar']; ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>


<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/banding_upload.js') ?>"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js"></script>
<?= $this->endSection() ?>