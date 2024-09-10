<?php
ini_set('date.timezone', 'Asia/Jakarta');
Class Login{
	var $db;

	public function __construct(){
		global $db;
		#menghubungkan variabel database $db ke class Login
		$this->db = $db;
	}

	public function cek_login(){
		//method yang akan memvalidasi apakah sedang dalam keadaan log in atau tidak
		/*kondisi user dinyatakan login adalah : 
		1. Memiliki $_COOKIE['adv_token']; (yang dibuat di method true_login() tadi)
		2. $_COOKIE['adv_token'] terdaftar di tabel login_log, dan dalam keadaan masih belum expired
		3. IP dan User Agent sesuai dengan token yang terdaftar
		*/
		if(isset($_COOKIE['adv_token'])){
			$token = $_COOKIE['adv_token'];
			$now = date("Y-m-d H:i:s");
			$cek = $this->db->query("SELECT * FROM login_log WHERE token = ".$this->db->quote($token)." AND expired > ".$this->db->quote($now));
			if($cek){
				#kalau token di cookie tersebut ada, lakukan pengecekan IP dan User Agent
				$row = $cek->fetch();
				if($row['ip'] == $_SERVER['REMOTE_ADDR'] || $row['useragent'] == $_SERVER['HTTP_USER_AGENT']){
					//kondisi bisa disesuaikan utk kebutuhan dengan ATAU / DAN
					//kondisi DAN boleh dipakai, tapi terlalu strict.. Lebih baik pakai ATAU saja.
					$username = $row['username'];

					//kembalikan data user yg sedang login,, siapa tahu nanti ingin diolah
					$query_admin = $this->db->query("SELECT * FROM user_admin WHERE username = ".$this->db->quote($username));
					$data_query_admin = $query_admin->fetch();

					$query_asn = $this->db->query("SELECT * FROM user_master_asn WHERE nip = ".$this->db->quote($username));
					$data_query_asn = $query_asn->fetch();

					$query_tenaga_kontrak = $this->db->query("SELECT * FROM user_master_tenaga_kontrak WHERE nik = ".$this->db->quote($username));
					$data_query_tenaga_kontrak = $query_tenaga_kontrak->fetch();


					if($query_admin->rowCount() != 0){
						return array(
							$_SESSION["nama"] = $data_query_admin['nama'],
							$_SESSION["periode_tahun"] = $row['periode_tahun'],
							$_SESSION['role_login'] = 'Administrator'
						);
					}

					elseif($query_asn->rowCount() != 0){
						return array(
							$_SESSION["nip"] = $data_query_asn['nip'],
							$_SESSION["nama"] = $data_query_asn['nama'],
							$_SESSION["status_ganti_password"] = $data_query_asn['status_ganti_password'],
							$_SESSION["periode_tahun"] = $row['periode_tahun'],
							$_SESSION['role_login'] = 'ASN'
						);
					}

					elseif($query_tenaga_kontrak->rowCount() != 0){
						return array(
							$_SESSION["nik"] = $data_query_tenaga_kontrak['nik'],
							$_SESSION["nama"] = $data_query_tenaga_kontrak['nama'],
							$_SESSION["status_ganti_password"] = $data_query_tenaga_kontrak['status_ganti_password'],
							$_SESSION["periode_tahun"] = $row['periode_tahun'],
							$_SESSION['role_login'] = 'OS'
						);
					}

				}

			}
		}
		return false;
	}


	Public function salah_login_action($username){
		//method yang akan dipanggil apabila user memasukkan username/password yang salah
		//logic : dipanggil saat user salah memasukkan username/password.
		//username, tgl, ip, dan user agent dicatat dengan FLAG=0.

		$tgl = date("Y-m-d H:i:s");
		$ip = $_SERVER['REMOTE_ADDR'];
		$useragent = $_SERVER['HTTP_USER_AGENT'];

		//memasukkan data ke login_log dengan flag STAT = 0.
		$save = $this->db->prepare("INSERT INTO login_log VALUES (NULL, ?, '', '', ?, ?, ?, 0)");
		$save->execute(array(
			$tgl, $username, $ip, $useragent
		));
		return false;
	}


	public function cek_salah_login($limit=5){
		//method untuk menangkal BRUTE FORCE.
		#method ini dipanggil sekali di login-proses paling atas. 
		#$limit bisa disesuaikan sesuai kebutuhan kita. 
		//cek apakah di tabel login_log ada 5 IP yang sama dalam keadaan salah login (STAT = 0)

		$ip = $_SERVER['REMOTE_ADDR'];
		$cek = $this->db->prepare("SELECT * FROM login_log WHERE stat = 0 AND ip = ?");

		$cek->execute(array($ip));
		if($cek->rowCount() >= $limit)
			return false;
		//Apabila user terdeteksi salah login sebanyak $limit kali, maka user tidak boleh login lagi
		return true;
	}


	public function true_login($username, $expired,$periode_tahun){
		echo $username;
		echo "<br>";
		//method yang akan dipanggil apabila user memasukkan username dan password yang benar
		echo $tgl = date("Y-m-d H:i:s");
		echo "<br>";
		if($expired <> 0){
			#kalau remember me dicentang, tanggal expirenya adalah 1 tahun dari sekarang.
			echo $expireddb = date("Y-m-d H:i:s",strtotime($expired));
			echo "<br>";
		}
		else{
			#kalau remember me tidak dicentang, secara default user dapat login selama 6 jam saja.
			echo $expireddb = date("Y-m-d H:i:s",strtotime("+6 hours"));
			echo "<br>";
		}

		$ip = $_SERVER['REMOTE_ADDR'];
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$token = sha1($ip.$expireddb."string_random_apasaja".microtime()); //intinya membuat karakter acak saja
		//$token ini penting,, nantinya akan disimpan sebagai COOKIE

		//apabila ada kesalahan login sebelumnya dengan IP & user agent yang sama sebelumnya harus ditandai dulu 
		//penandaan dilakukan dengan mengubah FLAG dari 0 menjadi 9, sehingga di pengecekan selanjutnya data ini tidak akan dianggap
		$upd = $this->db->query("UPDATE login_log SET stat = 9 WHERE token = '' AND ip = ".$this->db->quote($ip)." AND useragent = ".$this->db->quote($useragent));


		//memasukkan data lengkap ke login_log dengan flag STAT = 1.
		$save = $this->db->prepare("INSERT INTO login_log VALUES (NULL,? , ?, ?, ?, ?, ?, ?, 1)");
		$save->execute(array(
			$tgl, $periode_tahun,$expireddb, $token, $username, $ip, $useragent
		));


		//simpan token ke cookie
		$expr = 0;
		if($expired <> 0){
			$expr = intval(strtotime($expired));
		}
		setcookie("adv_token", $token, $expr, "/");
		#kalau remember me tidak dicentang, cookie akan otomatis bertindak sebagai session
		#kalau dicentang, cookie akan terus disimpan
		return true;
	}

	public function logout(){
		//method yang akan dipanggil apabila user logout dari sistem
		if(isset($_COOKIE['adv_token'])){
			$token = $_COOKIE['adv_token'];

			//cara menghapus cookie adalah dengan mengubah tanggal expirednya menjadi sekarang
			$now = date("Y-m-d H:i:s");
			unset($_COOKIE['adv_token']);
			setcookie("adv_token",null,$now,"/");
			
			#jangan lupa tanggal expired di database diupdate juga, supaya session token yang sudah logout tidak dihijack
			$this->db->query("UPDATE login_log SET expired = ".$this->db->quote($now)." WHERE token = ".$this->db->quote($token));
		}
		return true;
	}

	public function login_redir(){
		//method yang akan selalu dipanggil di seluruh halaman non index dan non login,
		//untuk mengecek apabila user tidak memiliki akses langsung diredirect ke halaman login
		if(!$this->cek_login())
			header("location:login.php");
	}

	// function tampil_data(){
 //        $hasil = array();
 //        $stmt = $this->db->query("SELECT * FROM user_master_asn");
 //        while($d = $stmt->fetch(PDO::FETCH_ASSOC)){
 //            $hasil[] = $d;
 //        }
 //        return $hasil;
 //    }
}
$login = new Login();
?>