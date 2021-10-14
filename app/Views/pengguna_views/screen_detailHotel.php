<?php echo view('pengguna_views/v_penggunaHeader') ?>

<!--Content Start-->
<div class="content transition">

    <div class="container-fluid dashboard">
        <h3>Detail hotel, <?= $detailHotel['hotel_name'] ?></h3>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <img src="<?= $detailHotel['hotel_photo_url'] ?>" class="img-fluid p-2">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <?= ($detailHotel['is_hotel_new'] == 1 ? '<p class="small text-center"> Baru!✨</p>' : ''); ?>
                        <h5 class="text-center card-title"><?= $detailHotel['hotel_name'] ?></h5>
                        <h6 class="text-center card-subtitle mb-2 text-muted"><i class="fa fa-map-marker"></i> <?= $detailHotel['hotel_location'] ?></h6>
                        <p class="float-left btn btn-primary">Rating : <?= $detailHotel['hotel_rating'] ?></p>
                        <p class="float-right btn btn-success">
                            <?= $detailHotel['hotel_impression'] == '1' ? 'terrible 😟' : ''; ?>
                            <?= $detailHotel['hotel_impression'] == '2' ? 'bad 😐' : ''; ?>
                            <?= $detailHotel['hotel_impression'] == '3' ? 'okay 😉' : ''; ?>
                            <?= $detailHotel['hotel_impression'] == '4' ? 'good 🙂' : ''; ?>
                            <?= $detailHotel['hotel_impression'] == '5' ? 'fantastic 🤩' : ''; ?>

                        </p>

                        <br>

                        <p class="h6 text-center">Fasilitas</p>
                        <ul class="list-inline h3 text-center">
                            <?= ($detailHotel['avail_resto'] == 1 ? '<li class="list-inline-item"><i data-toggle="tooltip" data-placement="top" title="Restoran" class="las la-utensils"></i></li>' : ''); ?>
                            <?= ($detailHotel['avail_swpool'] == 1 ? '<li class="list-inline-item"><i data-toggle="tooltip" data-placement="top" title="Kolam Renang" class="las la-swimming-pool"></i></li>' : ''); ?>
                            <?= ($detailHotel['avail_ac'] == 1 ? '<li class="list-inline-item"><span data-toggle="tooltip" data-placement="top" title="Air Conditioner" class="icon-air-conditioner"></span></li>' : ''); ?>
                            <?= ($detailHotel['avail_gym'] == 1 ? '<li class="list-inline-item"><i data-toggle="tooltip" data-placement="top" title="GYM" class="las la-dumbbell"></i></li>' : ''); ?>
                            <?= ($detailHotel['avail_spa'] == 1 ? '<li class="list-inline-item"><i data-toggle="tooltip" data-placement="top" title="Spa" class="las la-spa"></i></li>' : ''); ?>
                        </ul>
                        <?= ($detailHotel['primary_facility'] == 1 ? '<h6 data-toggle="tooltip" data-placement="top" title="standarisasi protokol kesehatan dan kebersihan berdasarkan konfirmasi yang diberikan oleh masing-masing hotel" style="text-decoration: underline; text-decoration-color: #2ADD28; text-decoration-thickness: 2px;" class="text-center">Tiket Clean</h6>' : ''); ?>

                        <?= ($detailHotel['secondary_facility'] == 1 ? '<h6 data-toggle="tooltip" data-placement="top" title="Hotel tidak menarik biaya bila melakukan pembatalan pemesanan" style="text-decoration: underline; text-decoration-color: #2ADD28; text-decoration-thickness: 2px;" class="text-center">Pembatalan Gratis</h6>' : ''); ?>
                        <?= ($detailHotel['secondary_facility'] == 2 ? '<h6 style="text-decoration: underline; text-decoration-color: #2ADD28; text-decoration-thickness: 2px;" class="text-center">WiFi Gratis</h6>' : ''); ?>
                        <?= ($detailHotel['secondary_facility'] == 3 ? '<h6 style="text-decoration: underline; text-decoration-color: #2ADD28; text-decoration-thickness: 2px;" class="text-center">Sarapan Gratis</h6>' : ''); ?>

                        <hr>
                        <h6 class="text-center card-text">Harga mulai IDR <?= $detailHotel['hotel_room_price'] ?></h6>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title text-center">Pilihan Saya</h5>
                        <p class="float-left btn btn-primary">Rating : <?= $vectorProfile['hotel_rating'] ?></p>
                        <p class="float-right btn btn-success">
                            <?= $vectorProfile['hotel_impression'] == '1' ? 'terrible 😟' : ''; ?>
                            <?= $vectorProfile['hotel_impression'] == '2' ? 'bad 😐' : ''; ?>
                            <?= $vectorProfile['hotel_impression'] == '3' ? 'okay 😉' : ''; ?>
                            <?= $vectorProfile['hotel_impression'] == '4' ? 'good 🙂' : ''; ?>
                            <?= $vectorProfile['hotel_impression'] == '5' ? 'fantastic 🤩' : ''; ?>
                        </p>
                        <?= ($vectorProfile['is_hotel_new'] == 1 ? '<p class="small text-center"> Hotel Baru </p>' : ''); ?>
                        <br>

                        <p class="h6 text-center">Fasilitas</p>
                        <ul class="list-inline h3 text-center">
                            <?= ($vectorProfile['avail_resto'] == 1 ? '<li class="list-inline-item"><i data-toggle="tooltip" data-placement="top" title="Restoran" class="las la-utensils"></i></li>' : ''); ?>
                            <?= ($vectorProfile['avail_swpool'] == 1 ? '<li class="list-inline-item"><i data-toggle="tooltip" data-placement="top" title="Kolam Renang" class="las la-swimming-pool"></i></li>' : ''); ?>
                            <?= ($vectorProfile['avail_ac'] == 1 ? '<li class="list-inline-item"><span data-toggle="tooltip" data-placement="top" title="Air Conditioner" class="icon-air-conditioner"></span></li>' : ''); ?>
                            <?= ($vectorProfile['avail_gym'] == 1 ? '<li class="list-inline-item"><i data-toggle="tooltip" data-placement="top" title="GYM" class="las la-dumbbell"></i></li>' : ''); ?>
                            <?= ($vectorProfile['avail_spa'] == 1 ? '<li class="list-inline-item"><i data-toggle="tooltip" data-placement="top" title="Spa" class="las la-spa"></i></li>' : ''); ?>
                        </ul>
                        <?= ($vectorProfile['primary_facility'] == 1 ? '<h6 data-toggle="tooltip" data-placement="top" title="standarisasi protokol kesehatan dan kebersihan berdasarkan konfirmasi yang diberikan oleh masing-masing hotel" style="text-decoration: underline; text-decoration-color: #2ADD28; text-decoration-thickness: 2px;" class="text-center">Tiket Clean</h6>' : ''); ?>

                        <?= ($vectorProfile['secondary_facility'] == 1 ? '<h6 data-toggle="tooltip" data-placement="top" title="Hotel tidak menarik biaya bila melakukan pembatalan pemesanan" style="text-decoration: underline; text-decoration-color: #2ADD28; text-decoration-thickness: 2px;" class="text-center">Pembatalan Gratis</h6>' : ''); ?>
                        <?= ($vectorProfile['secondary_facility'] == 2 ? '<h6 style="text-decoration: underline; text-decoration-color: #2ADD28; text-decoration-thickness: 2px;" class="text-center">WiFi Gratis</h6>' : ''); ?>
                        <?= ($vectorProfile['secondary_facility'] == 3 ? '<h6 style="text-decoration: underline; text-decoration-color: #2ADD28; text-decoration-thickness: 2px;" class="text-center">Sarapan Gratis</h6>' : ''); ?>

                        <hr>
                        <h6 class="text-center card-text"> Harga kisaran
                        <?= ($vectorProfile['indx_htl_room_price'] == 1 ? '100rb hingga 200rb' :''); ?>
                        <?= ($vectorProfile['indx_htl_room_price'] == 2 ? '200rb hingga 300rb' :''); ?>
                        <?= ($vectorProfile['indx_htl_room_price'] == 3 ? '300rb hingga 400rb' :''); ?>
                        <?= ($vectorProfile['indx_htl_room_price'] == 4 ? '400rb hingga 500rb' :''); ?>
                        <?= ($vectorProfile['indx_htl_room_price'] == 5 ? '500rb hingga 600rb' :''); ?>
                        <?= ($vectorProfile['indx_htl_room_price'] == 6 ? '600rb hingga 700rb' :''); ?>
                        <?= ($vectorProfile['indx_htl_room_price'] == 7 ? '700rb hingga 800rb' :''); ?>
                        <?= ($vectorProfile['indx_htl_room_price'] == 8 ? '800rb hingga 900rb' :''); ?>
                        <?= ($vectorProfile['indx_htl_room_price'] == 9 ? '900rb hingga 1jt' :''); ?>
                        <?= ($vectorProfile['indx_htl_room_price'] == 10 ? 'diatas 1jt' :''); ?>
                        </h6>
                    </div>
                </div>
            </div>

            <!--End Start card-->

        </div>

    </div>

</div>

<?php echo view('pengguna_views/v_penggunaFooter') ?>