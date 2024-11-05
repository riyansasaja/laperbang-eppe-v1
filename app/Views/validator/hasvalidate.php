<?= $this->extend('dashboard/layout') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>

<div class="col-sm-6">
    <h1 class="m-0">Validasi Berkas</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Validasi Berkas</li>
    </ol>
</div><!-- /.col -->

<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="row">
    <div class="col">

        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('validator') ?>">Belum Validasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="#">Sudah Validasi</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nomor Perkara</th>
                                <th scope="col">PA Pengaju</th>
                                <th scope="col">Jenis Berkas</th>
                                <th scope="col">Status Verval</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $num = 1; ?> <!-- membuat variabel number  -->
                            <!-- menampilkan bundel b belum tervalidasi -->
                            <?php foreach ($bundel_b_validation as $bundel => $bundel_b) : ?>
                                <tr>
                                    <th scope="row"><?= $num; ?></th>
                                    <td><?= $bundel_b['no_perkara']; ?></td>
                                    <td><?= $bundel_b['fullname']; ?></td>
                                    <td><?= $bundel_b['label_b']; ?></td>
                                    <td>
                                        <?php if ($bundel_b['verval_status'] == 2) : ?>
                                            <span class="badge  rounded-pill text-bg-info">Tervalidasi</span>
                                        <?php elseif ($bundel_b['verval_status'] == 3) : ?>
                                            <span class="badge  rounded-pill text-bg-info">Terverifikasi</span>
                                        <?php elseif ($bundel_b['verval_status'] == 4) : ?>
                                            <span class="badge  rounded-pill text-bg-danger">Ditolak</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>

                                        <?= form_open('validator/cancel'); ?>
                                        <?= form_hidden('bundel', 'bundelb'); ?>
                                        <?= form_hidden('nama_file', $bundel_b['nama_file_b']); ?>
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-eyeglasses"></i> Cancel Validasi</button>
                                        <?= form_close(); ?>
                                    </td>
                                </tr>
                                <?php $num++; //tambah variabel num
                                ?>
                            <?php endforeach; ?>
                            <!-- Menampilkan bundel a belum tervalidasi -->
                            <?php foreach ($bundel_a_validation as $bundel => $bundel_a): ?>
                                <tr>
                                    <th scope="row"><?= $num; ?></th>
                                    <td><?= $bundel_a['no_perkara']; ?></td>
                                    <td><?= $bundel_a['fullname']; ?></td>
                                    <td><?= $bundel_a['label_a']; ?></td>
                                    <td>
                                        <?php if ($bundel_a['verval_status'] == 2) : ?>
                                            <span class="badge  rounded-pill text-bg-info">Tervalidasi</span>
                                        <?php elseif ($bundel_a['verval_status'] == 3) : ?>
                                            <span class="badge  rounded-pill text-bg-info">Terverifikasi</span>
                                        <?php elseif ($bundel_a['verval_status'] == 4) : ?>
                                            <span class="badge  rounded-pill text-bg-danger">Ditolak</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= form_open('validator/cancel'); ?>
                                        <?= form_hidden('bundel', 'bundela'); ?>
                                        <?= form_hidden('nama_file', $bundel_a['nama_file_a']); ?>
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-eyeglasses"></i> Cancel Validasi</button>
                                        <?= form_close(); ?>
                                    </td>
                                </tr>
                                <?php $num++; ?>
                            <?php endforeach; ?>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>



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