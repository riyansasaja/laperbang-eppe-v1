<?= $this->extend('dashboard/layout') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>

<!--begin::Row-->
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Admin Banding</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Admin</li>
        </ol>
    </div>
</div> <!--end::Row-->

<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5>List Users</h5>
            </div>
            <div class=" card-body">
                <!-- data table menampilkan list users -->
                <div class="table-responsive">
                    <table class="table table-striped" id="tbBanding">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nomor Perkara</th>
                                <th scope="col">PA Pengaju</th>
                                <th scope="col">Nomor Banding</th>
                                <th scope="col">Status Perkara</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($bandings as $b => $banding) : ?>
                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td><?= $banding->no_perkara; ?></td>
                                    <td><?= $banding->fullname; ?></td>
                                    <td><?= $banding->no_banding; ?></td>
                                    <td><?= $banding->status; ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/bandingdetil/') . clearlink($banding->no_perkara) ?>">Detil</a>
                                        <a href="">Status</a>
                                        <a href="">Hapus</a>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/adminbanding.js') ?>"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js"></script>
<?= $this->endSection() ?>