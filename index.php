<?php
	
	session_start();
	include "content/atas.php";
	include "content/tengah.php";
	if (!isset($_SESSION['id_user'])) {
		include "content/awal.php";
	}else{
		include "content/menu.php";
		include "content/buka_content.php";

		if(isset($_GET['dir'])){
			$pages_dir = $_GET['dir'];
		}else{
			$pages_dir = 'mod/';
		}
		
		if(!empty($_GET['p'])){
		     $pages = scandir($pages_dir, 0);
		     unset($pages[0], $pages[1]);
		 
		    $p = $_GET['p'];
		    if(in_array($p.'.php', $pages)){
		    	include($pages_dir.'/'.$p.'.php');
		    } else {
		        echo 'Halaman tidak ditemukan! :(';
		    }
		} else {
			$level = $_SESSION['level'];
			if($level == "1"){
				$akses = "user";
			}else if($level == "2"){
				$akses = "admin";
			}
			include($pages_dir. "/$akses/home.php");
	    }
		include "content/tutup_content_footer.php";
	}
	include "content/bawah.php";
		
?>