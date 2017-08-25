<?php
	include "../../config/koneksi.php";
	$id_pengurusan = $_GET['id_pengurusan'];
	$atas_nama = $_GET['atas_nama'];
	$ket = $_GET['ket'];
	$nama_kategori = $_GET['nama_kategori'];

?>

		
<div class="row" style="margin-bottom:10px;">
    <div class="col-md-12 col-xs-12" style="padding-left:7px; padding-left:7px;">
         <h3 style="margin:0px;">Review Berkas Pengurusan <?=$nama_kategori?> <b class='text-white' style="background-color:#ffcf00; color:#FFFFFF; padding:0px 3px 0px 3px; border-radius:5px; margin-top:5px;"><?=$ket?></b></h3>
    </div>
</div>	
<div class="row" style="margin-bottom:0px;">
    <div class="col-md-12 col-xs-12" style="padding-left:5px; padding-right:5px;">
        <div class="bg-danger" style="padding:10px;">
        	Atas Nama : <u><?=$atas_nama?></u> <br/>
        	<small>Silahkan review kembali berkas anda dengan mengklik tombol <u><b>lihat berkas</b></u> dan pastikan anda <u><b>tidak salah</b></u> mengupload gambar</small></div>
    </div>
</div>


<?php
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
				    <div class='box-berkas text-center'>
				      <div class='bg-success' style='padding:5px; ' >
				      	<h5>$no. $persyaratan </h5>
				      </div>
				      <div style='margin-bottom:0px; padding:10px;' id='load_gambar_$id_berkas'>
				      	<center><img src='$url_file' class='img-responsive ' id='$id_syarat' style='height:150px; cursor:pointer;'></img></center>
				      </div>
				      <div style='margin-bottom:0px; padding:5px;'>
				      	<button class='btn bg-success btn-sm' onclick='javascript:lihat_berkas(\"$id_syarat\")'>Lihat Berkas</button><button class='btn bg-danger btn-sm' onclick='javascript:tampil_mod_ubah_berkas(\"$persyaratan\",\"$id_berkas\");'>Ubah Bekas</button>
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


<div id="tombol_vub">
<div><button id='btn_vubok' class="btn btn-success"  onclick="selesai_verifikasi('<?=$id_pengurusan?>');"><i class="fa fa-fw fa-check"></i></button></div>
<div style="margin-top:5px;"><button class="btn btn-danger" id='btn_cubok' onclick="batal_pengurusan('<?=$id_pengurusan?>');"><i class="fa fa-fw fa-close"></i></button></div> 
</div>