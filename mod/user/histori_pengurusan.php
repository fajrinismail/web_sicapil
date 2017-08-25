<div class="container" id="load_bodi" style="margin-top:30px; padding:20px;">
  	<div class="row" style="margin-bottom:10px;">
	    <div class="col-md-12 col-xs-12" style="padding-left:7px;">
	        <h3 style="margin:0px;">Laporan Pengurusan Berkas</h3>
	    </div>
	</div>	

	<div class="row" style="margin-bottom:0px;">
	    <div class="col-md-12 col-xs-12" style="padding-left:5px; padding-right:5px;">
	        <div class="bg-danger" style="padding:10px;">
	            Pengurusan Yang Sedang Berlangsung 'N' Pengurusan <br/>
	            Pengurusan Yang Telah Selesai 'N' Pengurusan  <br/>
	            <small>Klik tombol <b><u>detail</u></b> untuk melihat lebih rinci histori pengurusan</small></div>
	    </div>
	</div>	
	<div class="row" style="margin-top:10px;">
	    <div class="col-md-12 col-xs-12" style="padding-left:5px; padding-right:5px;">
	        <div  class='table-responsive' style="padding:20px 60px 20px 60px; background-color:#FFFFFF;" >
	       	<table  class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:10px;">No</th>
                  <th>Atas Nama</th>
                  <th>Jenis Pengurusan</th>
                  <th>Tgl Pengurusan</th>
                  <th><center>Status</center></th>
                  <th><center>Detail</center></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        include "config/koneksi.php";
                        include "config/funct.php";
                        $SELECT_VERIFI = mysqli_query($koneksi,"SELECT c.id_pengurusan,c.nama,c.tgl_pengurusan,d.tgl_verifikasi,b.nama_kategori,a.jenis_pengurusan,d.status_verifikasi FROM jenis_pengurusan as a INNER JOIN kategori_pengurusan as b ON a.id_jenis_pengurusan=b.id_jenis_pengurusan INNER JOIN pengurusan as c on c.id_kategori_pengurusan=b.id_kategori LEFT JOIN verifikasi as d ON c.id_pengurusan=d.id_pengurusan Where c.status_pengurusan='1' and c.id_user ='".$_SESSION['id_user']."' and (d.status_aktif = '1' or d.status_aktif IS NULL) ORDER BY c.id_pengurusan DESC  ");

                            $jum_data = mysqli_num_rows($SELECT_VERIFI);
                            $no=1;
                            while ($data_verifi = mysqli_fetch_array($SELECT_VERIFI)) {
                                $id_pengurusan = $data_verifi['id_pengurusan'];
                                $atas_nama = $data_verifi['nama'];
                            
                                $tgl_pengurusan = $data_verifi['tgl_pengurusan'];
                                $jenis_pengurusan = $data_verifi['jenis_pengurusan']." ".$data_verifi['nama_kategori'];

                              
                                $status = $data_verifi['status_verifikasi'];
                                if($status == ""){
                                	$tampil_status = "<span class='label label-warning' style='padding:5px; border-radius:5px;'>Pending</span>";
                                }else if($status == "1"){
                                	$tampil_status = "<span class='label label-info' style='padding:5px; border-radius:5px;'>Proses</span>";
                                }else if($status == "2"){
                                	$tampil_status = "<span class='label label-success' style='padding:5px; border-radius:5px;'>Selesai</span>";
                                }else if($status == "3"){
                                	$tampil_status = "<span class='label label-danger' style='padding:5px; border-radius:5px;'>Ditolak</span>";
                                }else if($status == "4"){
                                    $tampil_status = "<span class='label label-success' style='padding:5px; border-radius:5px;'>Diterima</span>";
                                }
                                echo "<tr>
                                        <td>$no</td>
                                        <td>$atas_nama</td>
                                        <td>$jenis_pengurusan</td>
                                        <td>$tgl_pengurusan</td>
                                        <td align='center'>$tampil_status</td>
                                        <td align='center'><i onclick ='tampil_berkas(\"$id_pengurusan\",\"$jenis_pengurusan\",\"$atas_nama\")' class='fa  fa-clone' style='padding:5px; background-color:green; color:white; border-radius:5px; cursor:pointer'></i></td>
                                     </tr>";
                            $no++;       
                            }
                        ?>
                </tbody>
            </table>
	        </div>
	    </div>
    </div>
</div>

