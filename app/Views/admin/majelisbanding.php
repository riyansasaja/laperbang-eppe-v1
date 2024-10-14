<?= $this->extend('dashboard/layout') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>

<div class="col-sm-6">
    <h1 class="m-0">Majelis Hakim</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">admin</a></li>
        <li class="breadcrumb-item active">Majelis Hakim</a></li>
    </ol>
</div><!-- /.col -->

<?= $this->endSection() ?>

<?= $this->section('main') ?>

<?php

// dd($allmajelis);

?>



<div class="row">

    <div class="col">
        <div class="card">
            <div class="card-header">
                <!-- di sini card header -->
                <h5>Tambah Majelis Hakim</h5>
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_list_errors() ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class=" card-body">
                <?php echo form_open('admin/setmajelis'); ?>
                <div class="row">
                    <div class="col-auto">
                        <select name="id_user" class="custom-select">
                            <option value="" selected>Pilih Hakim</option>
                            <?php foreach ($userHakim as $key => $value): ?>
                                <option value="<?= $value->id ?>"><?= $value->fullname; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select class="custom-select" name="majelis">
                            <option value="" selected>Pilih Majelis</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C1">C1</option>
                            <option value="C2">C2</option>
                            <option value="C3">C3</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5>Daftar Majelis Hakim</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Hakim</th>
                            <th scope="col">Majelis</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allmajelis as $key => $vm): ?>
                            <tr>
                                <th scope="row">1</th>
                                <td><?= $vm['fullname']; ?></td>
                                <td><?= $vm['Majelis']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/delmajelis/') . $vm['id']; ?>"><i class="fas fa-minus-circle" title="Delete"></i></a>
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
<script src="<?= base_url('assets/js/usermanagement.js') ?>"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js"></script>
<?= $this->endSection() ?>