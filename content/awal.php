 <div class="login-box">
    <div class="login-box-body" >
        <div class="row" >
            <div class='col-md-12'>
                <center><img src="images/logo.png" class="img-responsive" alt="Responsive image"  style="height:150px;"></center>
            </div>
        </div>

        <div class="row" style="margin-top:10px; margin-bottom:10px;">
            <div class='col-md-12 text-center'>
                Masukan Email Dan Pasword Anda
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form id= "form_login" action="config/proses_login.php?op=login" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" name='email' class="form-control" placeholder="Email">
                        <span class="glyphicon form-control-feedback"> <img src="images/user_kacili.png" ></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name='password' class="form-control" placeholder="Password">
                        <span class="glyphicon form-control-feedback"> <img src="images/password_kacili.png" ></span>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                          <button type="submit" class="btn btn-block btn-flat" style="background-color:#00BF9A; color:#FFFFFF" id="btn_login">Masuk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row" style="margin-top:10px; ">
            <div class="col-md-12 text-center">
                  -- Atau --
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center" style="margin-top:5px;">
                 Belum Punya Akun <label style="color:#00BF9A;">SICAPIL</label> ?
            </div>
        </div>
    
        <div class="row" style="">
            <div class="col-md-12 text-center">
                 Daftar <span class="label label-warning" style='cursor:pointer;' data-toggle="modal" data-target="#myModal">Di sini</span>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header text-center" style="background-color:#00BF9A; color:#FFFFFF">
        <img src="images/logo_registrasi.png" style="height:100px;"> <h4 class="modal-title" id="myModalLabel">FORM REGISTRASI <b class='text-white' style="background-color:#ffcf00; padding:0px 3px 0px 3px; border-radius:5px; margin-top:5px;">SICAPIL</b> </h4>
      </div>
      <form id="form_registrasi"  role="form" method="POST" action="config/proses_login.php?op=registrasi">
        <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control"  placeholder="Nama Lengkap">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">No Hp</label>
                <input type="text" name="no_hp" class="form-control" placeholder="EX: 08524266****">
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="text" name="email"  class="form-control" placeholder="sicacpil@gmail.com">
              </div>
              
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="text" name="password" class="form-control" placeholder="Masukan Password Anda">
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Verifikasi Password</label>
                <input type="text" name="verifikasi_password" class="form-control" placeholder="Masukan Password Anda Lagi">
              </div>

            </div>
        </div>
        <div class="modal-footer">
          <label type="button" class="btn btn-default" data-dismiss="modal">Batal</label>
          <button type="submit" class="btn" style="background-color:#00BF9A; color:white;" id="btn_regis">Registrasi</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $("#form_registrasi").ajaxForm({
            beforeSend:function(){
              $("#btn_regis").html("loading ..");
            },success:function(msg){
              alert(msg);
               if(msg == "sukses"){
                  alert("Berhasil Melakukan Registrasi");
                  $("#form_registrasi").each(function(){this.reset();});
                  $("#myModal").modal('hide');
               }else{
                  alert("Gagal Melakukan Registrasi")
               }
               $("#btn_regis").html("Registrasi");
            }
        });

        $("#form_login").ajaxForm({
            beforeSend:function(){
              $("#btn_login").html("loading ..");
            },success:function(msg){
              alert(msg);
               if(msg == "sukses"){
                 location.reload();
               }else{
                  alert("User Tidak Ditemukan");
               }
               $("#btn_login").html("Masuk");
            }
        });

    }); 
</script>