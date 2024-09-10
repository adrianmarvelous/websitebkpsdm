<?php
include "phpqrcode/qrlib.php";
	$tempdir = "qr_code/"; //Nama folder tempat menyimpan file qrcode
	if (!file_exists($tempdir)) //Buat folder bername temp
	mkdir($tempdir);

    //isi qrcode jika di scan
	$codeContents = 'bkpsdm.surabaya.go.id/daftar_hadir/index.php?nip='.$nip; 

	//simpan file kedalam temp 
	//Kode QR mendukung empat tingkat koreksi kesalahan untuk memungkinkan pemulihan data yang hilang, salah dibaca, atau dikaburkan

	QRcode::png($codeContents, $tempdir.$nip.".png", QR_ECLEVEL_H);
	//echo '<h2>QRCode</h2>';
	//menampilkan file qrcode 
	//echo '<img src="'.$tempdir.$nip.'.png"/>';
	?>