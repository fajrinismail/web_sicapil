<?php
	include "../koneksi.php";
	include "../funct.php";
	session_start();

	$op = $_GET['op'];
	if($op=="load_katpeng"){
		$id_peng = $_GET['id_peng'];

		$SELECT = mysqli_query($koneksi,"SELECT *FROM kategori_pengurusan WHERE status_aktif='1' and id_jenis_pengurusan = '$id_peng' ");
		echo "<option value=''>-- Pilih Kategori --</option>";
		while ($data = mysqli_fetch_array($SELECT)) {
			$id_katpeng = $data['id_kategori'];
			$nama_katpeng = $data['nama_kategori'];

			echo "<option value='$id_katpeng'>$nama_katpeng</option>";
		}
	}else if($op=="load_syarat"){
		$id_katpeng = $_GET['id_katpeng'];
     
        $SELECT = mysqli_query($koneksi,"SELECT *FROM syarat_pengurusan Where id_kategori = '$id_katpeng' and status_aktif = '1' ");
        $jum_data = mysqli_num_rows($SELECT);
        $no = 1;
    
        while ($data=mysqli_fetch_array($SELECT)) {
          $id_syarat = $data['id_syarat'];
          $syarat = $data['persyaratan'];

          echo "<div class='form-group'>
              <label>$no. $syarat</label>
              <input type='file' id='$id_syarat' required  name=\"FILE-"."$id_syarat\"  />
              </div>";
        $no++;
        }
		echo "<input type='text' name='jum_data' value='$jum_data' hidden>";
		
		?>	
		
		
		<?php
	}else if($op == "upload_berkas"){
		$id_katpeng = $_POST['id_katpeng'];
		$id_user = $_SESSION['id_user'];
		$id_pengurusan = $id_user."-".$id_katpeng."-".date('YmdHis');
		$tgl_pengurusan = date("Y-m-d H:i:s");
		$jum_berkas = $_POST['jum_data'];
		$nama = $_POST['atas_nama'];
		$hubungan = $_POST['hubungan'];
		
		// print_r($_POST);
		$INSERT_PENGURUSAN = mysqli_query($koneksi,"INSERT INTO pengurusan (id_pengurusan,id_user,id_kategori_pengurusan,tgl_pengurusan,nama,hubungan,status_pengurusan) VALUES ('$id_pengurusan','$id_user','$id_katpeng','$tgl_pengurusan','$nama','$hubungan','0') ");
		if($INSERT_PENGURUSAN == "1"){
			$SELECT = mysqli_query($koneksi,"SELECT *FROM syarat_pengurusan Where id_kategori = '$id_katpeng' and status_aktif = '1' ");
			$sukses_input = 0;
			while ($data=mysqli_fetch_array($SELECT)) {
				$id_syarat = $data['id_syarat'];
				$syarat = $data['persyaratan'];

				$fileName = $_FILES["FILE-".$id_syarat]['name'];
				$id_berkas = $id_user."-".$id_syarat."-".date('YmdHis');
				$ext = explode('.', $fileName);
				$extensi = $ext[count($ext) - 1];

				$new_name = $id_berkas.".$extensi";
	    		$file="FILE-".$id_syarat; //name pada inputan type file
	    		$dir='../../berkas/';
	     		// $width=600;//satuan dalam pixel / px
				$url_baru = "berkas/$new_name";


	     		$proses_upload = move_uploaded_file($_FILES[''.$file.'']["tmp_name"], $dir.$new_name);
				if($proses_upload > 0){
					$INSERT_BERKAS = mysqli_query($koneksi,"INSERT INTO berkas (id_berkas,id_pengurusan,id_syarat,url_file) VALUES ('$id_berkas','$id_pengurusan','$id_syarat','$url_baru') ");
					if($INSERT_BERKAS){
						$sukses_input++;
					}else{
						unlink("$url_baru");
						
					}
				}else{
					echo "gagal";
				}
				
			}
			if($sukses_input == $jum_berkas){
				echo "sukses";
			}
		}else{
			echo "gagal";
		}


	}else if($op=="ubah_berkas"){ 
		$id_berkas = trim($_POST['id_berkas']);
		$SELECT = mysqli_query($koneksi,"SELECT *FROM berkas WHERE id_berkas = '$id_berkas' " );
		$data = mysqli_fetch_array($SELECT);
		$url_lama = $data['url_file'];

		if(!empty($id_berkas)){
			$fileName = $_FILES["file"]['name'];
			$ext = explode('.', $fileName);
			$extensi = $ext[count($ext) - 1];
			$unlink = unlink("../../$url_lama");
			$id_berkas_baru = $_SESSION['id_user']."-".$data['id_syarat']."-".date('YmdHis');
			$nama_berkas = $id_berkas_baru.".$extensi";

			if($unlink == 1){
				$proses_upload = move_uploaded_file($_FILES["file"]["tmp_name"], "../../berkas/".$nama_berkas);
				if($proses_upload){
					$UPDATE = mysqli_query($koneksi,"UPDATE berkas set url_file='berkas/$nama_berkas' WHERE id_berkas = '$id_berkas' ");
					if($UPDATE){
						echo "sukses|$id_berkas";
					}else{
						echo "gagal";
					}
				}
			}else{
				echo "gagal";
			}
		}else{
			echo "nda_ada";
		}

	}else if($op=="ganti_gambar"){
		$id_berkas = $_GET['id_berkas'];
		// echo "$id_berkas";
		$SELECT = mysqli_query($koneksi,"SELECT *FROM berkas WHERE id_berkas = '$id_berkas' " );
		$data = mysqli_fetch_array($SELECT);

		echo "<center><img src=\"".$data['url_file']."\" class='img-responsive' id='".$data['id_syarat']."' style='height:150px; cursor:pointer;'></img></center>";
	}else if($op=="cek_extensi"){
		$fileName =  $_GET['nama_file'];

		$valid_ext = array('jpg','JPG','jpeg','JPEG','png');
		$ext = explode('.', $fileName);
		$extensi = $ext[count($ext) - 1];
		$cek_extensi = in_array($extensi, $valid_ext);


		if($cek_extensi > 0){
			echo "ok";
		}else{
			echo "bukan_gambar";
		}
	}else if($op=="cek_ada_baurus"){
		$id_user = $_SESSION['id_user'];
		$SELECT = mysqli_query($koneksi,"SELECT a.id_pengurusan,a.nama,b.nama_kategori,c.jenis_pengurusan FROM pengurusan as a,kategori_pengurusan as b,jenis_pengurusan as c WHERE a.id_kategori_pengurusan=b.id_kategori and b.id_jenis_pengurusan=c.id_jenis_pengurusan and a.id_user = '$id_user' and a.status_pengurusan='0' ");
		$data = mysqli_fetch_array($SELECT);
		$cek = mysqli_num_rows($SELECT);

		if($cek > 0){
			 $tampung_he = "";

		     $extrac_string = explode(" ", $data['jenis_pengurusan']);
		     foreach ($extrac_string as $key) {
		       $kata = substr($key, 0,1);
		       $tampung_he .= strtoupper($kata);
		     }
			echo "ada|".$data['id_pengurusan']."|".$data['nama']."|".$tampung_he."|".$data['nama_kategori'];
		}else{
			echo "nda";
		}
	}else if($op=="selesai_verifikasi"){

		$id_pengurusan = $_GET['id_pengurusan'];
		$UPDATE =mysqli_query($koneksi,"UPDATE pengurusan SET status_pengurusan = '1' WHERE id_pengurusan ='$id_pengurusan' ");
		if($UPDATE){
			echo "sukses";
		}else{
			echo "gagal";
		}
	}else if($op=="batal_verifikasi"){
		$id_pengurusan = $_GET['id_pengurusan'];
		$DELETE = mysqli_query($koneksi,"DELETE FROM pengurusan WHERE id_pengurusan = '$id_pengurusan' ");
		if($DELETE){
			echo "sukses";
		}else{
			echo "gagal";
		}

	}else if($op=="jenis_pengurusan"){
		?>
		<div class="row" style="margin-bottom:10px;">
		    <div class="col-md-12 col-xs-12" style="padding-left:7px;">
		        <h3 style="margin:0px;">Pilih Jenis Pengurusan</h3>
		    </div>
		</div>	
		<div class="row" style="margin-bottom:0px;">
    <div class="col-md-12 col-xs-12" style="padding-left:5px; padding-right:5px;">
        <p class="bg-danger" style="padding:10px;">Silahkan pilih jenis pengurusan yang akan anda lakukan.</p>
    </div>
</div>
		<?php
		$SELECT1 = mysqli_query($koneksi,"SELECT *FROM jenis_pengurusan WHERE status_aktif = '1' ");
	    $no = 1;
	    $buka_baris= "<div class='row' style='margin-top:0px;'>";
	    $tutup_baris = "</div>";
	    $awal = 1;
	    $batas = 3;
	    $jum_col = 3;
	    $jum_data = mysqli_num_rows($SELECT1);

	    while ($data1 = mysqli_fetch_array($SELECT1)) {
	     $id_jenis_pengurusan = $data1['id_jenis_pengurusan'];
	     $jenis_pengurusan = $data1['jenis_pengurusan'];
	     $url_icon = $data1['url_icon'];
	     $tampung_he = "";

	     $extrac_string = explode(" ", $jenis_pengurusan);
	     foreach ($extrac_string as $key) {
	       $kata = substr($key, 0,1);
	       $tampung_he .= strtoupper($kata);
	     }

	     if($no == $awal ){
	       echo "$buka_baris";
	     }

	     if($no <= $batas){
	       echo "<div class='col-md-4 text-center ' style='padding:5px;'>
	               <div class='box-hover text-center' onclick='javascript:tampil_modal_katpeng(\"$id_jenis_pengurusan\",\"$jenis_pengurusan\",\"$url_icon\",\"$tampung_he\")'>
	                 <div style='margin-bottom:10px;'><center><img src='$url_icon' class='img-responsive' style='height:100px;'></img></center></div>
	                 <span class='bg-success' style='font-size:12px; padding:8px;'>$jenis_pengurusan</span>
	               </div>
	             </div>";

	       if( ($no <= $batas && $no == $jum_data) || ($no == $batas && $no < $jum_data)){
	         echo "$tutup_baris";
	       }

	       if($no == $batas && $no < $jum_data){
	         $awal+=$jum_col;
	         $batas+=$jum_col;
	       }


	     }

	    $no++;
	    }


	}
	

?>
