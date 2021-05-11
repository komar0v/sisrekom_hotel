<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $judulHalaman ?> | Hotel 4U</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/images/favicon.png">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/vendors/bootstrap/css/bootstrap.css">
    <!-- Style CSS (White)-->
    <link rel="stylesheet" href="<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/css/White.css">
    <!-- Style CSS (Dark)-->
    <link rel="stylesheet" href="<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/css/Dark.css">
    <!-- FontAwesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/vendors/fontawesome/css/all.css">
    <!-- Icon LineAwesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/vendors/lineawesome/css/line-awesome.min.css">

    <link href="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
</head>

<body>


    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center auth">
            <div class="col-md-7 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <img src="<?php echo base_url('/asset_web/home_assets') ?>/img/logo_app.png" width="200" height="80" />
                        <h5>Daftar Pengguna Baru</h5>
                        <?= form_open('pengguna/registerPenggunaBaru', 'class="needs-validation" novalidate') ?>

                        <div class="form-group">
                            <label>Nama Anda</label>
                            <input name="nama_pengguna" type="text" class="form-control" required placeholder="nama Anda">
                            <div class="invalid-feedback">
                                Nama Anda
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email_pengguna" type="email" class="form-control" required placeholder="email Anda">
                            <div class="invalid-feedback">
                                E-Mail tidak valid!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="pswd_pengguna" type="password" class="form-control" id="passAkun" required placeholder="password Anda">
                            <div class="valid-feedback">
                                Password OK!
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Kota Asal</label>
                            <input name="kota_asal_pengguna" type="text" class="form-control" required placeholder="Anda berasal dari kota?">
                            <div class="valid-feedback">
                                Kota asal Anda
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-md-8 offset-md-4 form-group">
                        <div class='form-check'>
                            <div class="checkbox">
                                <input onclick="showPswd()" type="checkbox" id="chck_pswd" class='form-check-input'>
                                <label for="chck_pswd">Perlihatkan Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button id="btnSubmit" class="btn btn-primary">Submit</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Library Javascipt-->
    <script src="<?= base_url('/asset_web/user_panel_assets') ?>/assets/vendors/bootstrap/js/jquery.min.js"></script>
    <script src="<?= base_url('/asset_web/user_panel_assets') ?>/assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('/asset_web/user_panel_assets') ?>/assets/vendors/bootstrap/js/popper.min.js"></script>
    <script src="<?= base_url('/asset_web/user_panel_assets') ?>/assets/js/script.js"></script>

    <!-- PENERIMA NOTIF -->
    <script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/toastr/build/toastr.min.js"></script>
    <script>
        toastr.options = {
            "progressBar": true,
            "timeOut": "3000",
        }
        <?= session()->getFlashdata('notif') ?>
    </script>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                document.getElementById("btnSubmit").disabled = true;
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('keyup', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                            document.getElementById("btnSubmit").disabled = true;
                        } else {
                            document.getElementById("btnSubmit").disabled = false;
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    <script>
        function showPswd() {
            var inputbox = document.getElementById("passAkun");
            if (inputbox.type === "password") {
                inputbox.type = "text";
            } else {
                inputbox.type = "password";
            }
        }
    </script>
</body>

</html>