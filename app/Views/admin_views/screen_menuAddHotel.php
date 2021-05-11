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
                <h4 class="page-title">Tambah Data Hotel</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('administrasi') ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Data Hotel</li>
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
                    <ul class="list-style-none">
                        <li class="d-flex no-block card-body">
                            <i class="fas fa-plus w-30px m-t-5"></i>
                            <div>
                                <h4 class="m-b-0 font-medium p-0">Tambah data dengan mengisi form</h4>
                                <span class="text-muted">Form berisi detail informasi hotel</span>
                            </div>
                            <div class="ml-auto">
                                <div class="tetx-right">
                                    <button onclick="window.location.href='<?= base_url('administrasi/add_hotel') ?>'" type="button" class="btn btn-info">Tambah Data Hotel</button>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex no-block card-body border-top">
                            <i class="fas fa-upload w-30px m-t-5"></i>
                            <div>
                                <h4 class="m-b-0 font-medium p-0">Tambah Data dengan import dari file</h4>
                                <span class="text-muted">Import data dari file Excel</span>
                            </div>
                            <div class="ml-auto">
                                <div class="tetx-right">
                                    <button onclick="window.location.href='<?= base_url('administrasi/import_hotel') ?>'" type="button" class="btn btn-info">Import from Excel File</button>
                                </div>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ============================================================== -->
<!-- End Container fluid  -->


<?php echo view('admin_views/v_adminFooter') ?>