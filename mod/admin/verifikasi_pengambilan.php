
<div class="container" style="margin-top:30px; padding:20px;">
    <div class="row" style="margin-bottom:10px;">
        <div class="col-md-12 col-xs-12" style="padding-left:7px;">
            <h3 style="margin:0px;">Verifikasi Pengambilan</h3>
        </div>
    </div>  
    <div class="row" style="margin-top:10px;">
        <div class="col-md-12 col-xs-12" style="padding-left:5px; padding-right:5px;">
            <div class="bg-danger" style="padding:10px;">
               Anda Memiliki <b><u id='jum_data'></u></b> Pengurusan Yang <b><u>Telah Selesai</u></b> Dan <b><u>Belum Diambil</u></b>  <br/>
               <small>Untuk memverifikasi pengurusan telah selesai diproses silahkan anda mengklik tombol &nbsp;<b>" <i class='fa fa-check' style='padding:5px; background-color:#dff0d8; color:#00AA8D; border-radius:5px; cursor:pointer'></i></i> "</b></small></div>
        </div>
    </div>
    

    <div class="row" style="margin-top:10px;">
    <div class="col-md-12 col-xs-12" style="padding-left:5px; padding-right:5px;">
        <div  id="bodi_tabel" style="padding:40px 40px 20px 40px; background-color:#FFFFFF;" >
            <div style='margin-top:40px;margin-bottom:40px;'><center><i class='fa fa-spinner fa-spin fa-5x fa-fw'></i><h3>Sedang Mempersiapkan Halaman</h3></center></div>

        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    var url = "config/admin/proses_verifikasi.php";
    $(document).ready(function(){
         $("#jum_data").load(url,"op=jum_data_ba");
         $("#bodi_tabel").load(url,"op=load_tabel_ba");
    });


    
    function selesai(id_pengurusan){
        var konfir = confirm("Apakah anda yakin untuk menyatakan bahwa pengurusan telah selesai diproses ?");
        if(konfir == true){
            $.ajax({
                url : url,
                data : "op=diambil&id_pengurusan="+id_pengurusan,
                success:function(msg){
                    if(msg == "sukses"){
                        alert("Berhasil Verifikasi");
                        $("#bodi_tabel").html("<div style='margin-top:40px; margin-bottom:40px;'><center><i class='fa fa-spinner fa-spin fa-5x fa-fw'></i><h3>Sedang Mempersiapkan Halaman</h3></center></div>");
                        $("#bodi_tabel").load(url,"op=load_tabel_ba");
                        $("#jum_data").load(url,"op=jum_data_ba");
                    }else{
                        alert("Gagal Verifikasi");
                    }
                }
            });
        }else{
            exit();
        }
    }
</script>
