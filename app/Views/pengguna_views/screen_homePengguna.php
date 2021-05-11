<?php echo view('pengguna_views/v_penggunaHeader') ?>

<!--Content Start-->
<div class="content transition">

    <div class="container-fluid dashboard">
        <h3>Halo, <?= session()->get('nama_akunPengguna') ?></h3>

        <div class="row">
            <div class="col-xl-4">
                <div class="card mb-3">
                    <div class="card-body text-primary">
                        <a class="weatherwidget-io" href="https://forecast7.com/en/n7d88110d43/special-region-of-yogyakarta/" data-label_1="Yogyakarta" data-font="Roboto" data-icons="Climacons Animated" data-mode="Current" data-theme="pure">Yogyakarta</a>
                        <script>
                            ! function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (!d.getElementById(id)) {
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = 'https://weatherwidget.io/js/widget.min.js';
                                    fjs.parentNode.insertBefore(js, fjs);
                                }
                            }(document, 'script', 'weatherwidget-io-js');
                        </script>
                    </div>
                </div>
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
                        <img class="card-img" src="<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/images/hotel_building.svg" width="100" height="150" class="card-img-top">
                        <div class="text-center card-body">
                            <h5 class="card-title">#nama_hotel</h5>
                            <p class="card-text">Hotel ini terletak di ...</p>

                        </div>
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