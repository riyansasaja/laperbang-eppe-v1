<nav class="mt-2"> <!--begin::Sidebar Menu-->


    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

        <!-- mulai menu aside -->
        <li class="nav-header">Home</li>
        <li class="nav-item">
            <a href="<?= base_url('/') ?>" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                <p>Dashboard</p>
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

        <?php endif; ?>

    </ul> <!--end::Sidebar Menu-->



</nav>