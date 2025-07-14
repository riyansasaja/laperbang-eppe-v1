<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laperbang-Epe</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand bg-body-tertiary bg-opacity-50">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="#">
                <img src="assets/img/logoapp.png" alt="logoApp" width="80" class="img-fluid">
            </a>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        </div>
    </nav>

    <div class="container my-3  text-center">
        <div class="row">
            <div class="col">
                <h1 class="display-4 text-white">Selamat Datang !</h1>
                <p class="lead text-white">Untuk mencari informasi seputar perkara banding, silahkan inputkan nomor perkara banding pada form di bawah ini</p>
            </div>
        </div>
        <hr class="text-white">
        <div class="row align-items-center">
            <div class="col-auto mx-auto">
                <div class="input-group mb-3">
                    <input type="number" name="no" class="form-control" placeholder="Nomor" size="2">
                    <span class="input-group-text">/Pdt.G/</span>
                    <select class="form-select form-control" name="tahun" id="inputTahun">

                    </select>
                    <span class="input-group-text">/PTA.Mdo</span>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary mb-4" type="button" id="btnSearch">Cari Perkara</button>
                </div>
            </div>
        </div>

    </div>

    <!-- modal Hasil cari -->
    <div class="modal fade" id="perkaraModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detil Perkara</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody class="table mb-2">
                            <tr>
                                <th>Nomor Perkara</th>
                                <td>:</td>
                                <td id="t_noper"></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Status Perkara</th>
                                <th scope="col">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody id="isi">


                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal login -->
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= url_to('login') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="login" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_login">Login</button>
                    </form>

                </div>
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>









    <!-- bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- for sweet alert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- for jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        let baseUrl = <?= json_encode(base_url()) ?>;
        let error = <?= json_encode(session()->getFlashdata('error')) ?>;
        let success = <?= json_encode(session()->getFlashdata('success')) ?>;
    </script>
    <script src="<?= base_url('assets/') ?>js/home.js"></script>

</body>

</html>