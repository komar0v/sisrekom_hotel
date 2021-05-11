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
                            <li class="breadcrumb-item"><a href="<?= base_url('administrasi/menu_tambah_hotel') ?>">Menu Tambah</a></li>
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
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <?php echo form_open('Administrasi/storeHotelDatas', 'class="form-horizontal"'); ?>
                    <div class="card-body">
                        <h4 class="card-title">Hotel Detail</h4>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Nama Hotel</label>
                            <div class="col-sm-9">
                                <input type="text" name="hotel_name" class="form-control" id="hotel_name" value="<?= old('hotel_name') ?>" placeholder="Nama Hotel">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Lokasi Hotel</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" name="hotel_location" id="hotel_location" class="form-control" placeholder="Contoh : Jetis, Yogyakarta">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Hotel Rating</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" min="1.0" max="5.0" step="0.1" name="hotel_rating" placeholder="contoh : 5.0" id="hotel_rating">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Di review</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input style="text-align: right;" min="0" name="reviewed_by_users" type="number" class="form-control" placeholder="Reviewed .." name="reviewed_by_users">
                                    <div class="input-group-append">
                                        <span class="input-group-text">kali</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Hotel Impression</label>
                            <div class="col-md-9">
                                <select name="hotel_impression" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <option>--Select One--</option>
                                    <option value="1">terrible</option>
                                    <option value="2">bad</option>
                                    <option value="3">okay</option>
                                    <option value="4">good</option>
                                    <option value="5">fantastic</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Hotel Baru?</label>
                            <div class="col-md-9">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" value="baru" id="isHotelNew" name="isHotelNew" class="custom-control-input">
                                    <label class="custom-control-label" for="isHotelNew">Ya, hotel baru</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Harga Kamar per malam</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input style="text-align: right;" name="hotel_room_price" type="text" class="form-control" placeholder="Harga per kamar" name="pricePerNight" id="pricePerNight">
                                    <div class="input-group-append">
                                        <span class="input-group-text">IDR</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Hotel Facility</h4>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Primary Facility</label>
                            <div class="col-md-9">
                                <select name="primary_facility" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <option selected value="1">Tiket CLEAN</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Secondary Facility</label>
                            <div class="col-md-9">
                                <select name="secondary_facility" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <option>--Select One--</option>
                                    <option value="1">Pembatalan Gratis</option>
                                    <option value="2">WiFi Gratis</option>
                                    <option value="3">Sarapan Gratis</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Fasilitas</label>
                            <div class="col-md-9">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" value="ada" name="avail_resto" class="custom-control-input" id="customControlAutosizing1">
                                    <label class="custom-control-label" for="customControlAutosizing1">Restaurant</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" value="ada" name="avail_swpool" class="custom-control-input" id="customControlAutosizing2">
                                    <label class="custom-control-label" for="customControlAutosizing2">Swimming Pool</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" value="ada" name="avail_ac" class="custom-control-input" id="customControlAutosizing3">
                                    <label class="custom-control-label" for="customControlAutosizing3">Air Conditioner</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" value="ada" name="avail_gym" class="custom-control-input" id="customControlAutosizing4">
                                    <label class="custom-control-label" for="customControlAutosizing4">GYM</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" value="ada" name="avail_spa" class="custom-control-input" id="customControlAutosizing5">
                                    <label class="custom-control-label" for="customControlAutosizing5">Spa</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">URL Foto Hotel</label>
                            <div class="col-sm-9">
                                <input type="text" name="hotel_photo_url" class="form-control" placeholder="url to photo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>

    <!-- ============================================================== -->
    <!-- End Container fluid  -->


    <?php echo view('admin_views/v_adminFooter') ?>