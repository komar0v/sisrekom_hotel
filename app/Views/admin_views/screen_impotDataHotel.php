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
                <h4 class="page-title">Import Data Hotel</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('administrasi') ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('administrasi/menu_tambah_hotel') ?>">Menu Tambah</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Import Data Hotel</li>
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
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <?php echo form_open_multipart('Hotel/storeHotelDatas_fromFile', 'class="form-horizontal"'); ?>
                    <div class="card-body">
                        <h4 class="card-title">Import Hotel from File</h4>

                        <div class="form-group row">
                            <label class="col-md-3">File Upload</label>
                            <div class="col-md-9">
                                <input type="file" onchange="return validasiFile()" name="file_import" id="file_import" accept=".xls,.xlsx">
                                <script>
                                    function validasiFile() {
                                        var e = document.getElementById("file_import"),
                                            a = e.value;
                                        if (e.files[0].size > 1097152 && (toastr.warning("file tidak bisa diatas 1MB", "Gagal!"), e.value = ""), !/(\.xlsx|\.xls)$/i.exec(a)) return toastr.warning("hanya bisa file XLSX, XLS", "Gagal!"), e.value = "", !1;

                                    }
                                </script>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <?php echo form_close() ?>


                    </div>


                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Template File</h4>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">File contoh</label>
                            <div class="col-md-9">
                                <button type="button" class="btn btn-info"> <i class="fas fa-download"></i> Download</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End Container fluid  -->


    <?php echo view('admin_views/v_adminFooter') ?>