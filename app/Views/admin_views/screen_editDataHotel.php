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
                <h4 class="page-title">Edit Data Hotel</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('administrasi') ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('administrasi/semua_hotel') ?>">Semua Hotel</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Data Hotel</li>
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
                    <?php echo form_open('Hotel/storeEditedHotelDatas', 'class="form-horizontal"'); ?>
                    <div class="card-body">
                        <h4 class="card-title">Detail data </h4>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Nama Hotel</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="hotel_id" value="<?= $detailHotel['id_hotel'] ?>">
                                <input type="text" name="hotel_name" class="form-control" id="hotel_name" value="<?= $detailHotel['hotel_name'] ?>" placeholder="Nama Hotel">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Lokasi Hotel</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" name="hotel_location" id="hotel_location" class="form-control" value="<?= $detailHotel['hotel_location'] ?>" placeholder="Contoh : Jetis, Yogyakarta">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Hotel Rating</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" min="1.0" max="5.0" step="0.1" name="hotel_rating" value="<?= $detailHotel['hotel_rating'] ?>" placeholder="contoh : 5.0" id="hotel_rating">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Di review</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input style="text-align: right;" min="0" name="reviewed_by_users" type="number" value="<?= $detailHotel['reviewed_by_users'] ?>" class="form-control" placeholder="Reviewed .." name="reviewed_by_users">
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

                                    <option value="1" <?= $detailHotel['hotel_impression'] == '1' ? ' selected="selected"' : ''; ?>>terrible</option>
                                    <option value="2" <?= $detailHotel['hotel_impression'] == '2' ? ' selected="selected"' : ''; ?>>bad</option>
                                    <option value="3" <?= $detailHotel['hotel_impression'] == '3' ? ' selected="selected"' : ''; ?>>okay</option>
                                    <option value="4" <?= $detailHotel['hotel_impression'] == '4' ? ' selected="selected"' : ''; ?>>good</option>
                                    <option value="5" <?= $detailHotel['hotel_impression'] == '5' ? ' selected="selected"' : ''; ?>>fantastic</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Hotel Baru?</label>
                            <div class="col-md-9">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" value="baru" <?= ($detailHotel['is_hotel_new'] == 1 ? 'checked' : ''); ?> id="isHotelNew" name="isHotelNew" class="custom-control-input">
                                    <label class="custom-control-label" for="isHotelNew">Ya, hotel baru</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Harga Kamar per malam</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input style="text-align: right;" name="hotel_room_price" type="text" class="form-control" placeholder="Harga per kamar" value="<?= $detailHotel['hotel_room_price'] ?>" name="pricePerNight" id="pricePerNight">
                                    <div class="input-group-append">
                                        <span class="input-group-text">IDR</span>
                                    </div>
                                </div>
                                <script>
                                    var rupiah = document.getElementById("pricePerNight");
                                    rupiah.addEventListener("keyup", function(e) {
                                        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                        rupiah.value = formatRupiah(this.value, "");
                                    });

                                    function formatRupiah(angka, prefix) {
                                        var number_string = angka.replace(/[^,\d]/g, "").toString(),
                                            split = number_string.split(","),
                                            sisa = split[0].length % 3,
                                            rupiah = split[0].substr(0, sisa),
                                            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                        // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                        if (ribuan) {
                                            separator = sisa ? "." : "";
                                            rupiah += separator + ribuan.join(".");
                                        }

                                        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                        return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
                                    }
                                </script>
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
                                    
                                    <option value="1" <?= $detailHotel['primary_facility'] == '1' ? ' selected="selected"' : ''; ?>>Tiket CLEAN</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Secondary Facility</label>
                            <div class="col-md-9">
                                <select name="secondary_facility" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <option>--Select One--</option>
                                    <option value="1" <?= $detailHotel['secondary_facility'] == '1' ? ' selected="selected"' : ''; ?>>Pembatalan Gratis</option>
                                    <option value="2" <?= $detailHotel['secondary_facility'] == '2' ? ' selected="selected"' : ''; ?>>WiFi Gratis</option>
                                    <option value="3" <?= $detailHotel['secondary_facility'] == '3' ? ' selected="selected"' : ''; ?>>Sarapan Gratis</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Fasilitas</label>
                            <div class="col-md-9">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input <?= ($detailHotel['avail_resto'] == 1 ? 'checked' : ''); ?> type="checkbox" value="ada" name="avail_resto" class="custom-control-input" id="customControlAutosizing1">
                                    <label class="custom-control-label" for="customControlAutosizing1">Restaurant</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input <?= ($detailHotel['avail_swpool'] == 1 ? 'checked' : ''); ?> type="checkbox" value="ada" name="avail_swpool" class="custom-control-input" id="customControlAutosizing2">
                                    <label class="custom-control-label" for="customControlAutosizing2">Swimming Pool</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input <?= ($detailHotel['avail_ac'] == 1 ? 'checked' : ''); ?> type="checkbox" value="ada" name="avail_ac" class="custom-control-input" id="customControlAutosizing3">
                                    <label class="custom-control-label" for="customControlAutosizing3">Air Conditioner</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input <?= ($detailHotel['avail_gym'] == 1 ? 'checked' : ''); ?> type="checkbox" value="ada" name="avail_gym" class="custom-control-input" id="customControlAutosizing4">
                                    <label class="custom-control-label" for="customControlAutosizing4">GYM</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input <?= ($detailHotel['avail_spa'] == 1 ? 'checked' : ''); ?> type="checkbox" value="ada" name="avail_spa" class="custom-control-input" id="customControlAutosizing5">
                                    <label class="custom-control-label" for="customControlAutosizing5">Spa</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">URL Foto Hotel</label>
                            <div class="col-sm-9">
                                <input type="text" name="hotel_photo_url" class="form-control" placeholder="url to photo" value="<?= $detailHotel['hotel_photo_url'] ?>">
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
                            <?php echo form_close() ?>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Modal2"><i class="fas fa-trash-alt"></i> Hapus</button>
                            
                            <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Hotel?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <?php echo form_open('Hotel/deleteHotelDatas', 'class="form-horizontal"'); ?>
                                                Yakin hapus data <?= $detailHotel['hotel_name'] ?>?
                                                <input type="hidden" name="hotelid" value="<?= $detailHotel['id_hotel'] ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Ya hapus</button>
                                                <?= form_close()?>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
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