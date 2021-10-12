<?php echo view('pengguna_views/v_penggunaHeader') ?>

<!--Content Start-->
<div class="content transition">

    <div class="container-fluid dashboard">
        <h3>Rekomendasi hotel untuk kamu, <?= session()->get('nama_akunPengguna') ?></h3>
        <div class="container-fluid dashboard">

            <div class="row hasil_rekomen">

            <?php foreach($dataHotelRekom as $data){?>
                
                <div class="col-xl-4 el_item">
                    <div class="card">
                        <img class="card-img" src="<?= dot_array_search('dataHotel.hotel_photo_url',$data)?>" width="100" height="150" class="card-img-top">
                        <div class="text-center card-body">
                            <?= (dot_array_search('dataHotel.is_hotel_new',$data) == 1 ? '<p class="small text-center"> Baru!✨</p>' : ''); ?>
                            <h5 class="card-title"><?= dot_array_search('dataHotel.hotel_name',$data)?></h5>
                            <p class="card-text n_sim"><?=$data['nilai_similar']?></p>
                            <a href="<?= base_url('pengguna/detail_hotel/'.dot_array_search('dataHotel.id_hotel',$data))?>" class="btn btn-primary">detail</a>
                        </div>
                    </div>
                </div>

            <?php } ?>

            </div>

        </div>

        <!--End Start card-->

    </div>

</div>

</div>

<?php echo view('pengguna_views/v_penggunaFooter') ?>