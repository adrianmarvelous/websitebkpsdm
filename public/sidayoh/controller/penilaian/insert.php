<?php
include '../../koneksi.php';

//query master_aspek_penilaian
$query_master_aspek_penilaian = $db->prepare("SELECT id_master_aspek_penilaian from sidayoh_master_aspek_penilaian");
$query_master_aspek_penilaian->execute();
while($data_query_master_aspek_penilaian = $query_master_aspek_penilaian->fetch(PDO::FETCH_ASSOC)){
	if ($data_query_master_aspek_penilaian['id_master_aspek_penilaian'] == htmlentities($_GET['aspek_penilaian'])){
		for ($i=0; $i < count($_GET['total']) ; $i++){
			$aspek_penilaian = htmlentities($_GET['aspek_penilaian']);
			$id_detail_aspek_penilaian = htmlentities($_GET['id_detail_aspek_penilaian'][$i]);
			$skor = htmlentities($_GET['skor'][$i]);
			$tgl_sekarang = date('Y-m-d');
			$query_insert_detail_penilaian = $db->prepare("Insert into sidayoh_detail_penilaian (id_penilaian,id_aspek,id_detail_aspek_penilaian,skor,created_at) values('1',:id_aspek,:id_detail_aspek_penilaian,:skor,:created_at)");
			$query_insert_detail_penilaian->bindParam(':id_aspek',$aspek_penilaian);
			$query_insert_detail_penilaian->bindParam(':id_detail_aspek_penilaian',$id_detail_aspek_penilaian);
			$query_insert_detail_penilaian->bindParam(':skor',$skor);
			$query_insert_detail_penilaian->bindParam(':created_at',$tgl_sekarang);
			$query_insert_detail_penilaian->execute();
		}
	}
}
?>