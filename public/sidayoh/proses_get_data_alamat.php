<?php
include 'koneksi.php';

/*$query = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='".mysqli_escape_string($conn, $_POST['nis'])."'");
$data = mysqli_fetch_array($query);*/

$id_instansi = htmlentities($_POST['id_instansi']);
$query_get_opd = $db->prepare("select * from sidayoh_master_opd where id_instansi = :id_instansi");
$query_get_opd->bindParam(':id_instansi',$id_instansi);
$query_get_opd->execute();
$data_query_get_opd = $query_get_opd->fetch(PDO::FETCH_ASSOC);


echo json_encode($data_query_get_opd);
?>