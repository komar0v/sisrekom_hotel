
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
						<h5>Masuk Pengguna</h5>
						<?= form_open('pengguna/validasi_login') ?>
							<div class="form-group">
								<input type="email" name="email" class="form-control" placeholder="Email">
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control" placeholder="Password">
							</div>
							
							<div class="form-group my-4">
								<button type="submit" class="btn btn-linear-primary btn-rounded px-5">Login</button>
							</div>
							<p>Belum punya akun? <a href="<?= base_url('pengguna/daftar_baru')?>" id="create_account">Buat akun</a></p>
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
 </body>
</html>