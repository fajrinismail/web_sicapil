<?php
	if(isset($_SESSION['id_user'])){
		$warna_latar = "";
	}else{
		$warna_latar = "#00BF9A";
	}
?>
<body class="layout-top-nav" style="background-color:<?=$warna_latar?>">
<div class="wrapper">
<!-- <body style="background-color:<?=$warna_latar?>"> -->