<!-- plugins:js -->
  <script src="<?php echo base_url();?>assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?php echo base_url();?>assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
   <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
              <a href="http://www.bootstrapdash.com/" target="_blank">Basicclass.co</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><!-- Hand-crafted & made with
              <i class="mdi mdi-heart text-danger"></i> -->
            </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <!-- inject:js -->
  <script src="<?php echo base_url();?>assets/js/off-canvas.js"></script>
  <script src="<?php echo base_url();?>assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo base_url();?>assets/js/dashboard.js"></script>
  <!-- End custom js for this page-->
  <script type="text/javascript">
    var day = "<?php date_default_timezone_set("Asia/Jakarta"); echo date('l');?>";
    var date= "<?php date_default_timezone_set("Asia/Jakarta"); echo date('d F Y');?>";
    $(document).ready(function() {
      $('#tableData').DataTable();
    } );
    $(document).ready(function(){
       setInterval(function(){
        get_location();
        get_day();
       },200000);
       get_day();
       get_location();
       $("#nama_produk").focus();
       $("#img_produk").focus();
    });

    function get_day() {
      $("#day").text(day);
      $("#date").text(date);
    }

    function get_location(){
        $.ajax({
          type:"GET",
          url : "https://ipapi.co/json/",
          dataType:"json",
          success:function(data){
            $("#city").text(data['city']);
            $("#country").text(data['country']);
            var lat = data['latitude'];
            var lon = data['longitude'];
            get_weather(lat,lon);
          }
        })
      }

    function get_weather(lat,lon){
      $.ajax({
        type:"GET",
        url : "https://api.openweathermap.org/data/2.5/weather?lat="+lat+"&lon="+lon+"&appid=0ceef937d1a33a7578544dd66b3bc985",
        dataType:"json",
        success:function(data){
          $("#weather_condition").text(data['weather'][0]['main']);
          var temp = data['main']['temp'];
          convertKelvinToCelsius(temp);
        }
      });
    }

    function convertKelvinToCelsius(temp) {
      if (temp < (0)) {
        return 'below absolute zero (0 K)';
      } else {
        var celcius_temp = (temp-273.15);
        var final = celcius_temp.toFixed(2); 
        $("#temp").text(final);
      }
    }
  </script>
</body>

</html>