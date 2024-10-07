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
        <li class="breadcrumb-item"><a href="<?= base_url('admin/users') ?>">Users Management</a></li>
        <li class="breadcrumb-item active">Detil User</a></li>
    </ol>
</div><!-- /.col -->

<?= $this->endSection() ?>

<?= $this->section('main') ?>

<?php

dd($user);
?>

<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">

            </div>
            <div class=" card-body">

            </div>
        </div>

    </div>
</div>



<!-- Modal Add User-->
<div class="modal fade" id="adduserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form add user -->
                <?= form_open('admin/adduser'); ?>
                <div class="mb-3 row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="mail" class="form-control" id="inputEmail" name="email">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputUsername" name="username">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputFullName" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputFullName" name="fullname">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputNip" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="inputNip" name="nip">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputJabatan" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="jabatan">
                            <option selected value="">Open this select menu</option>
                            <option value="Admin">Admin</option>
                            <option value="Operator">Operator</option>
                            <option value="User">User</option>
                            <option value="Validator">Validator</option>
                            <option value="Verifikator">Verifikator</option>
                            <option value="Panitera Pengganti">Panitera Pengganti</option>
                            <option value="Hakim">Hakim</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPhone" class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPhone" name="phone">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="password">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputRepeatPassword" class="col-sm-2 col-form-label">Repeat Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputRepeatPassword" name="pass_confirm">
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                <?php form_close(); ?>
                <!-- end form -->

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