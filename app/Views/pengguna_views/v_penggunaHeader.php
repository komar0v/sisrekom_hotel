<!doctype html>
<html>

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
    <style>
        @font-face {
            font-family: 'icomoon';
            src: url('<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/fonts/icomoon.eot?gzgasd');
            src: url('<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/fonts/icomoon.eot?gzgasd#iefix') format('embedded-opentype'),
                url('<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/fonts/icomoon.ttf?gzgasd') format('truetype'),
                url('<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/fonts/icomoon.woff?gzgasd') format('woff'),
                url('<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/fonts/icomoon.svg?gzgasd#icomoon') format('svg');
            font-weight: normal;
            font-style: normal;
            font-display: block;
        }

        [class^="icon-"],
        [class*=" icon-"] {
            /* use !important to prevent issues with browser extensions that change fonts */
            font-family: 'icomoon' !important;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;

            /* Better Font Rendering =========== */
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .icon-air-conditioner:before {
            content: "\e900";
        }
    </style>
</head>

<body>

    <!--Topbar -->
    <div class="topbar transition">
        <div class="bars">
            <button type="button" class="btn transition" id="sidebar-toggle">
                <i class="las la-bars"></i>
            </button>
        </div>
        <div class="menu">

            <ul>
                <li>
                    <div class="dropdown">
                        <div class="dropdown-toggle" id="dropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/images/avatar/person_1.png" alt="Profile">
                        </div>
                        <div class="dropdown-menu" aria-labelledby="dropdownProfile">

                            <a class="dropdown-item" href="<?php echo base_url('pengguna/profil_saya') ?>">
                                <i class="fas la-wrench mr-2"></i> Pengaturan Akun
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('pengguna/keluar') ?>">
                                <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!--Sidebar-->
    <div class="sidebar transition overlay-scrollbars">
        <div class="logo">
            <img src="<?php echo base_url('/asset_web/home_assets') ?>/img/logo_app.png" height="60" width="150" />
        </div>

        <div class="sidebar-items">
            <div class="text-center">
                <img src="<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/images/avatar/person_1.png" height="100" width="100" />
            </div>
            <div class="accordion" id="sidebar-items">

                <ul>

                    <li>
                        <a href="<?php echo base_url('pengguna') ?>" class="items">
                            <i class="fas fa-home"></i>
                            <span>Beranda</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url('pengguna/rekomendasi_hotel') ?>" class="items">
                            <i class="fas fa-magic"></i>
                            <span>Rekomendasi Hotel</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url('pengguna/profil_saya') ?>" class="items">
                            <i class="fas la-wrench"></i>
                            <span>Pengaturan Akun</span>
                        </a>
                    </li>

                </ul>
                <div class="card mb-3">
                    <div class="card-body text-primary">
                        <a class="weatherwidget-io" href="https://forecast7.com/en/n7d88110d43/special-region-of-yogyakarta/" data-label_1="Yogyakarta" data-font="Roboto" data-icons="Climacons Animated" data-mode="Current" data-theme="pure">Yogyakarta</a>
                        <script>
                            ! function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (!d.getElementById(id)) {
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = 'https://weatherwidget.io/js/widget.min.js';
                                    fjs.parentNode.insertBefore(js, fjs);
                                }
                            }(document, 'script', 'weatherwidget-io-js');
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-overlay"></div>