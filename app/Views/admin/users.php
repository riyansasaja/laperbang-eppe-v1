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

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5>List Users</h5>
            </div>
            <div class=" card-body">
                <!-- data table menampilkan list users -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
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