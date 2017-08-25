<?php
	include "../koneksi.php";
	include "../funct.php";
	session_start();

	$op=$_GET['op'];
	if($op=="siap_proses"){
		$id_pengurusan = $_GET['id_pengurusan'];
		$id_admin = $_SESSION['id_user'];
		$id_verifikasi = kode("id_verifikasi","verifikasi","$id_pengurusan-V","38","1");
		
		$INSERT = mysqli_query($koneksi,"INSERT INTO verifikasi (id_verifikasi,id_pengurusan,id_user,status_verifikasi,tgl_verifikasi,status_aktif) VALUES ('$id_verifikasi','$id_pengurusan','$id_admin','1','".date('Y-m-d H:i:s')."','1') ");
		if($INSERT){
			echo "sukses";
		}else{
			echo "gagal";
		}
	}else if($op=="tolak_proses"){
		$id_pengurusan = $_GET['id_pengurusan'];
		$id_admin = $_SESSION['id_user'];
		$id_verifikasi = kode("id_verifikasi","verifikasi","$id_pengurusan-V","38","1");
		
		$INSERT = mysqli_query($koneksi,"INSERT INTO verifikasi (id_verifikasi,id_pengurusan,id_user,status_verifikasi,tgl_verifikasi,status_aktif) VALUES ('$id_verifikasi','$id_pengurusan','$id_admin','3','".date('Y-m-d H:i:s')."','1') ");
		if($INSERT){
			echo "sukses";
		}else{
			echo "gagal";
		}
	}else if($op=="selesai"){
		$id_pengurusan = $_GET['id_pengurusan'];
		$id_admin = $_SESSION['id_user'];
		$id_verifikasi = kode("id_verifikasi","verifikasi","$id_pengurusan-V","38","1");
		
		$UPDATE = mysqli_query($koneksi,"UPDATE verifikasi set status_aktif='0' WHERE id_pengurusan = '$id_pengurusan'  ");
		if($UPDATE == 1){
			$INSERT = mysqli_query($koneksi,"INSERT INTO verifikasi (id_verifikasi,id_pengurusan,id_user,status_verifikasi,tgl_verifikasi,status_aktif) VALUES ('$id_verifikasi','$id_pengurusan','$id_admin','2','".date('Y-m-d H:i:s')."','1') ");
			if($INSERT){
				echo "sukses";
			}else{
				echo "gagal";
			}
			
		}else{
			echo "gagal";
		}
	}else if($op=="diambil"){
		$id_pengurusan = $_GET['id_pengurusan'];
		$id_admin = $_SESSION['id_user'];
		$id_verifikasi = kode("id_verifikasi","verifikasi","$id_pengurusan-V","38","1");
		
		$UPDATE = mysqli_query($koneksi,"UPDATE verifikasi set status_aktif='0' WHERE id_pengurusan = '$id_pengurusan'  ");
		if($UPDATE == 1){
			$INSERT = mysqli_query($koneksi,"INSERT INTO verifikasi (id_verifikasi,id_pengurusan,id_user,status_verifikasi,tgl_verifikasi,status_aktif) VALUES ('$id_verifikasi','$id_pengurusan','$id_admin','4','".date('Y-m-d H:i:s')."','1') ");
			if($INSERT){
				echo "sukses";
			}else{
				echo "gagal";
			}
			
		}else{
			echo "gagal";
		}
	}else if($op=="load_tabel_sp"){
		?>
			<table id= "tabel_sp" class="table table-bordered table-striped">
                <thead class='bg-success'>
                <tr>
                  <th style="width:10px;">No</th>
                  <th>Atas Nama</th>
                  <th>Jenis Pengurusan</th>
                  <th>Tgl Pengurusan</th>
                  <th>Tgl Mulai Proses</th>
                  <th><center>Aksi</center></th>
                </tr>
                </thead>
                <tbody>
                  	<?php
						$SELECT_VERIFI = mysqli_query($koneksi,"SELECT a.id_pengurusan,a.nama,a.tgl_pengurusan,d.tgl_verifikasi,b.nama_kategori,c.jenis_pengurusan,d.status_verifikasi FROM pengurusan as a,kategori_pengurusan as b,jenis_pengurusan as c,verifikasi as d WHERE a.id_kategori_pengurusan=b.id_kategori and b.id_jenis_pengurusan=c.id_jenis_pengurusan and a.id_pengurusan=d.id_pengurusan and d.status_verifikasi='1' and d.status_aktif='1' ORDER BY d.tgl_verifikasi ASC");
				    	$jum_data = mysqli_num_rows($SELECT_VERIFI);
						$no=1;
				        while ($data_verifi = mysqli_fetch_array($SELECT_VERIFI)) {
				            $id_pengurusan = $data_verifi['id_pengurusan'];
				            $atas_nama = $data_verifi['nama'];
				            $tgl_pengurusan = set_waktu($data_verifi['tgl_pengurusan']);
				            $tgl_mp = set_waktu($data_verifi['tgl_verifikasi']);
				            $jenis_pengurusan = $data_verifi['jenis_pengurusan']." ".$data_verifi['nama_kategori'];
				            $status_verifikasi = $data_verifi['status_verifikasi'];
				            
				                echo "<tr >
				                        <td align='center'>$no</td>
				                        <td>$atas_nama</td>
				                        <td>$jenis_pengurusan</td>
				                        <td> $tgl_pengurusan</td>
				                        <td>$tgl_mp </td>
				                        <td align='center'><i onclick ='selesai(\"$id_pengurusan\")' class='fa fa-check' style='padding:5px; background-color:#dff0d8; color:#00AA8D; border-radius:5px; cursor:pointer'></i></td>
				                     </tr>";
				            $no++;    
				        }
                  	?>
                </tbody>
            </table>

            <script type="text/javascript">
			    $(function() {
			        $('#tabel_sp').dataTable();
			    });
			</script>
		<?php
	}else if($op=="jum_data_sp"){
		 $SELECT_VERIFI = mysqli_query($koneksi,"SELECT a.id_pengurusan,a.nama,a.tgl_pengurusan,d.tgl_verifikasi,b.nama_kategori,c.jenis_pengurusan,d.status_verifikasi FROM pengurusan as a,kategori_pengurusan as b,jenis_pengurusan as c,verifikasi as d WHERE a.id_kategori_pengurusan=b.id_kategori and b.id_jenis_pengurusan=c.id_jenis_pengurusan and a.id_pengurusan=d.id_pengurusan and d.status_verifikasi='1' and d.status_aktif='1' ");
    	$jum_data = mysqli_num_rows($SELECT_VERIFI);
    	echo $jum_data;
	}else if($op=="load_tabel_ba"){
		?>

			<table id= "tabel_sp" class="table table-bordered table-striped">
                <thead class='bg-success'>
                <tr>
                  <th style="width:10px;">No</th>
                  <th>Atas Nama</th>
                  <th>Jenis Pengurusan</th>
                  <th>Tgl Pengurusan</th>
                  <th>Tgl Mulai Proses</th>
                  <th>Tgl Selesai Proses</th>
                  <th><center>Aksi</center></th>
                </tr>
                </thead>
                <tbody>
                  	<?php
						$SELECT_VERIFI = mysqli_query($koneksi,"SELECT a.id_pengurusan,a.nama,a.tgl_pengurusan,(SELECT e.tgl_verifikasi FROM verifikasi as e  WHERE e.id_pengurusan=a.id_pengurusan and e.status_verifikasi='1') as tgl_mp , d.tgl_verifikasi as tgl_sp, b.nama_kategori,c.jenis_pengurusan,d.status_verifikasi FROM pengurusan as a,kategori_pengurusan as b,jenis_pengurusan as c,verifikasi as d WHERE a.id_kategori_pengurusan=b.id_kategori and b.id_jenis_pengurusan=c.id_jenis_pengurusan and a.id_pengurusan=d.id_pengurusan and d.status_verifikasi='2' and d.status_aktif='1' ");
				    	$jum_data = mysqli_num_rows($SELECT_VERIFI);
						$no=1;
				        while ($data_verifi = mysqli_fetch_array($SELECT_VERIFI)) {
				            $id_pengurusan = $data_verifi['id_pengurusan'];
				            $atas_nama = $data_verifi['nama'];
				            $tgl_pengurusan = set_waktu($data_verifi['tgl_pengurusan']);
				            $tgl_mp = set_waktu($data_verifi['tgl_mp']);
				            $tgl_sp = set_waktu($data_verifi['tgl_sp']);
				            $jenis_pengurusan = $data_verifi['jenis_pengurusan']." ".$data_verifi['nama_kategori'];
				            $status_verifikasi = $data_verifi['status_verifikasi'];
				            
				                echo "<tr >
				                        <td align='center'>$no</td>
				                        <td>$atas_nama</td>
				                        <td>$jenis_pengurusan</td>
				                        <td> $tgl_pengurusan</td>
				                        <td>$tgl_mp </td>
				                        <td>$tgl_sp </td>
				                        <td align='center'><i onclick ='selesai(\"$id_pengurusan\")' class='fa fa-check' style='padding:5px; background-color:#dff0d8; color:#00AA8D; border-radius:5px; cursor:pointer'></i></td>
				                     </tr>";
				            $no++;    
				        }
                  	?>
                </tbody>
            </table>

            <script type="text/javascript">
			    $(function() {
			        $('#tabel_sp').dataTable();
			    });
			</script>
		<?php
	}else if($op=="jum_data_ba"){
		 $SELECT_VERIFI = mysqli_query($koneksi,"SELECT a.id_pengurusan,a.nama,a.tgl_pengurusan,(SELECT e.tgl_verifikasi FROM verifikasi as e  WHERE e.id_pengurusan=a.id_pengurusan and e.status_verifikasi='1') as tgl_mp , d.tgl_verifikasi as tgl_sp, b.nama_kategori,c.jenis_pengurusan,d.status_verifikasi FROM pengurusan as a,kategori_pengurusan as b,jenis_pengurusan as c,verifikasi as d WHERE a.id_kategori_pengurusan=b.id_kategori and b.id_jenis_pengurusan=c.id_jenis_pengurusan and a.id_pengurusan=d.id_pengurusan and d.status_verifikasi='2' and d.status_aktif='1' ");
    	$jum_data = mysqli_num_rows($SELECT_VERIFI);
    	echo $jum_data;
	}

?>