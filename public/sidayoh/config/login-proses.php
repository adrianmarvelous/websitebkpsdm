<?php
include "conn.php";

if(!$login->cek_salah_login()){
	//kalau user salah login melebihi batas yang ditentukan, maka proses langsung berhenti
	create_alert("error","Mohon maaf Anda tidak dapat login lagi karena kesalahan login Anda terlalu banyak. Hubungi Administrator untuk informasi lebih lanjut","filter.php");
}

//tombol $_POST['btn'] harus ditekan. kalau tidak ditekan artinya nggak ada proses apapun yang dijalankan
if(isset($_POST['Login'])){
	$periode_tahun = htmlentities($_POST['tahun']);
	$username = htmlentities($_POST['username']);
	$password = htmlentities($_POST['password']);

	//step 1 : cek apakah username Admin ada di tabel 
	$cek_admin = $db->query("SELECT * FROM user_admin WHERE username = ".$db->quote($username));
	
	//step 2 : cek apakah username ASN ada di tabel 
	$cek_asn = $db->query("SELECT * FROM user_master_asn WHERE nip = ".$db->quote($username));

	//step 3 : cek apakah username Tenaga Kontrak ada di tabel 
	$cek_tenaga_kontrak = $db->query("SELECT * FROM user_master_tenaga_kontrak WHERE nik = ".$db->quote($username));

	if($cek_admin->rowCount() > 0){
		//username ada, tangkap password yg ada di database
		$row = $cek_admin->fetch();
		$password_db = $row['password'];
		#password_verify adalah fungsi PHP 5.5> yang otomatis mengecek kesamaan inputan dengan hash 
		if(password_verify($password, $password_db)){
			//password sudah cocok
			$expired = 0;
			if(isset($_POST['remember'])){
				if($_POST['remember'] = 1){
					$expired = '+1 year'; // 1 tahun
				}
			}
			#kalau remember me dicentang, login akan expired dalam waktu 1 tahun, selain itu ya akan seperti session biasa yang hilang ketika diclose

			$login->true_login($username, $expired, $periode_tahun); //pencatatan token akan dilakukan disini
			create_alert("success","Log In Berhasil","filter.php");
		}
		else{
			//password tidak cocok
			$login->salah_login_action($username); //pencatatan kesalahan login
			create_alert("error","Username atau password tersebut salah","filter.php");
		}

	}

	if($cek_asn->rowCount() > 0){
		//username ada, tangkap password yg ada di database
		$row = $cek_asn->fetch();
		$password_db = $row['password'];
		#password_verify adalah fungsi PHP 5.5> yang otomatis mengecek kesamaan inputan dengan hash 
		if(password_verify($password, $password_db)){
			//password sudah cocok
			$expired = 0;
			if(isset($_POST['remember'])){
				if($_POST['remember'] = 1){
					$expired = '+1 year'; // 1 tahun
				}
			}
			#kalau remember me dicentang, login akan expired dalam waktu 1 tahun, selain itu ya akan seperti session biasa yang hilang ketika diclose

			$login->true_login($username, $expired, $periode_tahun); //pencatatan token akan dilakukan disini
			create_alert("success","Log In Berhasil","filter.php");
		}
		else{
			//password tidak cocok
			$login->salah_login_action($username); //pencatatan kesalahan login
			create_alert("error","Username atau password tersebut salah","filter.php");
		}

	}

	if($cek_tenaga_kontrak->rowCount() > 0){
		//username ada, tangkap password yg ada di database
		$row = $cek_tenaga_kontrak->fetch();
		$password_db = $row['password'];
		#password_verify adalah fungsi PHP 5.5> yang otomatis mengecek kesamaan inputan dengan hash 
		if(password_verify($password, $password_db)){
			//password sudah cocok
			$expired = 0;
			if(isset($_POST['remember'])){
				if($_POST['remember'] = 1){
					$expired = '+1 year'; // 1 tahun
				}
			}
			#kalau remember me dicentang, login akan expired dalam waktu 1 tahun, selain itu ya akan seperti session biasa yang hilang ketika diclose

			$login->true_login($username, $expired, $periode_tahun); //pencatatan token akan dilakukan disini
			create_alert("success","Log In Berhasil","filter.php");
		}
		else{
			//password tidak cocok
			$login->salah_login_action($username); //pencatatan kesalahan login
			create_alert("error","Username atau password tersebut salah","filter.php");
		}

	}

	else{
		$login->salah_login_action($username); //pencatatan kesalahan login
		create_alert("error","Username atau password tersebut tidak terdaftar","filter.php");
	}

}