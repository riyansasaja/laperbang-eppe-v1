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
        <li class="breadcrumb-item"><a href="<?= base_url('/user/banding') ?>">Perkara Banding</a></li>
        <li class="breadcrumb-item active" aria-current="page">Upload Berkas Banding</li>
    </ol>
</div><!-- /.col -->

<?= $this->endSection() ?>


<?= $this->section('main') ?>


<?php
// dd($bundelb);
// $aktabanding = array_search('Akta Banding', $bundelb[0]);
// dd($aktabanding);
?>


<div class="row">
    <div class="col-md-5">


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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <span class="fs-5">Upload Bundle B</span>
            </div>
            <div class="card-body">

                <?= form_open_multipart('user/uploadb'); ?>
                <?= form_hidden('id_perkara', $perkara->id_perkara) ?>
                <div class="row">
                    <div class="col-4 mb-2">
                        <select class="form-control" name="label">
                            <option value="" selected>Pilih Yang Mau Diupload</option>
                            <!-- cek dulu akta banding sudah ada atau belum -->

                            <?php if (!$bundelb) : ?>
                                <option value="Akta Banding">Akta Banding</option>
                            <?php else: ?>
                                <!-- //looping label ambil dari tabel refrensi dokumen -->
                                <?php foreach ($label as $lab) : ?>
                                    <option value="<?= $lab['nama_label'] ?>"><?= $lab['nama_label'] ?></option>
                                <?php endforeach; ?>
                                <!-- end Looping -->
                            <?php endif; ?>
                        </select>
                        <!-- <input type="text" name="label" readonly class="form-control-plaintext" value="Akta Banding"> -->
                    </div>
                    <div class="col-auto mb-2">
                        <input class="form-control-file" type="file" name="bundelb" accept=".pdf,.rtf">
                    </div>
                    <div class="col-auto mb-2">
                        <button type="submit" class="btn btn-primary mb-3"><i class="fas fa-arrow-circle-up"></i> Upload</button>
                    </div>
                </div>
                <?= form_close(); ?>

                <!-- Tampilan File -->
                <div class="row mt-3">
                    <div class="col">
                        <table class="table">
                            <tbody>
                                <?php foreach ($bundelb as $b => $bundel) : ?>
                                    <tr>
                                        <td>
                                            <a href="<?= base_url('uploads/') . user()->username . '/' . clear($perkara->no_perkara)  . '/' . 'bundelb/' . $bundel['nama_file_b'] ?>" target="_blank" class="text-reset text-decoration-none">
                                                <?= $bundel['label_b'] ?>
                                            </a>


                                        </td>

                                        <?php if ($bundel['verval_status'] == 1): ?>
                                            <td><span class="badge badge-secondary text-white">Uploaded</span></td>
                                        <?php elseif ($bundel['verval_status'] == 2) : ?>
                                            <td><span class="badge badge-info text-white">Validated</span></td>
                                        <?php elseif ($bundel['verval_status'] == 3) : ?>
                                            <td><span class="badge badge-primary text-white">Verified</span></td>
                                        <?php else : ?>
                                            <td><span class="badge badge-danger text-white">Rejected</span></td>
                                        <?php endif; ?>
                                        <td>
                                            <?= $bundel['komentar']; ?>
                                        </td>

                                        <td>
                                            <a href="<?= base_url('user/delbundelb/') . $bundel['nama_file_b'] . '/' . clear($perkara->no_perkara) ?>"> <span class="badge badge-danger"><i class="far fa-trash-alt"></i> Delete</span></a>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>



        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <span class="fs-5">Upload Bundle A</span>
            </div>
            <div class="card-body">

                <?= form_open_multipart('user/uploada'); ?>
                <?= form_hidden('id_perkara', $perkara->id_perkara) ?>
                <div class="row">
                    <div class="col-4 mb-2">

                        <select class="form-control" name="label" id="label">
                            <?php if (!$bundelb) : ?>
                                <option value="" selected>Pilih Yang Mau Diupload</option>
                            <?php else : ?>
                                <option value="" selected>Pilih Yang Mau Diupload</option>
                                <?php foreach ($label_a as $lab) : ?>
                                    <option value="<?= $lab['nama_label'] ?>"><?= $lab['nama_label'] ?></option>

                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <!-- <input type="text" name="label" readonly class="form-control-plaintext" value="Akta Banding"> -->
                    </div>
                    <div class="col-auto mb-2">
                        <input class="form-control-file" type="file" name="bundela" accept="application/pdf">
                    </div>
                    <div class="col-auto mb-2">
                        <button type="submit" class="btn btn-primary mb-3"><i class="fa fw fas fa-arrow-circle-up"></i> Upload</button>
                    </div>
                </div>
                <?= form_close(); ?>

                <!-- Tampilan File -->
                <div class="row mt-3">
                    <div class="col">
                        <table class="table">
                            <tbody>
                                <?php foreach ($bundela as $b => $bundel) : ?>
                                    <tr>
                                        <td>
                                            <a href="<?= base_url('uploads/') . user()->username . '/' . clear($perkara->no_perkara)  . '/' . 'bundela/' . $bundel['nama_file_a'] ?>" target="_blank" class="text-reset text-decoration-none">
                                                <?= $bundel['label_a'] ?>
                                            </a>


                                        </td>

                                        <?php if ($bundel['verval_status'] == 1): ?>
                                            <td><span class="badge badge-secondary text-white">Uploaded</span></td>
                                        <?php elseif ($bundel['verval_status'] == 2) : ?>
                                            <td><span class="badge badge-info text-white">Validated</span></td>
                                        <?php elseif ($bundel['verval_status'] == 3) : ?>
                                            <td><span class="badge badge-primary text-white">Verified</span></td>
                                        <?php else : ?>
                                            <td><span class="badge badge-danger text-white">Rejected</span></td>
                                        <?php endif; ?>
                                        <td>
                                            <?= $bundel['komentar']; ?>
                                        </td>

                                        <td>
                                            <a href="<?= base_url('user/delbundela/') . $bundel['nama_file_a'] . '/' . clear($perkara->no_perkara) ?>"> <span class="badge badge-danger"><i class="far fa-trash-alt"></i> Delete</span></a>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>

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