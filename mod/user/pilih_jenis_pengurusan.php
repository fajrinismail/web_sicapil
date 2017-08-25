<div class="row" style="margin-bottom:10px;">
    <div class="col-md-12 col-xs-12" style="padding-left:7px;">
        <h3 style="margin:0px;">Silahkan Pilih Pengurusan</h3>
    </div>
</div>	
<?php
	include "../../config/koneksi.php";
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
			          <div style='margin-bottom:7px;'><center><img src='$url_icon' class='img-responsive' style='height:100px;'></img></center></div>
			          <span class='label label-warning' style='font-size:13px;'>$jenis_pengurusan</span>
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

?>





<script type="text/javascript">
	
	 $(document).ready(function() {
      // $("input[name='pu']").change(function(){
      //     alert("ok");
      //     var hubungan = $("input[name='pu']:checked").val();
      //     if(hubungan != "pribadi"){
      //       $("input[name='atas_nama']").val("").focus();
      //     }else{
      //       $("input[name='atas_nama']").val(nama_sesi);
      //     }
      // });
      
    });

	

</script>