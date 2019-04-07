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

      if($("#pesanan tr td input[value='"+produk_id+"']").length == 0 && qtyItem.length == 0){
        var subtotal = quantity*produk_harga;
        $("#pesanan").append('<tr>'+
            '<td><input type="hidden" name="id_produk['+i+']" value="'+produk_id+'"><input type="text" name="kode_produk['+i+']" value="'+produk_kode+'" class="form-barang">'+
            '</td>'+
            '<td><input type="text" name="nama_produk['+i+']" value="'+produk_nama+'" class="form-barang"></td>'+
            '<td><input type="text" name="harga_produk['+i+']" value="'+produk_harga+'" class="form-barang"></td>'+
            '<td><input type="number" name="quantity['+i+']" value="'+quantity+'" id="qty'+produk_id+'" class="form-control"></td>'+
            '<td><input type="text" name="size['+i+']" value="" class="form-control" placeholder="Isikan Size"></td>'+
            '<td><input type="text" name="subtotal['+i+']" value="'+subtotal+'" id="sub'+produk_id+'" class="form-barang subtotal"></td>'+
            '<td><a href="javascript:void(0)" class="btn btn-danger" onclick="hapus_row(this)"><i class="mdi mdi-delete"></i></a></td>'+
          '</tr>'
          );
        i++;
        total();
        $("#search_data").val("").focus();
        $("#suggestions").hide();
      }else{
        var currentVal = parseFloat(qtyItem.val());
        if(!isNaN(currentVal) && qtyItem.length == 1){
        qtyItem.attr('value',currentVal+1) ;
        }
        $("#sub"+produk_id).val( qtyItem.val()*produk_harga);
        total();
        $("#suggestions").hide();
        $("#search_data").val("").focus();
      }
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

        var form_data = $('form').serialize();

        if($("#nama_pembeli").val() == ''){
          alert('Nama Pembeli tidak boleh kosong');
          $("#nama_pembeli").focus();
        }else if($("#alamat_pembeli").val() == ''){
          alert('Alamati tidak boleh kosong');
          $("#alamat_pembeli").focus();
        }else if($("#nomor_telepon").val() == ''){
          alert('Nomor telepon tidak boleh kosong');
          $("#nomor_telepon").focus();
        }else{
          $.ajax({
            type:"POST",
            url : base_url+"transaction/add_pesanan",
            dataType : "JSON",
            data : form_data,
            success:function(data){
              alert('Pesanan berhasil ditambahkan!');
              $('form').trigger('reset');
              $("#pesanan").empty();
            },
            error:function(data){
              alert('Pesanan gagal ditambahkan, terjadi kesalahan');
            }
          });
        }
    });