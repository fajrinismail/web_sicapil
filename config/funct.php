<?php
	
	date_default_timezone_set("ASIA/Makassar");
	

 	function kode($field,$table,$kode_awal,$star,$jumKar){
 		include "koneksi.php";
		$SELECT = mysqli_query($koneksi,"SELECT max($field) as maxKd from $table WHERE $field LIKE '$kode_awal%' ");
		$data =  mysqli_fetch_array($SELECT);
		$maxKd = $data['maxKd'];
		$substr = (int) substr($maxKd, $star,$jumKar);
		$kode = $substr + 1;
		$newkode = "$kode_awal".sprintf("%0".$jumKar."s", $kode);
		return $newkode;
	}

	function set_waktu($waktu){
		$unix = strtotime($waktu);
		$waktu_fix = date("Y-m-d h:i A",$unix);
		$pisah = explode(" ",$waktu_fix);
		return set_tanggal($pisah[0])." ".$pisah[1]." ".$pisah[2];
	}

		function set_tanggal($tanggal){
		if($tanggal != ""){
			$pisah = explode("-",$tanggal);
			if($tanggal != ""){
				if($pisah[1]=="01"){
				$bulan = "Januari";
				}else if($pisah[1]=="02"){
					$bulan = "Februari";
				}else if($pisah[1]=="03"){
					$bulan = "Maret";
				}else if($pisah[1]=="04"){
					$bulan = "April";
				}else if($pisah[1]=="05"){
					$bulan = "Mei";
				}else if($pisah[1]=="06"){
					$bulan = "Juni";
				}else if($pisah[1]=="07"){
					$bulan = "Juli";
				}else if($pisah[1]=="08"){
					$bulan = "Agustus";
				}else if($pisah[1]=="09"){
					$bulan = "September";
				}else if($pisah[1]=="10"){
					$bulan = "Oktober";
				}else if($pisah[1]=="11"){
					$bulan = "November";
				}else if($pisah[1]=="12"){
					$bulan = "Desember";
				}

				$tgl = $pisah[2]." ".$bulan." ".$pisah[0];
			}else{
				$tgl = "";
			}
		}else{
			$tgl = "xx xxxxxx xxxx";
		}
		
		return $tgl;
	}

 ?>