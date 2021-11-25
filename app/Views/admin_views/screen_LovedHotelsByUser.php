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
                        <h4 class="page-title">Detail Statistik</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url('administrasi')?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Statistik</li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                                                <th>Nama Hotel</th>
                                                <th>Nilai Rekomendasi</th>
                                                <th>TP/FP</th>
                                                <!-- <th>Aksi</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($semuaHotelsLovedByUser as $lovedHotels){?>
                                            <tr>
                                                <td><?= $lovedHotels['hotel_name'] ?></td>
                                                <td>
                                                    <?php 
                                                    foreach($dataHotelRekom as $hasilRekom){
                                                        if($hasilRekom['idHotel']==$lovedHotels['id_hotel']){
                                                            echo($hasilRekom['nilai_similar']);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php if($lovedHotels['tp_fp']==null){?>
                                                        <p class="text-white badge rounded-pill bg-danger">NULL</p>
                                                    <?php } else if($lovedHotels['tp_fp']=='1'){ ?>
                                                        <p class="text-white badge rounded-pill bg-success">TP</p>
                                                    <?php } else if($lovedHotels['tp_fp']=='0'){ ?>
                                                        <p class="text-white badge rounded-pill bg-warning">FP</p>
                                                    <?php }?>
                                                </td>
                                                
                                            </tr>
                                        <?php }?>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Precision</h4>
                                <h6>Jumlah nilai tidak valid = <?=$tidakValid?> </h6>
                                <h6>Jumlah TP = <?=$jumlahTP?> </h6>
                                <h6>Jumlah FP = <?=$jumlahFP?> </h6>
                                <?php
                                    if($jumlahTP+$jumlahFP!=0){
                                        
                                        $nilaiPrecision = $jumlahTP/($jumlahTP+$jumlahFP);
                                        echo("<h6 class='text-success'>Precision = ".$nilaiPrecision."</h6>");
                                    }else{
                                        
                                        echo("<h6 class='text-danger'>!DIVISION BY ZERO!</h6>");
                                    }
                                    
                                ?>
                                <p>Dengan menggunakan rumus precision maka didapat demikian</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

<!-- ============================================================== -->
<!-- End Container fluid  -->


<?php echo view('admin_views/v_adminFooter') ?>