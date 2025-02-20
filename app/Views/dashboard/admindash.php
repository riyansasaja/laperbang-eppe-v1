<?php

use CodeIgniter\Throttle\ThrottlerInterface;
?>
<?= $this->extend('dashboard/layout') ?>

<?= $this->section('breadcumb') ?>

<div class="col-sm-6">
    <h1 class="m-0">Dashboard</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
    </ol>
</div><!-- /.col -->

<?= $this->endSection() ?>

<?= $this->section('main') ?>


<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $perkaraMasuk; ?></h3>

                <p>Perkara Masuk</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $perkaraPutus; ?></h3>

                <p>Perkara Putus</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $perkaraMasuk - $perkaraPutus; ?></h3>

                <p>Sisa Perkara</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $totalLogin; ?></h3>

                <p>Total Login</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <canvas id="myChart" style="height: 100; width:100"></canvas>
            </div>
        </div>
    </div>
</div><!--./col -->
</div> <!-- ./row

<?= $this->endSection() ?>

<?= $this->section('pageScripts'); ?>
<!-- Chartjs -->
<script src="<?= base_url() ?>plugins/chart.js/Chart.min.js"></script>

<!-- Dashboard js -->
<script src="assets/js/admindash.js"></script>

<?= $this->endSection(); ?>