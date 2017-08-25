<?php
	include "../koneksi.php";
	include "../funct.php";

	$op = $_GET['op'];
	if($op == "load_tabel_jp"){
		$SELECT = mysqli_query($koneksi,"SELECT *FROM jenis_pengurusan WHERE status_aktif='1' ");
		$no = 1;
		while ($data = mysqli_fetch_array($SELECT)) {
			$id_jenis_pengurusan = $data['id_jenis_pengurusan'];
			$jenis_pengurusan = $data['jenis_pengurusan'];
			echo "<tr>
					<td>$no</td>
					<td>$jenis_pengurusan</td>
					<td></td>

				 </tr>";
			$no++;
		}
	}else if($op=="simpan_jp"){
		$nama_jp = $_POST['nama_jp'];
		$id_jp = kode("id_jenis_pengurusan","jenis_pengurusan","P","1","2");
		
		$fileName = $_FILES["file"]['name'];
		$ext = explode('.', $fileName);
		$extensi = $ext[count($ext) - 1];
		$nama_berkas = $id_jp.".$extensi";

		$proses_upload = move_uploaded_file($_FILES["file"]["tmp_name"], "../../images/".$nama_berkas);
		if($proses_upload){
			 $INSERT = mysqli_query($koneksi,"INSERT INTO jenis_pengurusan (id_jenis_pengurusan,jenis_pengurusan,status_aktif,url_icon) VALUES ('$id_jp','$nama_jp','1','images/$nama_berkas') ");
			 if($INSERT){
			 	echo "sukses";
			 }else{
			 	echo "gagal";
			 }
		}else{
			echo "gagal";
		}
		// echo "$nama_berkas";
		//
	}
	
?>