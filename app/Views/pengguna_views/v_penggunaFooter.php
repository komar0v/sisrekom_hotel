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

<?php if (current_url() == base_url('pengguna/profil_saya')) { ?>

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
                            if (response === "used") {
                                $('#email_result').html("<span style='color: red;'>email sudah digunakan! Gunakan yang lain.</span>");
                                document.getElementById("btnSubmit").disabled = true;
                            } else {
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

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<?php if (current_url() == base_url('pengguna')) { ?>
    <script>
        function refreshpage() {
            location.reload();
        }

        $(function() {

            // Ajax form submission
            $('#frm-add-user').on('submit', function(e) {

                e.preventDefault();

                var formData = new FormData(this);
                // OR var formData = $(this).serialize();

                //We can add more values to form data
                //formData.append("key", "value");

                $.ajax({
                    url: "<?= base_url('Rekomen_Engine/add_to_loved') ?>",
                    type: "POST",
                    cache: false,
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    success: function(data) {
                        if (data.success == true) {
                            document.getElementById("loved_btn").disabled = true;
                            toastr.success("Hotel yang disukai berhasil ditambahkan.", "Berhasil!");
                            setTimeout(function(){document.getElementById("loved_btn").disabled = false;},2500);
                            setTimeout(function(){ refreshpage() }, 3000);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        toastr.error("Hotel yang disukai gagal ditambahkan.", "Gagal!");
                    }
                });
            });
        });
    </script>
<?php } ?>

</body>

</html>