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
// dd($perkara);
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

    <div class="col-md-3 text-center">
        <div class="card card-outline card-dark">
            <div class="card-body">
                <?= form_open('admin/unlockupload'); ?>
                <?= form_hidden('no_perkara', $perkara->no_perkara); ?>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-lock-open mr-2"></i>Buka Kunci Upload</button>
                </div>
                <div>
                    <button>Download ZIP</button>
                </div>
                <div>
                    <button>Delete Perkara</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

</div>

<!-- Tampilan Status Perkara -->
<div class="row">
    <div class="col-md-5">
        <div class="overflow-auto">
            <div class="card  card-outline card-warning" style="height: 16rem;">
                <div class="card-header">
                    <h4>Status Perkara <span class="badge text-bg-info"><?= $perkara->status; ?></span></h4>
                </div>
                <div class="card-body ">
                    <?= form_open('admin/set_status'); ?>
                    <?= form_hidden('no_perkara', $perkara->no_perkara); ?>

                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label for="inlineFormInputName">Pilih Status Perkara</label>
                        </div>
                        <div class="col-auto">
                            <div class="input-group">
                                <select class="form-control" aria-label="Default select example" id="staper" name="staper">
                                    <option selected value="none">Open this select menu</option>
                                    <option value="Proses Penunjukan Pra Majelis">Pra Majelis</option>
                                    <option value="Pendaftaran Perkara">Pendaftaran Perkara</option>
                                    <option value="Proses Penunjukan Majelis Hakim">Penunjukan Majelis Hakim</option>
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
                                    <td><?= date('d-m-Y', strtotime($status['tgl_status'])); ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card  card-outline card-warning">
            <div class="card-header">
                <h5>Data Majelis dan PP</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Pra Majelis</th>
                            <th>Majelis</th>
                            <th>PP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php foreach ($pramajelis as $prm) : ?>
                                    <?= get_fullname_by_id($prm['id_user']); ?> <br>
                                <?php endforeach ?>
                            </td>
                            <td>
                                <?php foreach ($majelis as $mjls) : ?>
                                    <?= get_fullname_by_id($mjls['id_user']); ?> <br>
                                <?php endforeach ?>
                            </td>
                            <td>
                                <?= get_fullname_by_id($perkara->id_pp); ?>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end tampilan status perkara -->


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


<!-- 20250220 Menghapus Modal Pramajelis ada di file -Copy -->


<!-- Modal Majelis -->
<div class="modal fade" id="mejelisModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penunjukan Majelis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- form kirim perkara -->
            <?= form_open('admin/setmajelissidang'); ?>
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

<!-- ppModal -->
<div class="modal fade" id="ppModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih PP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('admin/setpp'); ?>
            <?= form_hidden('no_perkara', $perkara->no_perkara); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Pilih Panitera Pengganti</label>
                    <select class="form-control" name="id_pp">
                        <!-- ambil data panitera pengganti -->
                        <option value="" selected>Pilih Panitera Pengganti</option>
                        <?php foreach ($paniteras as $pp): ?>
                            <option value="<?= $pp->id ?>"><?= $pp->fullname ?></option>
                        <?php endforeach; ?>

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

<!-- daftarModal -->
<div class="modal fade" id="daftarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Daftar Perkara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('admin/setnoper'); ?>
            <?= form_hidden('no_perkara', $perkara->no_perkara); ?>
            <div class="modal-body">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <input type="text" class="form-control" placeholder="nomor" name="nomor">
                        <label for="" class="input-group-text">/Pdt.G/</label>
                    </div>
                    <select class="custom-select" name="tahun">
                        <?php $tahun = date('Y'); ?>
                        <?php for ($i = 2023; $i <= $tahun; $i++) : ?>
                            <?php if ($i == $tahun) : ?>
                                <option value="<?= $i ?>" selected><?= $i ?></option>
                            <?php else : ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </select>
                    <div class="input-group-append">
                        <label for="" class="input-group-text">/PTA.Mdo</label>
                    </div>
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

<!-- putusanModal -->
<div class="modal fade" id="putusanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Putusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('admin/upload_putusan'); ?>
            <?= form_hidden('no_perkara', $perkara->no_perkara); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file_putusan">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
            <?= form_close(); ?>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/detilbanding.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<?= $this->endSection() ?>