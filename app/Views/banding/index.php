<?= $this->extend('dashboard/layout') ?>


<?= $this->section('breadcumb') ?>

<!--begin::Row-->
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Perkara Banding</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Perkara Banding</li>
        </ol>
    </div>
</div> <!--end::Row-->

<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="row">
    <div class="col">
        <h5>ini banding index</h5>
    </div>
</div>
<?= $this->endSection() ?>