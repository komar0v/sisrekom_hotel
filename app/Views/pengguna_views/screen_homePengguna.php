<?php echo view('pengguna_views/v_penggunaHeader') ?>

<!--Content Start-->
<div class="content transition">

    <div class="container-fluid dashboard">
        <h3>Halo, <?= session()->get('nama_akunPengguna') ?></h3>

        <div class="row">
            <div class="col-xl-4">

            </div>

        </div>

        <div class="container-fluid dashboard">
            <h3 class="text-center">Mungkin kamu suka hotel ini?</h3>

            <div class="row">

                <!--Start card-->
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body text-center align-items-center">
                            <a href="#" class="btn btn-danger">
                                <h1>👎</h1>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <?php foreach ($detailHotel as $data_hotel) { ?>
                            <img class="card-img" src="<?= $data_hotel['hotel_photo_url'] ?>" width="100" height="150" class="card-img-top">
                            <div class="card-body">
                                <?= ($data_hotel['is_hotel_new'] == 1 ? '<p class="small text-center"> Baru!✨</p>' : ''); ?>
                                <h5 class="text-center card-title"><?= $data_hotel['hotel_name'] ?></h5>
                                <h6 class="text-center card-subtitle mb-2 text-muted"><i class="fa fa-map-marker"></i> <?= $data_hotel['hotel_location'] ?></h6>
                                <p class="float-left btn btn-primary">Rating : <?= $data_hotel['hotel_rating'] ?></p>
                                <p class="float-right btn btn-success">
                                    <?= $data_hotel['hotel_impression'] == '1' ? 'terrible 😟' : ''; ?>
                                    <?= $data_hotel['hotel_impression'] == '2' ? 'bad 😐' : ''; ?>
                                    <?= $data_hotel['hotel_impression'] == '3' ? 'okay 😉' : ''; ?>
                                    <?= $data_hotel['hotel_impression'] == '4' ? 'good 🙂' : ''; ?>
                                    <?= $data_hotel['hotel_impression'] == '5' ? 'fantastic 🤩' : ''; ?>
                            
                                </p>
                                
                                <br>
                                <hr>
                                <p class="h6 text-center">Fasilitas</p>
                                <ul class="list-inline h3 text-center">
                                    <?= ($data_hotel['avail_resto'] == 1 ? '<li class="list-inline-item"><i data-toggle="tooltip" data-placement="top" title="Restoran" class="las la-utensils"></i></li>' : ''); ?>
                                    <?= ($data_hotel['avail_swpool'] == 1 ? '<li class="list-inline-item"><i data-toggle="tooltip" data-placement="top" title="Kolam Renang" class="las la-swimming-pool"></i></li>' : ''); ?>
                                    <?= ($data_hotel['avail_ac'] == 1 ? '<li class="list-inline-item"><span data-toggle="tooltip" data-placement="top" title="Air Conditioner" class="icon-air-conditioner"></span></li>' : ''); ?>
                                    <?= ($data_hotel['avail_gym'] == 1 ? '<li class="list-inline-item"><i data-toggle="tooltip" data-placement="top" title="GYM" class="las la-dumbbell"></i></li>' : ''); ?>
                                    <?= ($data_hotel['avail_spa'] == 1 ? '<li class="list-inline-item"><i data-toggle="tooltip" data-placement="top" title="Spa" class="las la-spa"></i></li>' : ''); ?>
                                </ul>
                                <?= ($data_hotel['primary_facility'] == 1 ? '<h6 data-toggle="tooltip" data-placement="top" title="standarisasi protokol kesehatan dan kebersihan berdasarkan konfirmasi yang diberikan oleh masing-masing hotel" style="text-decoration: underline; text-decoration-color: #2ADD28; text-decoration-thickness: 2px;" class="text-center">Tiket Clean</h6>' : ''); ?>
                                
                                <?= ($data_hotel['secondary_facility'] == 1 ? '<h6 data-toggle="tooltip" data-placement="top" title="Hotel tidak menarik biaya bila melakukan pembatalan pemesanan" style="text-decoration: underline; text-decoration-color: #2ADD28; text-decoration-thickness: 2px;" class="text-center">Pembatalan Gratis</h6>' : ''); ?>
                                <?= ($data_hotel['secondary_facility'] == 2 ? '<h6 style="text-decoration: underline; text-decoration-color: #2ADD28; text-decoration-thickness: 2px;" class="text-center">WiFi Gratis</h6>' : ''); ?>
                                <?= ($data_hotel['secondary_facility'] == 3 ? '<h6 style="text-decoration: underline; text-decoration-color: #2ADD28; text-decoration-thickness: 2px;" class="text-center">Sarapan Gratis</h6>' : ''); ?>
                                
                                <hr>
                                <h6 class="text-center card-text">Harga mulai IDR <?= $data_hotel['hotel_room_price'] ?></h6>

                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body text-center align-items-center">
                            <a href="#" class="btn btn-info">
                                <h1>👍</h1>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!--End Start card-->

    </div>

</div>

</div>

<?php echo view('pengguna_views/v_penggunaFooter') ?>