<?php
include("koneksi.php");
$nama = htmlentities($_POST['nama']);
$instansi = htmlentities($_POST['instansi']);
$alamat = htmlentities($_POST['alamat']);
$no_telp = htmlentities($_POST['no_telp']);
$tanggal = htmlentities($_POST['tanggal']);
$waktu = htmlentities($_POST['waktu']);
$id_layanan = htmlentities($_POST['id_layanan']);
$layanan = htmlentities($_POST['layanan']);
$bidang_tujuan = htmlentities($_POST['bidang_tujuan']);
$tujuan = htmlentities($_POST['tujuan']);
$permasalahan = htmlentities($_POST['permasalahan']);
$created_at = date("Y-m-d");

//Create Code Booking
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$kode_booking = substr(str_shuffle($permitted_chars), 0, 5);

$query_insert_daftar_tamu = $db->prepare("Insert into sidayoh_daftar_tamu (kode_booking,nama,instansi,alamat,no_telp,tanggal,waktu,id_layanan,layanan,bidang_tujuan,tujuan,permasalahan,created_at) values(:kode_booking,:nama,:instansi,:alamat,:no_telp,:tanggal,:waktu,:id_layanan,:layanan,:bidang_tujuan,:tujuan,:permasalahan,:created_at)");
$query_insert_daftar_tamu->bindParam(':kode_booking',$kode_booking);
$query_insert_daftar_tamu->bindParam(':nama',$nama);
$query_insert_daftar_tamu->bindParam(':instansi',$instansi);
$query_insert_daftar_tamu->bindParam(':alamat',$alamat);
$query_insert_daftar_tamu->bindParam(':no_telp',$no_telp);
$query_insert_daftar_tamu->bindParam(':tanggal',$tanggal);
$query_insert_daftar_tamu->bindParam(':waktu',$waktu);
$query_insert_daftar_tamu->bindParam(':id_layanan',$id_layanan);
$query_insert_daftar_tamu->bindParam(':layanan',$layanan);
$query_insert_daftar_tamu->bindParam(':bidang_tujuan',$bidang_tujuan);
$query_insert_daftar_tamu->bindParam(':tujuan',$tujuan);
$query_insert_daftar_tamu->bindParam(':permasalahan',$permasalahan);
$query_insert_daftar_tamu->bindParam(':created_at',$created_at);
$query_insert_daftar_tamu->execute();
?>
<script type="text/javascript">
	window.location = "konfirmasi_daftar_tamu.php?kode_booking=<?=$kode_booking?>";
</script>