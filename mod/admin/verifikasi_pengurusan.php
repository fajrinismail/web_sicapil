
<div class="container" style="margin-top:30px; padding:20px;">
  	<div class="row" style="margin-bottom:10px;">
	    <div class="col-md-12 col-xs-12" style="padding-left:7px;">
	        <h3 style="margin:0px;">Verifikasi Pengurusan</h3>
	    </div>
	</div>	
  	
  	<div id="load_berkas">
  		<div style='margin-top:80px;'><center><i class='fa fa-spinner fa-spin fa-5x fa-fw'></i><h3>Sedang Mempersiapkan Halaman</h3></center></div>

  	</div>
</div>


<script type="text/javascript">
	var url = "config/admin/proses_verifikasi.php";
	$(document).ready(function(){
		// $("#load_bodi").html("");

	  	$("#load_berkas").load("mod/admin/tampil_pengurusan.php");

	  	$(".iv-close").click(function(){
       		 $("#menu").show();  
     	});

	});

	function tampil_berkas(id_pengurusan,jenis_pengurusan,atas_nama){
		$("#load_berkas").html("<div style='margin-top:80px;'><center><i class='fa fa-spinner fa-spin fa-5x fa-fw'></i><h3>Sedang Mempersiapkan Halaman</h3></center></div>");

		$("#load_berkas").load("mod/admin/tampil_berkas.php","id_pengurusan="+id_pengurusan+"&jenis_pengurusan="+jenis_pengurusan+"&atas_nama="+atas_nama);
	}

	function lihat_berkas(id_syarat){
    // alert(pisah[1]);
	    $("#menu").hide();  
	    var viewer = ImageViewer();
	     var imgSrc = $("#"+id_syarat).prop("src"),
	              highResolutionImage = $("#"+id_syarat).data('high-res-img');
	          viewer.show(imgSrc, highResolutionImage);
	  }

	function siap_proses(id_pengurusan){
		var konfir = confirm("Apakah anda yakin menyatakan bahwa berkas siap diproses ?");
		if(konfir == true){
			$.ajax({
				url : url,
				data : "op=siap_proses&id_pengurusan="+id_pengurusan,
				beforeSend:function(){
					$("#btn_vubok").html("<i class='fa fa-spinner fa-pulse fa-fw' style='color: #FFFFFF;'></i> Loading");
				},
				success:function(msg){
					if(msg=="sukses"){
						alert("Berhasil Verifikasi Pengurusan");
						$("#load_berkas").html("<div style='margin-top:80px;'><center><i class='fa fa-spinner fa-spin fa-5x fa-fw'></i><h3>Sedang Mempersiapkan Halaman</h3></center></div>");
						$("#load_berkas").load("mod/admin/tampil_pengurusan.php");
					}else{
						alert("Gagal Verifikasi Pengurusan");
					}
					$("#btn_vubok").html("Siap Untuk Diproses");
				}
			});
		}else{
			exit();
		}
	}

	function tolak_pengurusan(id_pengurusan){
		var konfir = confirm("Apakah anda yakin untuk menolak pengurusan ?");
		if(konfir == true){
			$.ajax({
				url : url,
				data : "op=tolak_proses&id_pengurusan="+id_pengurusan,
				beforeSend:function(){
					$("#btn_cubok").html("<i class='fa fa-spinner fa-pulse fa-fw' style='color: #FFFFFF;'></i> Loading");
				},
				success:function(msg){
					if(msg=="sukses"){
						alert("Pengurusan Berhasil Ditolak");
						$("#load_berkas").html("<div style='margin-top:80px;'><center><i class='fa fa-spinner fa-spin fa-5x fa-fw'></i><h3>Sedang Mempersiapkan Halaman</h3></center></div>");
						$("#load_berkas").load("mod/admin/tampil_pengurusan.php");
					}else{
						alert("Gagal Verifikasi Pengurusan");
					}
					$("#btn_cubok").html("Tolak Pengurusan");
				}
			});
		}else{
			exit();
		}
	}

	
  
</script>
