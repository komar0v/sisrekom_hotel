<!DOCTYPE html>
<html>

<head>
	<title>Hotel 4U</title>
	<meta charset="UTF-8">
	<meta name="description" content="Hotel 4U">
	<meta name="keywords" content="hotel, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Favicon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/images/favicon.png">

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php echo base_url('/asset_web/home_assets') ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url('/asset_web/home_assets') ?>/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo base_url('/asset_web/home_assets') ?>/css/owl.carousel.min.css" />
	<link rel="stylesheet" href="<?php echo base_url('/asset_web/home_assets') ?>/css/slicknav.min.css" />

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="<?php echo base_url('/asset_web/home_assets') ?>/css/style.css" />


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section clearfix">
		<a href="index.html" class="site-logo">
			<img src="<?php echo base_url('/asset_web/home_assets') ?>/img/logo_app.png" alt="" height="60" width="150">
		</a>
		<div class="header-right">
			<a href="<?= base_url('pengguna/daftar_baru') ?>" class="register">Buat Akun</a>
			<span>|</span>
			<div class="user-panel">
				<a href="<?= base_url('pengguna') ?>" class="login">Login</a>
			</div>
		</div>
		<ul class="main-menu">
			<li><a href="<?= base_url() ?>">Home</a></li>
			<li><a href="#">Tentang</a>
				<ul class="sub-menu">
					<li><a href="category.html">Front End</a></li>
					<li><a href="playlist.html">Back End</a></li>
				</ul>
			</li>
			<li><a href="blog.html">Kontak</a></li>
		</ul>
	</header>
	<!-- Header section end -->