<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets/img/logoapp.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Laperbang</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">Home</li>
                <li class="nav-item">
                    <a href="<?= base_url('/') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>

                <?php if (in_groups('verifikator')) : ?>
                    <li class="nav-header">Verifikator</li>
                    <li class="nav-item">
                        <a href="<?= base_url('verifikator') ?>" class="nav-link"> <i class="bi bi-bag-check"></i>
                            <p> Verifikasi Berkas</p>
                        </a>
                    </li>
                <?php elseif (in_groups('validator')) : ?>
                    <li class="nav-header">Verifikator</li>
                    <li class="nav-item">
                        <a href="<?= base_url('validator') ?>" class="nav-link"> <i class="bi bi-bag-check"></i>
                            <p> Validasi Berkas</p>
                        </a>
                    </li>

                <?php elseif (in_groups('user')) : ?>
                    <li class="nav-header">Home User</li>
                    <li class="nav-item">
                        <a href="<?= base_url('/') ?>" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('user/banding') ?>" class="nav-link"> <i class="nav-icon bi bi-bank"></i>
                            <p>Perkara Banding</p>
                        </a>
                    </li>

                <?php elseif (in_groups('admin')) : ?>
                    <li class="nav-header">Banding</li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin') ?>" class="nav-link"> <i class="fas fa-boxes"></i>
                            <p> Banding Management</p>
                        </a>
                    </li>
                    <li class="nav-header">User Management</li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/users') ?>" class="nav-link"> <i class="fas fa-users"></i>
                            <p> User Management</p>
                        </a>
                    </li>

                <?php endif; ?>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>