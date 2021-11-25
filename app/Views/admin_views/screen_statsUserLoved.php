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
                        <h4 class="page-title">Statistik</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url('administrasi')?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Statistik</li>
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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                    <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                <table id="dataTablesNonServSIDE" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Loved Hotels</th>
                                                <th>Tindakan</th>
                                                <!-- <th>Aksi</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($semuaPenggunaLovedHotels as $lovedHotels){?>
                                            <tr>
                                                <td><?= $lovedHotels['nama_akun'] ?></td>
                                                <td><?= $lovedHotels['jumlah_hotel_loved'] ?></td>
                                                <td><button onclick="window.location.href='<?=base_url('administrasi/detail_statistik/'.$lovedHotels['id_akun'])?>'" type="button" class="btn btn-success btn-sm"><i class="m-r-10 mdi mdi-eye"></i> Lihat Detail</button></td>
                                            </tr>
                                        <?php }?>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

<!-- ============================================================== -->
<!-- End Container fluid  -->


<?php echo view('admin_views/v_adminFooter') ?>