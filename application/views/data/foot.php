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
  <script src="<?php echo base_url();?>assets/js/dashboard.js"></script>
  <script type="text/javascript">
    var day = "<?php date_default_timezone_set("Asia/Jakarta"); echo date('l');?>";
    var date= "<?php date_default_timezone_set("Asia/Jakarta"); echo date('d F Y');?>";
    var base_url = "<?php echo base_url();?>";
    $(document).ready(function() {
      $('#tableData').DataTable({
        "search" : false
      });
    } );
    $(document).ready(function(){
       setInterval(function(){
        get_location();
        get_day();
       },200000);
       get_day();
       get_location();
       data_produk();
       data_penjualan();
       $("#nama_produk").focus();
       $("#img_produk").focus();
       $("#search_data").focus();
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

    function delete_produk(id_produk) {
      $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>admin/delete_produk/"+id_produk,
        dataType:"json",
        success:function(data){
          data_produk();
          $("html, body").animate({scrollTop: 0}, 1000);
          $("#text_berhasil").text('Delete produk berhasil');
            $("#berhasil").slideDown('slow').css('text-align','center');
            setTimeout(function(){$("#berhasil").slideUp('slow', function(){
              data_produk();
          });},2000);
        },
        error:function(error){
          data_produk();
          $("#text_gagal").text('Delete produk gagal');
            $("#gagal").slideDown('slow').css('text-align','center');
            setTimeout(function(){$("#gagal").slideUp('slow', function(){
          });},2000);
        }
      });
    }

    function data_produk() {
      $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>admin/get_produk",
        dataType:"json",
        success:function(data){
          html = '';
          var i = 0;
          for(i=0; i<data.length; i++){
             html += '<tr>'+
                        '<td>'+data[i].kode_produk+'</td>'+
                        '<td>'+data[i].nama_produk+'</td>'+
                        '<td>'+data[i].nama_kategori_produk+'</td>'+
                        '<td>'+data[i].harga_produksi+'</td>'+
                        '<td>'+data[i].harga_jual+'</td>'+
                        '<td>'+data[i].stok+'</td>'+
                        '<td>'+
                          '<div class="row">'+
                              '<div class="col-md-3 col-sm-3">'+
                                  '<div class="dropdown show">'+
                                      '<a class="btn btn-primary dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</a>'+
                                        '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">'+
                                            '<a class="dropdown-item" href="'+base_url+'admin/tambah_foto_produk/'+data[i].id_produk+'">Tambah Foto Produk</a>'+
                                        '<a class="dropdown-item" href="#">Detail Produk</a>'+
                                        '<a class="dropdown-item" href="#">Edit produk</a>'+
                                        '<a class="dropdown-item text-danger" href="#" onclick="delete_produk('+data[i].id_produk+')">Delete</a>'+
                                      '</div>'+
                                  '</div>'+
                                '</div>'+
                            '</div>'+
                        '</td>'+
                    '</tr>';
            }
          $("#data_produk").html(html);
        }
      });
    }

    function data_penjualan() {
      $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>admin/get_penjualan",
        dataType:"json",
        success:function(data){
          html = '';
          stat = '';
          var i = 0;
          for(i=0; i<data.length; i++){
             html += '<tr>'+
                        '<td>'+data[i].kode_penjualan+'</td>'+
                        '<td>'+data[i].tanggal_penjualan+'</td>'+
                        '<td>'+data[i].nama_pembeli+'</td>'+
                        '<td>'+data[i].alamat_pembeli+'</td>'+
                        '<td>'+data[i].nomor_telepon+'</td>'+
                        '<td>Rp '+data[i].ongkos_kirim.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
                        '<td>Rp '+data[i].total.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
                        '<td>'+
                          '<div class="row">'+
                              '<div class="col-md-3 col-sm-3">'+
                                  '<div class="dropdown show">'+
                                      '<a class="btn btn-primary dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</a>'+
                                        '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">'+
                                        '<a class="dropdown-item" href="'+base_url+'admin/cetak_nota/'+data[i].id_penjualan+'">Cetak Nota</a>'+
                                        '<a class="dropdown-item" href="#">Detail Penjualan</a>'+
                                        '<a class="dropdown-item" href="#">Edit Penjualan</a>'+
                                        '<a class="dropdown-item text-danger" href="#" onclick="delete_penjualan('+data[i].id_penjualan+')">Delete</a>'+
                                      '</div>'+
                                  '</div>'+
                                '</div>'+
                            '</div>'+
                        '</td>'+
                    '</tr>';
                  }
          $("#data_penjualan").html(html);
        }
      });
    }

    function delete_penjualan(id_penjualan) {
      $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>admin/delete_penjualan/"+id_penjualan,
        dataType:"json",
        success:function(data){
          data_penjualan();
          $("html, body").animate({scrollTop: 0}, 1000);
          $("#text_berhasil").text('Delete penjualan berhasil');
            $("#berhasil").slideDown('slow').css('text-align','center');
            setTimeout(function(){$("#berhasil").slideUp('slow', function(){
              data_penjualan();
          });},2000);
        },
        error:function(error){
          $("html, body").animate({scrollTop: 0}, 1000);
          $("#text_gagal").text('Delete penjualan gagal');
            $("#gagal").slideDown('slow').css('text-align','center');
            setTimeout(function(){$("#gagal").slideUp('slow', function(){
          });},2000);
        }
      });
    }
  </script>
</body>

</html>