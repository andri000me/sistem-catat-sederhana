function scan_data(){
      var input = $("#search_data").val();
      if(input.length === 0){
        $("#suggestions").hide();
      }else{
        var post_data = {
          'search_data': input,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        };
        $.ajax({
          type:"POST",
          url : base_url+"admin/scan_data",
          data : post_data,
          success:function(data){
            if(data.length > 0){
              $("#suggestions").show();
              $("#autoSuggestionsList").addClass('auto_list');
              $("#autoSuggestionsList").html(data);
            }
          }
        });
      }
    }

    var i =0;
    function add_barang(e) {
      var produk_kode = $(e).data("produkkode");
      var produk_id = $(e).data("produkid");
      var produk_harga = $(e).data("produkharga");
      var produk_nama = $(e).data("produknama");
      var qtyItem = $("#qty"+produk_id);
      var quantity = 1;

    
        var subtotal = quantity*produk_harga;
        $("#pesanan").append('<tr>'+
            '<td><input type="hidden" name="id_produk['+i+']" value="'+produk_id+'"><input type="text" name="kode_produk['+i+']" value="'+produk_kode+'" class="form-barang">'+
            '</td>'+
            '<td><input type="text" name="nama_produk['+i+']" value="'+produk_nama+'" class="form-barang"></td>'+
            '<td><input type="text" name="harga_produk['+i+']" value="'+produk_harga+'" class="form-barang harga_produk"></td>'+
            '<td><input type="number" name="quantity['+i+']" value="'+quantity+'" id="qty'+produk_id+'" class="form-control quantity" onkeyup="update_qty();"></td>'+
            '<td><select name="size['+i+']" class="form-control">'+
            '<option>S</option>'+
            '<option>M</option>'+
            '<option>L</option>'+
            '<option>XL</option>'+
            '<option>XXL</option>'+
            '</select></td>'+
            '<td><input type="text" name="subtotal['+i+']" value="'+subtotal+'" id="sub'+produk_id+'" class="form-barang subtotal"></td>'+
            '<td><a href="javascript:void(0)" class="btn btn-danger" onclick="hapus_row(this)"><i class="mdi mdi-delete"></i></a></td>'+
          '</tr>'
          );
        i++;
        total();
        $("#search_data").val("").focus();
        $("#suggestions").hide();
      
    }

    function hapus_row(e) {
      $(e).parent().parent().remove();
      total();
    }

    function total() {
      var sum = 0;
        $(".subtotal").each(function() {
          var value = $(this).val();
            if(!isNaN(value) && value.length != 0) {
                  sum += parseFloat(value);
                }
            });
        $("#total").val(sum);
    }

    $("#btnSimpanPesanan").click(function(event){
        event.preventDefault();
        var conf = confirm('Are you sure?');
        var form_data = $('form').serialize();
        if(conf){
          if($("#nama_pembeli").val() == ''){
            alert('Nama Pembeli tidak boleh kosong');
            $("#nama_pembeli").focus();
          }else if($("#alamat_pembeli").val() == ''){
            alert('Alamati tidak boleh kosong');
            $("#alamat_pembeli").focus();
          }else if($("#nomor_telepon").val() == ''){
            alert('Nomor telepon tidak boleh kosong');
            $("#nomor_telepon").focus();
          }else if($("#kota_tujuan").val() == ''){
            alert('Pilih kota tujuan terlebih dahulu');
            $("#kota_tujuan").focus();
          }else{
            $.ajax({
              type:"POST",
              url : base_url+"transaction/add_pesanan",
              dataType : "JSON",
              data : form_data,
              success:function(data){
                $("html, body").animate({scrollTop: 0}, 1000);
                alert('Pesanan berhasil ditambahkan!');
                $('form').trigger('reset');
                $("#pesanan").empty();
                window.location = base_url+'transaction/detail_penjualan/'+data.last_id;
              },
              error:function(data){
                $("html, body").animate({scrollTop: 0}, 1000);
                alert('Pesanan gagal ditambahkan, terjadi kesalahan');
              }
            });
          }
        }else{

        }
    });

    function update_qty() {
      total();
      quantity();
      $(".quantity").keyup(function(){
          quantity();
          total();
      });
    }

    function quantity() {
      var sum = 0;
          $('#myTable > tbody  > tr').each(function() {
              var id = $(this).find('.id').val();
              var qty = $(this).find('.quantity').val();
              var price = $(this).find('.harga_produk').val();
              var amount = (qty*price)
              sum+=amount;
              $(this).find('.subtotal').val(amount);
          });
    }