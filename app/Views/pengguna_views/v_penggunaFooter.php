<!-- Footer -->
<div class="footer transition">
    <hr>
    <p>
        &copy; 2020 All Right Reserved by 175314059
    </p>
</div>

<!-- Loader -->
<div class="loader">
    <div class="spinner-border text-light" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<div class="loader-overlay"></div>

<!-- Library Javascipt-->

<script src="<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/vendors/bootstrap/js/jquery.min.js"></script>
<script src="<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/vendors/bootstrap/js/popper.min.js"></script>
<script src="<?php echo base_url('/asset_web/user_panel_assets') ?>/assets/js/script.js"></script>

<!-- PENERIMA NOTIF -->
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/toastr/build/toastr.min.js"></script>
<script>
toastr.options = {
  "progressBar": true,
  "timeOut": "3000",
}
<?= session()->getFlashdata('notif') ?>
</script>

<?php if( current_url() == base_url('pengguna/profil_saya')){ ?>

    <script>
    $(document).ready(function() {
        $("#email_akun").keyup(function() {
            var emailAkun = $("#email_akun").val();
            if (emailAkun != '') {
                $.ajax({
                    url: '<?php echo base_url('pengguna/api_cekEmailTersedia') ?>',
                    type: 'POST',
                    data: {
                        email_Akun: emailAkun
                    },
                    success: function(response) {
                        if(response==="used"){
                            $('#email_result').html("<span style='color: red;'>email sudah digunakan! Gunakan yang lain.</span>");
                            document.getElementById("btnSubmit").disabled = true;
                        }else{
                            $('#email_result').html("<span style='color: green;'>email dapat digunakan.</span>");
                            document.getElementById("btnSubmit").disabled = false;
                        }
                        
                    }
                });
            } else {
                $("#email_result").html(" ");
            }
        });
    });
</script>
<?php } ?>
</body>

</html>