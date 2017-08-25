<style type="text/css">

  
    .border{
      border:1px solid;
    }

    .box-hover:hover{
      border:1px solid #00BF9A;
      cursor: pointer;



    }

    .box-hover{
      padding:20px; 
      background-color:#FFFFFF;
      border-radius:10px;
    }

    .box-berkas{
      background-color:#FFFFFF;
      padding-bottom: 5px;
      /*border-radius:10px;*/
    }

    #tombol_vub{position:fixed!important;position:absolute;bottom:40%;right:20px;z-index:999}


</style>



<div class="container" id="load_bodi" style="margin-top:30px; padding:20px;">
  
  
  
</div>



<div class="modal fade" id="modal_kat_peng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">

      <div class="modal-header text-center" style="background-color:;">
        <img id='mod_img' src="" style="height:100px;">
         <h4 class="modal-title" id="myModalLabel" style="margin-top:10px;">FORM Identitas Pengurusan <b class='text-white' style="background-color:#ffcf00; color:#FFFFFF; padding:0px 3px 0px 3px; border-radius:5px; margin-top:5px;" id='tjp'></b> </h4>
      </div>
          <div class="modal-body">
            <!-- <form id="form_upload_berkas"  method="POST" action="config/user/proses_pengurusan.php?op=upload_berkas" enctype="multipart/form-data"> -->
              <div class="box-body">
                  <div class="form-group">
                      <label>Kepemilikan Berkas?</label> 
                      <div class="radio" style="margin-top:0px;">
                        <label><input type="radio"  name="pu"  value="pribadi" checked>Pribadi</label> &nbsp;
                        <label><input type="radio"  name="pu"  value="keluarga" >Keluarga</label> &nbsp;
                        <label><input type="radio"  name="pu"  value="kerabat" >Kerabat</label> &nbsp;
                        <label><input type="radio"  name="pu"  value="tetangga" >Tetangga</label> &nbsp;
                      </div>
                  </div>

                  <div class="form-group">
                      <label>AN Kepemilikan Berkas?</label> 
                      <input type="text" class="form-control" required name='atas_nama'>
                  </div>

                  <div class="form-group">
                      <label>Kategori Jenis Pengurusan ?</label> <span id="loading_katpeng" class="label label-warning"><i class="fa fa-spinner fa-pulse fa-fw" style="color: #FFFFFF;"></i> Please Wait</span>
                      <select class="form-control"  name="id_katpeng"> 
                        <option>-- Sedang Meload Kategori Pengurusan --</option>
                      </select>
                  </div>
                
              </div>
               <div class="modal-footer">
                  <label type="button" class="btn btn-default" onclick='javascript:tutup_mod();'>Batal</label>
                  <input type="submit" class="btn " style="background-color:#00BF9A; color:white;"  onclick="mulai_pengurusan();" value='Mulai Pengurusan'>
                </div>
            <!-- </form> -->
          </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_ubah_berkas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">

      <div class="modal-header text-center" style="background-color:#00BF9A;">
         <i class='fa fa-pencil fa-3x' style='padding:20px; border-radius:100%; background-color:#FFFFFF; color:#00BF9A;'></i>
         <h4 class="modal-title" id="myModalLabel" style="margin-top:10px; color:#FFFFFF;">FORM UBAH BERKAS</h4>

      </div>
          <div class="modal-body">
            <form id="form_ubah_berkas"  method="POST" action="config/user/proses_pengurusan.php?op=ubah_berkas" enctype="multipart/form-data">
              <div class="box-body">
                  <input name='id_berkas' hidden>
                  <div class='form-group'>
                    <label id="syarat"></label>
                    <input type='file' id='up_satu' name="file" style="border:1px solid #CCC; padding:10px; width:100%;" onchange="cek_extensi('up_satu')"  />
                  </div>
                  <div id="bodi_progres" class="progress progress-striped" hidden>
                    <div id="progressBar1"  class="progress-bar progress-bar-success active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                      <span class="sr-only">0%</span>
                    </div>
                  </div>
              </div>
               <div class="modal-footer" style="padding-bottom:0px;">
                  <label type="button" class="btn btn-default na" onclick='javascript:tutup_mod_ubah_berkas();'>Batal</label>
                  <button type="submit" class="btn na" id="btn_ubah_berkas" style="background-color:#00BF9A; color:white;"  >Simpan</button>

                </div>
            </form>
          </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  var url = "config/user/proses_pengurusan.php";
  var nama_sesi = "<?=$_SESSION['nama']?>";
  var op = 0;
  $(document).ready(function(){
    cek_ada_baurus();
    // ganti_gambar();

    $("input[name='pu']").change(function(){
        var hubungan =  $("input[name='pu']:checked").val();
        // alert(hubungan);
        if(hubungan != "pribadi"){
          $("input[name='atas_nama']").val("");
        }else{
          $("input[name='atas_nama']").val(nama_sesi);
        }
    });

     $("#form_ubah_berkas").ajaxForm({
        beforeSend:function(){
          op=1;
          var percent = 0;
          var konfir = confirm("Apakah Anda Yakin Untuk Merubah Berkas ?");
          if(konfir == false){
            exit();
          }
          $("#btn_ubah_berkas").html("<i class='fa fa-spinner fa-pulse fa-fw' style='color: #FFFFFF;'></i> Loading");
          $(".na").attr("disabled",true);
           $("#bodi_progres").show();
        }, xhr : function() {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener('progress', function(e){
          if(e.lengthComputable){
            console.log('Bytes Loaded : ' + e.loaded);
            console.log('Total Size : ' + e.total);
            console.log('Persen : ' + (e.loaded / e.total));
            
            percent = Math.round((e.loaded / e.total) * 100);
            $('#progressBar1').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
          }
        });
        return xhr;
      }, success:function(msg){
          pisah=msg.split("|");
          if(pisah[0]=="sukses"){
             $("#btn_ubah_berkas").html("Simpan");
             $("#form_ubah_berkas").each(function(){this.reset();});
             $("#load_gambar_"+pisah[1]).html("<i class='fa fa-spinner fa-pulse fa-fw fa-4x'></i>");
             $("#load_gambar_"+pisah[1]).load(url,"op=ganti_gambar&id_berkas="+pisah[1]);
             $("#modal_ubah_berkas").modal("hide");
             // alert("Berhasil Ubah Berkas");
          }else{
             alert("Gagal Ubah Berkas");
          }
          op=0;
          $(".na").attr("disabled",false);
          $("#bodi_progres").hide();
          $('#progressBar1').attr('aria-valuenow','0').css('width','0%').text('0%');
          
        }
      });

     $(".iv-close").click(function(){
        $("#menu").show();  
      });

  });

 
  function cek_ada_baurus(){
    $.ajax({
       url : url,
       data : "op=cek_ada_baurus",
       beforeSend:function(){
          $("#load_bodi").html("<div style='margin-top:80px;'><center><i class='fa fa-spinner fa-spin fa-5x fa-fw'></i><h3>Sedang Mempersiapkan Halaman</h3></center></div>");
       },
       success:function(msg){
          // alert(msg);
          pisah = msg.split('|');
          if(pisah[0] == "ada"){
              // alert("ok");
             $("#load_bodi").load("mod/user/verifikasi_upload_berkas.php","id_pengurusan="+pisah[1]+"&atas_nama="+pisah[2]+"&ket="+pisah[4]+"&nama_kategori="+pisah[3]);
          }else{
              // set_step("1","0");
              $("#load_bodi").load("config/user/proses_pengurusan.php","op=jenis_pengurusan");
          }
       }
    });
  }

  function tampil_modal_katpeng(id_peng,jenis_pengurusan,url_icon,tampung_he){
      $("#mod_img").attr("src",url_icon);
      $("#tjp").html(tampung_he);
      $("#modal_kat_peng").modal("show");
      $("select[name='id_katpeng']").load(url,"op=load_katpeng&id_peng="+id_peng);
      $("#loading_katpeng").fadeOut("slow");
      $("#form_upload_berkas").each(function(){this.reset();});
      $("input[name='atas_nama']").val("<?=$_SESSION['nama']?>");
  }

  function tutup_mod(){
        $("#modal_kat_peng").modal("hide");
  }

  function mulai_pengurusan(){
       var pemilik =  $("input[name='pu']:checked").val();
       var atas_nama= $("input[name='atas_nama']").val();
       var kategori = $("select[name='id_katpeng']").val();
       var ket = $("#tjp").html();

       var konfir = confirm("Apakah Anda Yakin Untuk Memulai Pengurusan ?");
       if(konfir == true){
          tutup_mod();
          $("#load_bodi").load("mod/user/upload_berkas.php","pemilik="+pemilik+"&atas_nama="+atas_nama+"&id_katpeng="+kategori+"&ket="+ket);
       }else{
          exit();
       }

  }


  /*--------------------------------------------------------------------------------------*/
  function lihat_berkas(id_syarat){
    // alert(pisah[1]);
    $("#menu").hide();  
    var viewer = ImageViewer();
     var imgSrc = $("#"+id_syarat).prop("src"),
              highResolutionImage = $("#"+id_syarat).data('high-res-img');
          viewer.show(imgSrc, highResolutionImage);
  }
  
  function cek_extensi(id_syarat){
    var nama_file = $("input[id='"+id_syarat+"']").val();

      $.ajax({
         url : url,
         data : "op=cek_extensi&nama_file="+nama_file,
         success:function(msg){
            if(msg == "bukan_gambar"){
              alert("Maaf! File Yang Dipilih Bukan Gambar");
              $("input[id='"+id_syarat+"']").val("");
            }
         }
      });
  }

  function tampil_mod_ubah_berkas(persyaratan,id_berkas){
    $('#progressBar').attr('aria-valuenow', '0').css('width','0%').text('0%');
    $("input[name='id_berkas']").val(id_berkas);
    // $("input[name='url_lama']").val(url_file);
    $("#syarat").html(persyaratan);
    $("#modal_ubah_berkas").modal("show");

  }

 function tutup_mod_ubah_berkas(){
    if(op==0){
      $("#btn_ubah_berkas").html("Simpan");
      $("#form_ubah_berkas").each(function(){this.reset();});
      $("#modal_ubah_berkas").modal("hide");
      
    }
  
  }

  function selesai_verifikasi(id_pengurusan){
    // alert(id_pengurusan);
    var konfir = confirm("Apakah Anda Yakin Mengajukan Pengurusan ?");
    if(konfir){
      $.ajax({
        url : "config/user/proses_pengurusan.php",
        data : "op=selesai_verifikasi&id_pengurusan="+id_pengurusan,
        beforeSend:function(){
           $("#btn_vubok").html("<i class='fa fa-spinner fa-pulse fa-fw'></i>");
        },success:function(msg){
          $("#btn_vubok").html("<i class='fa fa-fw fa-check'></i>");
          if(msg == "sukses"){
            alert("Berkas Siap Untuk Diproses");
            cek_ada_baurus();
          }else{
            alert("Gagal Mengajukan Berkas");
          }
          
        }
      });
    }else{
      exit();
    }
  }

  function batal_pengurusan(id_pengurusan){
    var konfir = confirm("Apakah Anda Yakin Membatalkan Pengurusan ?");
    if(konfir){
      $.ajax({
        url : "config/user/proses_pengurusan.php",
        data : "op=batal_verifikasi&id_pengurusan="+id_pengurusan,
        beforeSend:function(){
           $("#btn_cubok").html("<i class='fa fa-spinner fa-pulse fa-fw'></i>");
        },success:function(msg){
          $("#btn_cubok").html("<i class='fa fa-fw fa-close'>");
          if(msg == "sukses"){
            alert("Berhasil Membatalkan Pengurusan");
            cek_ada_baurus();
          }else{
            alert("Gagal Membatalkan Pengurusan");
          }
         
        }
      });
    }else{
      exit();
    }
  }
</script>
