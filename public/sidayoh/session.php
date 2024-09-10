<?php
include("koneksi.php");
if (session_status() !== PHP_SESSION_ACTIVE){
	session_start();
$timeout = 45; // setting timeout dalam menit

if ($_SESSION['login_user'] == 'Admin') {
	$logout = "../../../login.php"; // redirect halaman logout
}
if ($_SESSION['login_user'] == 'Super Admin') {
	$logout = "../../../login.php"; // redirect halaman logout
}
/*else{
	$logout = "login.php";
}*/

	$timeout = $timeout * 60; // menit ke detik
	if(isset($_SESSION['start_session'])){
		$elapsed_time = time()-$_SESSION['start_session'];
		if($elapsed_time >= $timeout){
			session_destroy();
			echo "<script type='text/javascript'>alert('Sesi telah berakhir');window.location='$logout'</script>";
		}
	}

	$_SESSION['start_session']=time();
//}

$user_check = $_SESSION['login_user'];
//$_SESSION['id_bidang'];
//$_SESSION['nama_user'];

$admin = $db->prepare('SELECT * FROM sidayoh_users WHERE username = :username');
$admin->execute(array(
	':username' => $_SESSION['login_user'],
));
$row = $admin->fetch(PDO::FETCH_ASSOC);

$login_session=$row['username'];
$_SESSION['id_bidang']=$row['id_bidang'];
$_SESSION['nama_user']=$row['nama_user'];

if(!isset($login_session))
{
	if ($login_session == 'Admin'){
		header("Location: view/users/admin/index.php");
	}
	if ($login_session == '196905101997022001'){
		header("Location: view/users/super_admin/index.php");
	}
	/*else{
		header("Location: login.php");
	}*/
}
}
?>