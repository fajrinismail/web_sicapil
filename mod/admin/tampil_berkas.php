<div class="row" style="margin-bottom:0px;">
    <div class="col-md-12 col-xs-12" style="padding-left:5px; padding-right:5px;">
        <div class="bg-danger" style="padding:10px;">
            Atas Nama : <b><?=$_GET['atas_nama']?></b> <br/>
            Jenis Pengurusan :  <b><?=$_GET['jenis_pengurusan']?></b> <br/>
            <small>Untuk Memperbesar Gambar Silahkan Klik <b><u>Gambar</u></b></small></div>
    </div>
</div>

<?php
	include "../../config/koneksi.php";
	$id_pengurusan = $_GET['id_pengurusan'];
	$SELECT = mysqli_query($koneksi,"SELECT a.id_syarat,a.persyaratan,b.url_file,b.id_berkas FROM syarat_pengurusan as a LEFT JOIN berkas as b on a.id_syarat=b.id_syarat WHERE a.status_aktif = '1' and b.id_pengurusan ='$id_pengurusan'   ");
	$jum_data = mysqli_num_rows($SELECT);
	$no = 1;
	$buka_baris= "<div class='row' style='margin-top:5px;'> <!-- Buka Baris-->";
	$tutup_baris = "</div> <!- tutup_baris -->";
	$awal = 1;
	$batas = 4;
	$jum_col = 4;
	$jum_data = mysqli_num_rows($SELECT);

	while ($data=mysqli_fetch_array($SELECT)) {
		$id_syarat = $data['id_syarat'];
		$persyaratan = $data['persyaratan'];
		$url_file = $data['url_file'];
		$id_berkas = $data['id_berkas'];

		if($no == $awal ){
			echo "$buka_baris";
		}

		if($no <= $batas){
			echo "<div class='col-md-3 ' style='padding:5px 5px 5px 5px;'> <!-- Buka Col $persyaratan -->
				    <div class=' text-center' style='background-color:#FFFFFF;'>
				      <div class='bg-success' style='padding:5px; ' >
				      	<h5>$no. $persyaratan </h5>
				      </div>
				      <div style='margin-bottom:0px; padding:10px;' id='load_gambar_$id_berkas'>
				      	<center><img src='$url_file' class='img-responsive ' onclick='javascript:lihat_berkas(\"$id_syarat\")' id='$id_syarat' style='height:150px; cursor:pointer;'></img></center>
				      </div>
				    </div>
			  	</div> <!--Tutup Col $persyaratan-->";

			if( ($no <= $batas && $no == $jum_data) || ($no == $batas && $no < $jum_data) ){
				echo "$tutup_baris";
			}

			if($no == $batas && $no < $jum_data){
				$awal+=$jum_col;
				$batas+=$jum_col;
			}
		}
	$no++;

	}
?>


<div style='margin-top:10px; margin-left:-12px;  ' >
<button id='btn_vubok' class="btn " style='background-color:#00AA8D; color:white; ' onclick="siap_proses('<?=$id_pengurusan?>');">Siap Untuk Diproses</button> 
<button class="btn " id='btn_cubok' style='background-color:#c7254e; color:white;' onclick="tolak_pengurusan('<?=$id_pengurusan?>');">Tolak Pengurusan</button></div>
<div style="margin-top:5px;"></div> 


