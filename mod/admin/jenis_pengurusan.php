
<div class="container" style="margin-top:30px; padding:20px;">
    <div class="row" style="margin-bottom:0px;">
        <div class="col-md-12 col-xs-12" style="padding-left:7px;">
            <h3 style="margin:0px; margin-bottom:10px;">Input Jenis Pengurusan</h3>
        </div>
    </div>  
    <div class="row" style="margin-top:0px;">
        <div class="col-md-12 col-xs-12" style="padding-left:5px; padding-right:5px;">
            <div class="bg-danger" style="padding:10px;">
               <div>
                    Anda Memiliki <b><u id='jum_data'></u></b> Pengurusan Yang <b><u>Sementara Diproses</u></b> <br/>
                    <small>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</small>
                </div>
            </div>
        </div>
    </div>
    

    <div class="row" style="margin-top:10px;">
    <div class="col-md-12 col-xs-12" style="padding-left:5px; padding-right:5px;">
        <div  id="bodi_tabel" style="padding:20px; background-color:#FFFFFF;" >
            <div>
                <button class="btn btn-small  btn-flat btn_dasar " onclick="tampil_mod();">Input Baru</button><button class="btn btn-small  btn-flat btn_dasar">Aktifkan Yang Sudah Ada</button>
            </div>
            <div style='padding:10px 10px 20px 10px; margin-top:10px; border:1px solid #DDD; border-left:none; border-right:none; border-bottom:none;'>
                <table class='table table-bordered table-striped'>
                    <thead class='bg-success'>
                        <th style="width:50px;">No</th>
                        <th>Jenis Pengurusan</th>
                        <th style="width:100px;"><center>Aksi</center></th>
                    </thead>
                    <tbody id="load_tabel">
                            
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
</div>

<div class="modal fade" id="modal_input_jp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">

      <div class="modal-header text-center" style="background-color:#00BF9A;">
         <i class='fa fa-edit fa-3x' style='padding:20px; border-radius:100%; background-color:#FFFFFF; color:#00BF9A;'></i>
         <h4 class="modal-title" id="myModalLabel" style="margin-top:10px; color:#FFFFFF;">FORM Input Jenis Pengurusan</h4>

      </div>
          <div class="modal-body">
            <form id="form_input_jp"  method="POST" action="config/admin/proses_input_jp.php?op=simpan_jp" enctype="multipart/form-data">
              <div class="box-body">
                <div class='form-group'>
                    <label >Masukan Nama Jenis Pengurusan</label>
                    <input type="text" name="nama_jp" class="form-control" >
                </div> 

                <div class='form-group'>
                    <label >Pilih Icon</label>
                    <input type='file' id='$id_syarat' required  name="file" onchange='' />
                </div>
              </div>
               <div class="modal-footer" style="padding-bottom:0px;">
                  <label type="button" class="btn btn-default na" onclick='javascript:tutup_mod_ubah_berkas();'>Batal</label>
                  <button type="submit" class="btn na" id="btn_input_jp" style="background-color:#00BF9A; color:white;"  >Simpan</button>
                </div>
            </form>
          </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    var url = "config/admin/proses_input_jp.php";
    $(document).ready(function(){
        load_tabel();
        $("#form_input_jp").ajaxForm({
            beforeSend:function(){
                $("#btn_input_jp").html("<i class='fa fa-spinner fa-pulse fa-fw' style='color: #FFFFFF;'></i> Loading");
            },success:function(msg){
                if(msg == "sukses"){
                    alert("Berhasil Input Jenis Pengurusan");
                    tutup_mod();
                    load_tabel();
                }else{
                    alert("Gagal Input Jenis Pengurusan");
                }
                $("#btn_input_jp").html("Simpan");
            }
        });
    });

    function load_tabel(){
        $("#load_tabel").html("<tr><td align='center' colspan='3'><i class='fa fa-spinner fa-pulse fa-fw fa-3x'></i></td></tr>");
        $("#load_tabel").load(url,"op=load_tabel_jp");
    }

    function tampil_mod(){
        $("#modal_input_jp").modal("show");
    }
    function tutup_mod(){
        $("#modal_input_jp").modal("hide");
    }
</script>