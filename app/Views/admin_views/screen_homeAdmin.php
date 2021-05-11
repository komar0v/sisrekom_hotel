<?php echo view('admin_views/v_adminHeader') ?>

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Dashboard</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Sales Cards  -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-cyan text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-hotel"></i></h1>
                        <h6 class="text-white">Lihat Hotel Terdaftar</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi mdi-plus-box"></i></h1>
                        <h6 class="text-white">Tambah Hotel Baru</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-secondary text-center">
                        <h1 id="ikon_ucapan" class="font-light text-white"><i class="mdi mdi-weather-sunny"></i></h1>
                        <h6 id="blk_ucapan" class="text-white">-</h6>
                        
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-account-plus"></i></h1>
                        <h6 class="text-white">Tambah Pengguna Baru</h6>
                    </div>
                </div>
            </div>
            <div onclick="window.location.href='<?= base_url('administrasi/account_settings') ?>'"  class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-info text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-settings"></i></h1>
                        <h6 class="text-white">Pengaturan Akun Admin</h6>
                    </div>
                </div>
            </div>

        </div>
        <!-- Sales chart -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Status</h4>
                            </div>
                        </div>

                        <!-- Cards -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card m-t-0">
                                    <div class="row">

                                        <div class="col-md-6 border-left text-center p-t-10">
                                            <h3 class="mb-0 font-weight-bold"><?= $jumlah_user_terdaftar ?></h3>
                                            <span class="text-muted">Pengguna Terdaftar</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card m-t-0">
                                    <div class="row">

                                        <div class="col-md-6 border-left text-center p-t-10">
                                            <h3 class="mb-0 font-weight-bold"><?= $jumlah_hotel_terdaftar ?></h3>
                                            <span class="text-muted">Hotel Terdaftar</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card m-t-0">
                                    <div class="row">

                                        <div class="col-md-6 border-left text-center p-t-10">
                                            <h3 class="mb-0 "></h3>
                                            <span class="text-muted"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card m-t-0">
                                    <div class="row">

                                        <div class="col-md-6 border-left text-center p-t-10">
                                            <h3 class="mb-0 font-weight-bold"></h3>
                                            <span class="text-muted"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End cards -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent comment and chats -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">5 Pengguna Baru</h5>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">e-mail</th>
                                <th scope="col">Asal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($detail_5_pengguna_baru as $fiveLatestUser) { ?>
                            <tr>
                                
                                <td><?= $fiveLatestUser['nama_akun'] ?></td>
                                <td><?= $fiveLatestUser['email_akun'] ?></td>
                                <td><?= $fiveLatestUser['asal_akun'] ?></td>
                            </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
        <!-- ============================================================== -->
        <!-- Recent comment and chats -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    

    <?php echo view('admin_views/v_adminFooter') ?>