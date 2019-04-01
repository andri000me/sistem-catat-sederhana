<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title ;?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/favicon1.png" />
  <style type="text/css">
    #berhasil,#gagal{
      display: none;
    }
    .center{
      text-align: center;
    }
  </style>
</head>

<body>
  <?php $this->load->view($main_view);?>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?php echo base_url()?>assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?php echo base_url()?>assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?php echo base_url()?>assets/js/off-canvas.js"></script>
  <script src="<?php echo base_url()?>assets/js/misc.js"></script>
  <!-- endinject -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript">

    $(document).ready(function(){
      $("#email").focus();
      if($("#password").val() != ''){
        $("#password_circle").css('color','green');
      }else{
        $("#password_circle").css('color','#b6b6b6');
      }

      if($("#nama_lengkap").val() != ''){
        $("#nama_circle").css('color','green');
      }else{
        $("#nama_circle").css('color','#b6b6b6');
      }
    });

    function check(){
      if($("#email").val() != ''){
        $("#email_circle").css('color','green');
      }else{
        $("#email_circle").css('color','#b6b6b6');
      }

      if($("#password").val() != ''){
        $("#password_circle").css('color','green');
      }else{
        $("#password_circle").css('color','#b6b6b6');
      }

      if($("#nama_lengkap").val() != ''){
        $("#nama_circle").css('color','green');
      }else{
        $("#nama_circle").css('color','#b6b6b6');
      }
    }

    function check_email() {
      var el = $(this);

      $.ajax({
        type : "POST",
        url : "<?php echo base_url();?>admin/check_email",
        dataType: 'json',
        data : {
          'email':el.val()
        },
        success:function(result){
            if(el.val().length == result.email.length){
              $("#gagal").slideDown('slow').text('E-mail telah digunakan');
              $("#email_circle").css('color','red');
            }else{
              check();
              $("#email_circle").css('color','green');
              $("#gagal").slideUp('slow');
            }
          }
      });
    }

    $('input').keypress(function(e) {
            if(e.which == 13) { 
                $('#btn_register').trigger('click');
                $('#btn_login').trigger('click');
            }
        });

    $("#btn_register").click(function(event){

      event.preventDefault();
      var email = $("#email").val();
      var password = $("#password").val();
      var nama_lengkap = $("#nama_lengkap").val();
      var form_data  = $('form').serialize();

      if($("#email").val() == ''){
        alert('Email harus diisi');
        $("#email").focus();
      }else if($("#password").val() == ''){
        alert('Password harus diisi');
        $("#password").focus();
      }else if($("#nama_lengkap").val() == ''){
        alert('Nama harus diisi');
        $("#nama_lengkap").focus();
      }else{
        $.ajax({
          type : "POST",
          url : "<?php echo base_url();?>admin/register_run",
          dataType : 'json',
          data : form_data,
          success:function(data){
            $("#berhasil").slideDown('slow').text('Registrasi berhasil,cek email anda untuk aktivasi akun');
          },
          error:function(error){
            $("#gagal").slideDown('slow').text('Registrasi gagal,cek kembali form anda');
          }
        });
      }
    });

    $("#btn_login").click(function(event){
      event.preventDefault();
      var email = $("#email").val();
      var password = $("#password").val();
      var url = "<?php echo base_url();?>admin";
      $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>admin/login",
        dataType:"json",
        data :{email:email,password:password},
        success:function(data){
          if(data > 0){
            $('form').trigger('reset');
            $("#berhasil").slideDown('slow').css('text-align','center').text('Login berhasil');
            setTimeout(function(){$("#berhasil").slideUp('slow', function(){
                window.location = url;
            });},2000);
          }else{
            $("#gagal").slideDown('slow').text('Login gagal');
            setTimeout(function(){$("#gagal").slideUp('slow', function(){
            });},2000);
          }
        },
        error:function(error){
          $("#gagal").slideDown('slow').css('text-align','center').text('Login gagal');
            setTimeout(function(){$("#gagal").slideUp('slow', function(){
          });},2000);
          $("#email").focus();
        }
      });
    });

  </script>
</body>

</html>