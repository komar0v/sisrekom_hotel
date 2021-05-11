<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center">
  All Rights Reserved by 175314059. Designed by <a href="https://wrappixel.com">WrapPixel</a>.
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
<!-- Charts js Files -->

<!-- PENERIMA NOTIF -->
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/toastr/build/toastr.min.js"></script>
<script>
  toastr.options = {
    "progressBar": true,
    "positionClass": "toast-top-center",
    "timeOut": "3000",
  }
  <?= session()->getFlashdata('notif') ?>
</script>

<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/flot/excanvas.js"></script>
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/flot/jquery.flot.js"></script>
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/flot/jquery.flot.time.js"></script>
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/flot/jquery.flot.stack.js"></script>
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/flot/jquery.flot.crosshair.js"></script>
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url('/asset_web/admin_panel_assets') ?>/dist/js/pages/chart/chart-page-init.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<?php if (current_url() == base_url('administrasi/semua_pengguna')) { ?>
  <!-- Javascript Datatables -->
  <script>
    $('#tabel_users').DataTable();
  </script>
<?php } ?>

<?php if (current_url() == base_url('administrasi')) { ?>
  <!-- Javascript Ucapan -->
  <script>
    var h = (new Date()).getHours();
    if (h >= 4 && h < 10) {
      document.getElementById('ikon_ucapan').innerHTML = '<i class="mdi mdi-weather-sunset-up"></i>';
      document.getElementById('blk_ucapan').innerHTML = "Selamat Pagi";
    }
    if (h >= 10 && h < 15) {
      document.getElementById('ikon_ucapan').innerHTML = '<i class="mdi mdi-weather-sunny"></i>';
      document.getElementById('blk_ucapan').innerHTML = "Selamat Siang";
    }
    if (h >= 15 && h < 18) {
      document.getElementById('blk_ucapan').innerHTML = "Selamat Sore";
      document.getElementById('ikon_ucapan').innerHTML = '<i class="mdi mdi-weather-sunset"></i>';
    }
    if (h >= 18 || h < 4) {
      document.getElementById('ikon_ucapan').innerHTML = '<i class="mdi mdi-weather-night"></i>';
      document.getElementById('blk_ucapan').innerHTML = "Selamat Malam";
    }
  </script>
<?php } ?>

<?php if (current_url() == base_url('administrasi/add_hotel')) { ?>
  <script>
    $(".select2").select2();

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
<?php } ?>

<?php if (current_url() == base_url('administrasi/semua_hotel')) { ?>
  <script>
    function loadHotelDatas(){
      var table = $('#tabel_hotels').DataTable({
        "processing" : true,
        "serverside" : true,
        "order" : [],
        "ajax" : {
          "url": "<?= site_url('Administrasi/api_getNamaAlamatHotel') ?>",
          "type":"POST"
        }
      })
    }

    $(document).ready(function(){
      loadHotelDatas();
    });
  </script>
<?php } ?>
</body>

</html>