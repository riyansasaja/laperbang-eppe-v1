<?= $this->extend('dashboard/layout') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>

<!--begin::Row-->
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Users Management</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users Management</li>
        </ol>
    </div>
</div> <!--end::Row-->

<?= $this->endSection() ?>

<?= $this->section('main') ?>

<?php
//panggil group model
$groupModel = new \Myth\Auth\Models\GroupModel();

?>

<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <div class="row row-cols-auto">
                    <div class="col-2">
                        <img src="<?= base_url('assets/img/user.png') ?>" class="img-fluid">
                    </div>
                    <div class="col-9">
                        <div class="float-start">
                            <span class="fs-1">Users List</span>
                        </div>
                        <div class="float-end">
                            <button class="btn btn-primary float-end mt-1">+ Tambah User</button>
                        </div>
                    </div>
                </div>


            </div>
            <div class=" card-body">
                <!-- data table menampilkan list users -->
                <div class="table-responsive">
                    <table class="table" id="tb_users">
                        <thead>
                            <tr>
                                <th scope="col">username</th>
                                <th scope="col">fullname</th>
                                <th scope="col">jabatan</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <th scope="row"><?= $user->username ?></th>
                                    <td><?= $user->fullname ?></td>
                                    <td><?= $user->jabatan ?></td>
                                    <td>
                                        <?php $groups = $groupModel->getGroupsForUser($user->id);
                                        foreach ($groups as $key => $group) {
                                            # code...
                                            echo $group['name'];
                                        }
                                        ?>
                                    </td>
                                    <td> <a href="#"><i class="bi bi-arrow-up-right-square-fill"></i></a></td>
                                </tr>
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
<script src="<?= base_url('assets/js/usermanagement.js') ?>"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js"></script>
<?= $this->endSection() ?>