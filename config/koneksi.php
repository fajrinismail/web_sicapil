<?php
	$koneksi = mysqli_connect("localhost", "root", "", "sicapil");
	if (mysqli_connect_errno()) {
		trigger_error('Koneksi ke database gagal: '  . mysqli_connect_error(), E_USER_ERROR);
	}
?>