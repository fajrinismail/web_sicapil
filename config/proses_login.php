<?php
	include "koneksi.php";
	include "funct.php";
	
	$op = $_GET['op'];
	
	if($op == "registrasi"){
		$nama = $_POST['nama'];
		$no_hp = $_POST['no_hp'];
		$email = $_POST['email'];
		$acak = "SICAPIL987654321ABCDEFGHIJKLMNOPQRSTUVWXYZLIPACAS";
		$password = md5($acak. md5($_POST['password']) . $acak );
		$tgl_registrasi = date("Y-m-d H:i:s");

		$id_user = kode("id_user","user","sicapil","7","6");
		$insert = mysqli_query($koneksi,"INSERT into user (id_user,nama,email,no_hp,level,password,tgl_registrasi,status_aktif,token) values ('$id_user','$nama','$email','$no_hp','1','$password','$tgl_registrasi','1','0') ");

		if($insert){
			echo "sukses";
		}else{
			echo "gagal";
		}
	}else if($op == "login"){
		$email = $_POST['email'];
		$password = $_POST['password'];
		$acak = "SICAPIL987654321ABCDEFGHIJKLMNOPQRSTUVWXYZLIPACAS";
		$valid_password = md5($acak. md5($_POST['password']) . $acak );

		$select = mysqli_query($koneksi,"SELECT *FROM user WHERE email ='$email' and password = '$valid_password' and status_aktif = '1' ");
		$data = mysqli_fetch_array($select);
		$id_user = $data['id_user'];
		$token = $data['token'];
		$level = $data['level'];
		$nama = $data['nama'];

		if($id_user != "" && $token != ""){
			session_start();
			$_SESSION['id_user'] = $id_user;
			$_SESSION['nama'] = $nama;
			$_SESSION['level'] = $level;
			echo "sukses";
		}else{
			echo "gagal";
		}
	}else if($op == "logout"){
		session_start();
		session_destroy();
		echo "<script type='text/javascript'>document.location.href='../';</script>";
	}
	
?>