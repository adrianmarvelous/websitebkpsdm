<?php
include 'koneksi.php';

/*$query = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='".mysqli_escape_string($conn, $_POST['nis'])."'");
$data = mysqli_fetch_array($query);*/

$id_layanan = htmlentities($_POST['id_layanan']);
$query_get_layanan = $db->prepare("select * from sidayoh_layanan where id_layanan = :id_layanan");
$query_get_layanan->bindParam(':id_layanan',$id_layanan);
$query_get_layanan->execute();
$data_query_get_layanan = $query_get_layanan->fetch(PDO::FETCH_ASSOC);
echo json_encode($data_query_get_layanan);
?>