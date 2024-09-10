<?php
require("conn.php");
$login_status = $login->cek_login($periode_tahun);
if($login_status){
	if ($_SESSION['role_login'] == 'Administrator') {
	//bawa ke halaman index
		header("location:../index.php");
		exit();
	}
	else{
		// if ($_SESSION['status_ganti_password'] == 0) {
		// 	header("location:ganti_password.php");
		// }
		// else{
			//bawa ke halaman index
		header("location:../index.php");
		exit();
		//}
	}
}
else{
	//include form log in jika belum log in
	header("location:../login.php");
}
?>