<?php echo view('pengguna_views/v_penggunaHeader') ?>

<!--Content Start-->
<div class="content transition">
    <div class="container-fluid dashboard">

        <div class="container-fluid dashboard">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header font-weight-bold mr-auto">
                            <h4>Profil Saya</h4>
                        </div>
                        <div class="card-body">
                            <?= form_open('pengguna/updateAkunPengguna') ?>
                            <div class="form-group">
                                <label>Nama</label>
                                <input autocomplete="off" placeholder="nama akun" type="text" class="form-control" name="namaAkunPengguna" value="<?= $namaAkunPengguna ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input autocomplete="off" id="email_akun" placeholder="email akun" type="email" class="form-control" name="emailAkunPengguna" value="<?= $emailAkunPengguna ?>" required>
                                <div id="email_result">‏‏‎ ‎</div>
                            </div>
                        </div>
                        <div class="text-center card-footer">

                            <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
                            <?= form_close() ?>
                            <button type="button" data-toggle="collapse" data-target="#frmPasswd" class="btn btn-info">Ubah Password</button>
                        </div>
                        <div class="collapse" id="frmPasswd">
                            <div class="card card-body">
                                <?= form_open('pengguna/updatePasswordPengguna') ?>
                                <div class="form-group">
                                    <label>Password baru</label>
                                    <input autocomplete="off" type="password" class="form-control" name="passwordAkunPengguna">

                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Password Baru</button>
                                <?= form_close() ?>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header font-weight-bold mr-auto">
                            <h4>Pengaturan Rekomendasi</h4>
                        </div>
                        <div class="card-body text-center">
                            <button type="button" data-toggle="collapse" data-target="#frmResetRecomm" id="btnResetRekom" class="btn btn-success">Reset Rekomendasi</button>
                        </div>
                        <div class="collapse" id="frmResetRecomm">
                            <div class="card card-body">
                                <p>Rekomendasi direset akan menghilangkan hasil rekomendasi Anda saat ini, lanjutkan?</p>
                                <button type="button" onclick="location.href='<?= base_url('pengguna/reset_rekomendasi')?>';" class="btn btn-primary">Ya</button>
                            </div>
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