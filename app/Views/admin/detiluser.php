<?= $this->extend('dashboard/layout') ?>

<?= $this->section('header') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcumb') ?>

<div class="col-sm-6">
    <h1 class="m-0">User Management</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">admin</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('admin/users') ?>">users</a></li>
        <li class="breadcrumb-item active">Detil User</a></li>
    </ol>
</div><!-- /.col -->

<?= $this->endSection() ?>

<?= $this->section('main') ?>

<?php
// dd($allRoles);
?>


<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="<?= base_url('assets/img/user-a.png') ?>"
                        alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= $user->fullname; ?></h3>

                <p class="text-muted text-center">NIP. <?= $user->nip; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Total Login</b> <a class="float-right">1,322</a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">About Me</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <strong><i class="fas fa-at"></i> email</strong>

                <p class="text-muted">
                    <?= $user->email; ?>
                </p>

                <hr>

                <strong><i class="fab fa-github-alt mr-1"></i> Username</strong>

                <p class="text-muted"><?= $user->username; ?></p>

                <hr>

                <strong><i class="fas fa-user-tie mr-1"></i> Jabatan</strong>

                <p class="text-muted"><?= $user->jabatan; ?></p>

                <hr>

                <strong><i class="fas fa-phone-alt"></i> Telepon</strong>

                <p class="text-muted"><?= $user->phone; ?></p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#roleUser" data-toggle="tab">Role User</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Update</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="roleUser">
                        <!-- Post -->
                        <div class="post">
                            <button class="btn btn-info mb-3" data-toggle="modal" data-target="#addgroupModal">Add Role</button>
                            <div class="col-4">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="text-bold">ROLE USER</span>
                                    </li>
                                    <?php foreach ($getRoles as $key => $role) : ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= $role['name']; ?>
                                            <a href="<?= base_url('admin/delrole/') . $user->id . '/' . $role['group_id'] ?>">
                                                <span class="badge badge-danger badge-pill">--</span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <!-- /.post -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <div class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-danger">
                                    10 Feb. 2014
                                </span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-envelope bg-primary"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                    <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-user bg-info"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                    <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                    </h3>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-comments bg-warning"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                    <div class="timeline-body">
                                        Take me to your leader!
                                        Switzerland is small and neutral!
                                        We are more like Germany, ambitious and misunderstood!
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-success">
                                    3 Jan. 2014
                                </span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-camera bg-purple"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                    <div class="timeline-body">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <div>
                                <i class="far fa-clock bg-gray"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal" method="POST" action="<?= base_url('admin/edituser') ?>">
                            <?= csrf_field() ?>
                            <?= form_hidden('id', $user->id); ?>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="Nama Lengkap" value="<?= $user->fullname ?>" name="fullname">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="<?= $user->email ?>" name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputUsername" placeholder="Username" value="<?= $user->username ?>" name="username">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputNip" class="col-sm-2 col-form-label">NIP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputNip" placeholder="19xxxxxxx" value="<?= $user->nip ?>" name="nip">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputJabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputJabatan" placeholder="Jabatan" value="<?= $user->jabatan ?>" name="jabatan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPhone" class="col-sm-2 col-form-label">Nomor Telpon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPhone" placeholder="0823xxx" value="<?= $user->phone ?>" name="phone">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger" name="update">Update</button>
                                    <button type="submit" class="btn btn-danger" name="reset_password" onclick="return confirm('Yakin Mereset Password?')">ResetPassword</button>
                                    <?php if ($user->active == 0) : ?>
                                        <button type="submit" class="btn btn-danger" name="active">Active</button>
                                    <?php else : ?>
                                        <button type="submit" class="btn btn-danger" name="inactive">Inactive</button>
                                    <?php endif; ?>
                                    <button type="submit" class="btn btn-danger" name="delete" onclick="return confirm('Yakin Menghapus?')">Delete User</button>

                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->



<!-- modal add role -->
<!-- Modal -->
<div class="modal fade" id="addgroupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/addroles'); ?>
                <?= form_hidden('user_id', $user->id); ?>
                <select class="form-control" name="group_id">
                    <option value="" selected>Default select</option>
                    <?php foreach ($allRoles as $key => $r) : ?>
                        <option value="<?= $r->id ?>"><?= $r->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- end modal -->


<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/detiluser.js') ?>"></script>
<?= $this->endSection() ?>