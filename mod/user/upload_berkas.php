<?php
	include "../../config/koneksi.php";
	$pemilik = $_GET['pemilik'];
	$atas_nama = $_GET['atas_nama'];
	$id_katpeng = $_GET['id_katpeng'];
	$ket = $_GET['ket'];

	$SELECT_KET = mysqli_query($koneksi, "SELECT a.nama_kategori,b.url_icon FROM kategori_pengurusan as a,jenis_pengurusan as b WHERE a.id_kategori = '$id_katpeng' and a.id_jenis_pengurusan = b.id_jenis_pengurusan ");
	$data_ket = mysqli_fetch_array($SELECT_KET);
	$nama_kategori = $data_ket['nama_kategori'];
	$url_icon = $data_ket['url_icon'];
	
	// echo "$url_icon";

?>

<div class="row" style="margin-bottom:5px;">
    <div class="col-md-12 col-xs-12" style="padding-left:7px; padding-right:7px;">
        <h3 style="margin:0px;">Upload Berkas Pengurusan <?=$ket?> <b class='text-white' style="background-color:#ffcf00; color:#FFFFFF; padding:0px 3px 0px 3px; border-radius:5px; margin-top:5px;"><?=$nama_kategori?></b></h3>
    </div>
</div>	


<div class="row">
	<div class="col-md-8 " style="padding:0 4px 0px 8px; margin-top:10px">
		<div class='' style="background-color:#FFFFFF;">
			<div class="row" style="margin-bottom:0px;">
			    <div class="col-md-12 col-xs-12" >
		    	  <div class='bg-success' style='padding:10px; margin:0px; ' >
			      	<h5 style="margin:5px;">Silahkan Upload Berkas Anda.</h5>
			      </div>
			       <form id="form_upload_berkas"  method="POST" action="config/user/proses_pengurusan.php?op=upload_berkas" enctype="multipart/form-data">
				       <div style="margin:20px 20px 5px 20px;">
				        <?php
				        $SELECT = mysqli_query($koneksi,"SELECT *FROM syarat_pengurusan Where id_kategori = '$id_katpeng' and status_aktif = '1' ");
				        $jum_data = mysqli_num_rows($SELECT);
				        $no = 1;
				    
				        while ($data=mysqli_fetch_array($SELECT)) {
				          $id_syarat = $data['id_syarat'];
				          $syarat = $data['persyaratan'];

				          echo "<div class='form-group'>
				              <label>$no. $syarat</label>
				              <input type='file' id='$id_syarat' required  name=\"FILE-"."$id_syarat\" onchange='cek_extensi(\"$id_syarat\")' />
				              </div>";
				        $no++;
				        }
						echo "<input type='text' name='jum_data' value='$jum_data' hidden>";
						echo "<input type='text' name='id_katpeng' value='$id_katpeng' hidden>";
						echo "<input type='text' name='hubungan' value='$pemilik' hidden >";
						echo "<input type='text' name='atas_nama' value='$atas_nama' hidden >";
						
				        ?>
				        <div class="progress progress-striped" id="bodi_progress_ub" hidden>
							<div id="progressBar" class="progress-bar progress-bar-success active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
								<span class="sr-only">0%</span>
							</div>
						</div>
				        <div class="modal-footer" style="padding-right:0px;">
		                  <label type="button" class="btn btn-default" onclick='javascript:kembali_jp();'>Batal</label>
		                  <button type="submit" id="btn_upload" class="btn" style="background-color:#00BF9A; color:white;">Upload Berkas</button>
		                </div>
				        </div>
				    </form>
			    </div>
			</div>
		</div>
	</div>
	<div class="col-md-4 " style="padding:0 4px 0px 8px; margin-top:10px">
			<div class='' style="background-color:#FFFFFF;">
				<div class="row" style="margin-bottom:0px;">
				    <div class="col-md-12 col-xs-12" >
				        <div class='bg-danger' style='padding:10px; margin:0px; ' >
			      			<h5 style="margin:5px;">Lorem Ipsum.</h5>
			      		</div>
				        <div style="margin:15px">
				         	<center><img src="<?=$url_icon?>" class='img-responsive' style="height:105px; margin-bottom:10px;" ></center>

				         	<div>
				         	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				         	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				         	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				         	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				         	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.
				         	</div>
					    </div>

				    </div>
				</div>
				
			</div>
	</div>
</div>




<script type="text/javascript">
	var atas_nama = "<?=$atas_nama?>";
	var ket = "<?=$ket?>";
	var nama_kategori = "<?=$nama_kategori?>";
	op=0;
	$(document).ready(function(){
		$("#form_upload_berkas").ajaxForm({
         beforeSend:function(){
         	op=1;
            $("#btn_upload").html("<i class='fa fa-spinner fa-pulse fa-fw' style='color: #FFFFFF;'></i> Loading");
            $("#btn_upload").attr("disabled",true);
            $("#bodi_progress_ub").show();
          },
          xhr : function() {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener('progress', function(e){
					if(e.lengthComputable){
						console.log('Bytes Loaded : ' + e.loaded);
						console.log('Total Size : ' + e.total);
						console.log('Persen : ' + (e.loaded / e.total));
						
						var percent = Math.round((e.loaded / e.total) * 100);
						$('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
					}
				});
				return xhr;
			},
          success:function(msg){
             if(msg != "sukses"){
                alert("Maaf! Gagal Upload Berkas Silahkan Hubungi Pihak Pengembang SICAPIL");
             }else{
             	alert("Berhasil Upload Berkas");
             }
             $("#btn_upload").attr("disabled",false);
             $("#bodi_progress_ub").hide();
             op=0;
         	 cek_ada_baurus();
          }
      });
	});
	
	// function s_u(){
	// 		// setTimeout("s_u()","1000");
	// 	 alert("Berhasil Upload Berkas");
 //      	 $("#btn_upload").attr("disabled",false);
 //         $("#bodi_progress_ub").hide();
 //         op=0;
 //         cek_ada_baurus();
	// }

	function kembali_jp(){
		if(op==0){
			cek_ada_baurus();
		}
	}
</script>