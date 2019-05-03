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
       $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
       get_day();
       get_location();
       data_produk();
       data_penjualan();
       data_kategori_produk();
       $("#nama_produk").focus();
       $("#img_produk").focus();
       $("#search_data").focus();
       $("#nama_kategori_produk").focus();

       $("#warna").change(function() {
         var current = $('#warna').val();
         if($("#warna").val() == "Black") {
            $('#color_show').css('background-color','black');
         }else if($("#warna").val() == 'White'){
            $('#color_show').css('background-color','white');
         }else if($("#warna").val() == 'Navy'){
            $('#color_show').css('background-color','#000080');
         }else if($("#warna").val() == 'Red'){
            $('#color_show').css('background-color','red');
         }else if($("#warna").val() == 'Maroon'){
            $('#color_show').css('background-color','#800000');
         }else if($("#warna").val() == 'Forest Green'){
            $("#color-show").css('background-color','#228B22');
         }else{
            $("#color-show").css('background-color','pink');
         }
      });

        setTimeout(function(){$("#berhasil_php").slideUp('slow', function(){
          });},1000);

        setTimeout(function(){$("#gagal_php").slideUp('slow', function(){
          });},1000);
    });

    function get_day() {
      $("#day").text(day);
      $("#date").text(date);
    }

    function get_location(){
        $.ajax({
          type:"GET",
          url : "https://api.ipgeolocation.io/ipgeo?apiKey=aa0ac61c65f94974a9e3208d156ed3c5",
          dataType:"json",
          success:function(data){
            $("#city").text(data['city']);
            $("#country").text(data['country_name']);
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
        var final = celcius_temp.toFixed(0); 
        $("#temp").text(final);
      }
    }

    function delete_produk(id_produk) {
      var conf = confirm('Are you sure?');
      if(conf){
        $.ajax({
          type:"POST",
          url: base_url+"admin/delete_produk/"+id_produk,
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
      }else{

      }
    }

    function data_produk() {
      $.ajax({
        type:"POST",
        url:base_url+"admin/get_produk",
        dataType:"json",
        success:function(data){
          html = '';
          var i = 0;
          for(i=0; i<data.length; i++){
             html += '<tr>'+
                        '<td>'+data[i].kode_produk+'</td>'+
                        '<td>'+data[i].nama_produk+'</td>'+
                        '<td>'+data[i].nama_kategori_produk+'</td>'+
                        '<td>Rp '+data[i].harga_produksi.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
                        '<td>Rp '+data[i].harga_jual.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
                        '<td>'+data[i].stok+'</td>'+
                        '<td>'+
                          '<div class="row">'+
                              '<div class="col-md-3 col-sm-3">'+
                                  '<div class="dropdown show">'+
                                      '<a class="btn btn-primary btn-sm dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</a>'+
                                        '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">'+
                                            '<a class="dropdown-item" href="'+base_url+'admin/tambah_foto_produk/'+data[i].id_produk+'">Tambah Foto Produk</a>'+
                                        '<a class="dropdown-item" href="'+base_url+'admin/detail_produk/'+data[i].id_produk+'">Edit produk</a>'+
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
        url:base_url+"admin/get_penjualan",
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
                        '<td>'+data[i].nomor_telepon+'</td>'+
                        '<td>Rp '+data[i].total.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
                        '<td>'+data[i].status+'</td>'+
                        '<td>'+
                          '<div class="row">'+
                              '<div class="col-md-3 col-sm-3">'+
                                  '<div class="dropdown show">'+
                                      '<a class="btn btn-primary btn-sm dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</a>'+
                                        '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">'+
                                        '<a class="dropdown-item" href="'+base_url+'admin/cetak_nota/'+data[i].id_penjualan+'" target="_blank">Cetak Nota</a>'+
                                        '<a class="dropdown-item" href="'+base_url+'transaction/detail_penjualan/'+data[i].id_penjualan+'">Detail Penjualan</a>'+
                                        '<a class="dropdown-item" href="'+base_url+'transaction/edit_penjualan/'+data[i].id_penjualan+'">Edit Penjualan</a>'+
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
      var conf = confirm('Are you sure?');
      if(conf){
        $.ajax({
          type:"POST",
          url:base_url+"admin/delete_penjualan/"+id_penjualan,
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
      }else{

      }
    }

    function delete_foto_produk(id_detail_produk) {
      var conf = confirm('Are you sure?');
      if(conf){
          $.ajax({
            type:"POST",
            url:base_url+"admin/delete_foto_produk/"+id_detail_produk,
            success:function(data){
            $("html, body").animate({scrollTop: 0}, 1000);
            $("#text_berhasil").text('Delete foto produk berhasil');
              $("#berhasil").slideDown('slow').css('text-align','center');
              setTimeout(function(){$("#berhasil").slideUp('slow', function(){
                window.location.reload();
            });},2000);
          },
          error:function(error){
            $("#text_gagal").text('Delete foto produk gagal');
              $("#gagal").slideDown('slow').css('text-align','center');
              setTimeout(function(){$("#gagal").slideUp('slow', function(){
            });},2000);
          }
        });
      }else{

      }
    }

    $("#btnSimpanKategori").click(function(event){
      event.preventDefault();
      var nama_kategori_produk = $("#nama_kategori_produk").val();
      var conf = confirm('Are you sure?');
      if(conf){
            $.ajax({
            type:"POST",
            url : base_url+"admin/add_kategori_produk",
            dataType : "json",
            data : {
              nama_kategori_produk : nama_kategori_produk
            },
            success:function(data){
              if(data.valid == true){
                data_kategori_produk();
                $("html, body").animate({scrollTop: 0}, 1000);
                $("#text_berhasil").text(data.msg);
                  $("#berhasil").slideDown('slow').css('text-align','center');
                  setTimeout(function(){$("#berhasil").slideUp('slow', function(){
                });},2000);
                }else{
                  $("#text_gagal").text(data.msg);
                  $("#gagal").slideDown('slow').css('text-align','center');
                  setTimeout(function(){$("#gagal").slideUp('slow', function(){
                  });},2000);
                }
              },
            error:function(data){
                if(data.valid == false){
                  $("#text_gagal").text(data.msg);
                  $("#gagal").slideDown('slow').css('text-align','center');
                  setTimeout(function(){$("#gagal").slideUp('slow', function(){
                });},2000);
              }
            }
          });
      }else{

      }
    });

    function data_kategori_produk() {
      $.ajax({
        type:"POST",
        url : base_url+"admin/get_kategori_produk",
        dataType : "json",
        success:function(data){
          html = '';
          var i = 0;
          for(i=0;i<data.length;i++){
            html += '<tr>'+
                        '<td>'+data[i].nama_kategori_produk+'</td>'+
                        '<td>'+
                          '<div class="row">'+
                              '<div class="col-md-3 col-sm-3">'+
                                  '<div class="dropdown show">'+
                                      '<a class="btn btn-primary btn-sm dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</a>'+
                                        '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">'+
                                        '<a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#myModalEdit" onclick="get_kategori('+data[i].id_kategori_produk+');">Edit Kategori</a>'+
                                        '<a class="dropdown-item text-danger" href="javascript:void(0);" onclick="delete_kategori('+data[i].id_kategori_produk+');">Delete</a>'+
                                       
                                      '</div>'+
                                  '</div>'+
                                '</div>'+
                            '</div>'+
                        '</td>'+
                    '</tr>';
                  }
          $("#data_kategori_produk").html(html);
        }
      });
    }

    function get_kategori(id_kategori_produk) {
      $.ajax({
        type : "POST",
        url : base_url+"admin/get_kategori_produk_by_id/"+id_kategori_produk,
        dataType : "json",
        success:function(data){
          $("#edit_nama_kategori_produk").val(data[0].nama_kategori_produk);
          $("#id_edit_kategori_produk").val(data[0].id_kategori_produk);
        },
        error:function(error){
          $("#edit_nama_kategori_produk").val('Not Found');
        }
      });
    }

    $("#btnEditKategori").click(function(event){
       event.preventDefault();
       var edit_nama_kategori_produk = $("#edit_nama_kategori_produk").val();
       var id_kategori_produk = $("#id_edit_kategori_produk").val();
       var conf = confirm('Are you sure?');

       if(conf){
        $.ajax({
          type : "POST",
          url : base_url+"admin/edit_kategori_produk/"+id_kategori_produk,
          dataType : "json",
          data : {
            edit_nama_kategori_produk : edit_nama_kategori_produk
          },
           success:function(data){
                if(data.valid == true){
                  $("html, body").animate({scrollTop: 0}, 1000);
                    $("#text_berhasil_edit").text(data.msg);
                      $("#berhasil_edit").slideDown('slow').css('text-align','center');
                      setTimeout(function(){$("#berhasil_edit").slideUp('slow', function(){
                        data_kategori_produk();
                        $("#myModal").hide()
                    });},2000);
                }else{
                    $("#text_gagal_edit").text(data.msg);
                    $("#gagal_edit").slideDown('slow').css('text-align','center');
                    setTimeout(function(){$("#gagal_edit").slideUp('slow', function(){
                  });},2000);
                }     
              },
              error:function(error){
                $("#text_gagal_edit").text('Kategori produk gagal diperbaharui');
                  $("#gagal_edit").slideDown('slow').css('text-align','center');
                  setTimeout(function(){$("#gagal_edit").slideUp('slow', function(){
                });},2000);
              }
        })
       }else{

       }
    });

    function delete_kategori(id_kategori_produk){
     var conf = confirm('Are you sure?');
     if(conf){
        $.ajax({
          type : "POST",
          url : base_url+"admin/delete_kategori_produk/"+id_kategori_produk,
          dataType : "json",
          success:function(data){
                $("html, body").animate({scrollTop: 0}, 1000);
                $("#text_berhasil_dlt").text('Kategori produk berhasil dihapus');
                  $("#berhasil_dlt").slideDown('slow').css('text-align','center');
                  setTimeout(function(){$("#berhasil_dlt").slideUp('slow', function(){
                    data_kategori_produk();
                });},2000);
              },
              error:function(error){
                $("#text_gagal_dlt").text('Kategori produk gagal diperbaharui');
                  $("#gagal_dlt").slideDown('slow').css('text-align','center');
                  setTimeout(function(){$("#gagal_dlt").slideUp('slow', function(){
                });},2000);
            }
        })
     }else{

     }
    }

    function printData()
    {
       var divToPrint=document.getElementById("printTable");
       newWin= window.open("");
       newWin.document.write(divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    }

    $('#btnPrint').on('click',function(){
    printData();
    });

    $(document).ready(function(){  
           $('#btn-search').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();
                  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:base_url+"admin/cari_laporan",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                            $('#detail_laporan').html(data);
                          }  
                     });  
                }  
                else  
                {  
                    alert("Please Select Date");  
                    $("#from_date").focus();
                }  
           });

           $("#btn-refresh").click(function(){
              $('#detail_laporan').empty();
              $('.datepicker').val("");
           });  
      });

    function edit_detail(id_detail_penjualan) {
      $.ajax({
        type:"POST",
        url : base_url+"transaction/get_produk_list/"+id_detail_penjualan,
        dataType : "json",
        success:function(data){
          $("#quantity_edit").val(data.quantity);
          $("#size_edit").val(data.size).text(data.size);
          $("#id_penjualan_edit").val(data.id_penjualan);
          $("#id_detail_penjualan_edit").val(data.id_detail_penjualan);
          $("#harga_edit").val(data.harga_produk);
          $("#id_produk_edit").val(data.id_produk);
        },
        error:function(error){
          $("#quantity_edit").val('Not Found');
          console.log(error);
        }
      });
    }

    $("#btnEditDetailProduk").click(function(event){
      event.preventDefault();
      var id_detail_penjualan_edit = $("#id_detail_penjualan_edit").val();
      var id_penjualan_edit = $("#id_penjualan_edit").val();
      var harga_edit = $("#harga_edit").val();
      var quantity_edit = $("#quantity_edit").val();
      var size_edit = $("#size_edit").val();
      var id_produk_edit = $("#id_produk_edit").val();
      var conf = confirm('Are you sure?');

      if(conf){
        $.ajax({
          type:"POST",
          url : base_url+"transaction/edit_detail_penjualan",
          data : {
            id_detail_penjualan_edit : id_detail_penjualan_edit,
            id_penjualan_edit : id_penjualan_edit,
            harga_edit : harga_edit,
            quantity_edit : quantity_edit,
            size_edit : size_edit,
            id_produk_edit : id_produk_edit
          },
          dataType:"json",
          success:function(data){
             $("#text_berhasil_edit_detail").text('Produk penjualan berhasil diperbarui');
                  $("#berhasil_edit_detail").slideDown('slow').css('text-align','center');
                  setTimeout(function(){$("#berhasil_edit_detail").slideUp('slow', function(){
                    window.location.reload();
            });},2000);
          },
          error:function(error){
             $("#text_gagal_edit_detail").text('Produk penjualan gagal diperbarui');
                  $("#gagal_edit_detail").slideDown('slow').css('text-align','center');
                  setTimeout(function(){$("#gagal_edit_detail").slideUp('slow', function(){
            });},2000);
          }
        });
      }else{

      }
    });

    $("#btnEditPembeli").click(function(event){
      event.preventDefault();

      var id_penjualan_pembeli = $("#id_penjualan_pembeli").val();
      var nama_pembeli_edit = $("#nama_pembeli_edit").val();
      var nomor_telepon_edit = $("#nomor_telepon_edit").val();
      var alamat_pembeli_edit = $("#alamat_pembeli_edit").val();
      var kota_tujuan_edit = $("#kota_tujuan_edit").val();
      var conf = confirm('Are you sure?');

      if(conf){
        $.ajax({
          type : "POST",
          url : base_url+"transaction/edit_pembeli",
          data : {
            id_penjualan_pembeli : id_penjualan_pembeli,
            nama_pembeli_edit : nama_pembeli_edit,
            nomor_telepon_edit : nomor_telepon_edit,
            alamat_pembeli_edit : alamat_pembeli_edit,
            kota_tujuan_edit : kota_tujuan_edit
          },
          dataType : "json",
          success:function(data){
            $("html, body").animate({scrollTop: 0}, 1000);
             $("#text_berhasil_edit_pembeli").text('Sukses Edit Pembeli');
                  $("#berhasil_edit_pembeli").slideDown('slow').css('text-align','center');
                  setTimeout(function(){$("#berhasil_edit_pembeli").slideUp('slow', function(){
                    window.location.reload();
            });},2000);
          },
          error:function(error){
            $("html, body").animate({scrollTop: 0}, 1000);
            $("#text_gagal_edit_pembeli").text('Gagal Edit Pembeli');
                  $("#gagal_edit_pembeli").slideDown('slow').css('text-align','center');
                  setTimeout(function(){$("#gagal_edit_pembeli").slideUp('slow', function(){
            });},2000);
          }
        });
      }else{

      }
    });