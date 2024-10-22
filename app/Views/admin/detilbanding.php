<?= $this->extend('dashboard/layout') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>

<div class="col-sm-6">
    <h1 class="m-0">Admin Banding</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">admin</a></li>
        <li class="breadcrumb-item active">Detil Banding</a></li>
    </ol>
</div><!-- /.col -->


<?= $this->endSection() ?>

<?= $this->section('main') ?>


<?php
// dd($status_perkara);
?>


<div class="row">
    <div class="col-md-5">

        <div class="card card-outline card-success mb-3"> <!-- menampilkan detail perkara -->
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
                            <th class="col-4">Nomor Banding</th>
                            <td id="noper"><?= $perkara->no_banding ?></td>
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

    <div class="col-md-5">
        <div class="card  card-outline card-warning">
            <div class="card-header">
                <h4>Status Perkara <span class="badge text-bg-info"><?= $perkara->status; ?></span></h4>
            </div>
            <div class="card-body">
                <?= form_open(); ?>

                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label for="inlineFormInputName">Pilih Status Perkara</label>
                    </div>
                    <div class="col-auto">
                        <div class="input-group">
                            <select class="form-control" aria-label="Default select example" id="staper" name="staper">
                                <option selected value="none">Open this select menu</option>
                                <option value="Pra Majelis">Pra Majelis</option>
                                <option value="Pendaftaran Perkara">Pendaftaran Perkara</option>
                                <option value="Penunjukan Majelis Hakim">Penunjukan Majelis Hakim</option>
                                <option value="Penunjukan Panitera Pengganti">Penunjukan Panitera Pengganti</option>
                                <option value="Pembuatan PHS 1">Pembuatan PHS 1</option>
                                <option value="Pembuatan PHS Lanjutan">Pembuatan PHS Lanjutan</option>
                                <option value="Sidang Lanjutan 1">Sidang Lanjutan 1</option>
                                <option value="Sidang Lanjutan 2">Sidang Lanjutan 2</option>
                                <option value="Sidang Lanjutan 3">Sidang Lanjutan 3</option>
                                <option value="Sidang Lanjutan 4">Sidang Lanjutan 4</option>
                                <option value="Sidang Lanjutan 5">Sidang Lanjutan 5</option>
                                <option value="Penetapan Putusan">Penetapan Putusan</option>
                                <option value="Pembacaan Putusan">Pembacaan Putusan</option>
                                <option value="Minutasi">Minutasi</option>
                                <option value="Pengiriman Salinan Putusan">Pengiriman Salinan Putusan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button id="simpan" type="submit" class="btn bg-indigo">Submit</button>
                    </div>
                </div>
                <?= form_close(); ?>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>STATUS</th>
                            <th>DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($status_perkara as $key => $status) : ?>
                            <tr>
                                <td><?= $status['status']; ?></td>
                                <td><?= $status['tgl_status']; ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card card-outline card-dark">
            <div class="card-body">
                <button>Buka Kunci Upload</button>
                <button>Download ZIP</button>
                <button>Delete Perkara</button>
            </div>
        </div>
    </div>



</div>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header bg-lightblue">
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

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-purple">
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



<!-- ModalPramejelis -->
<div class="modal fade" id="pramejelisModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- form kirim perkara -->
            <?= form_open('admin/setpramajelis'); ?>
            <?= form_hidden('no_perkara', $perkara->no_perkara); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="pramajelisselect">Pilih Majelis</label>
                    <select class="form-control" id="pramajelisselect" name="nama_majelis">
                        <option value="">Pilih Salah Satu</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C1">C1</option>
                        <option value="C2">C2</option>
                        <option value="C3">C3</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<!-- Modal Majelis -->
<div class="modal fade" id="majelisModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- ppModal -->
<div class="modal fade" id="ppModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- daftarModal -->
<div class="modal fade" id="daftarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- putusanModal -->
<div class="modal fade" id="putusanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/detilbanding.js') ?>"></script>
<?= $this->endSection() ?>