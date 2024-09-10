<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
    // Database connection
	include "koneksi.php";

    // Fetch data from the database
	//$query_get_data_lo = $db->prepare('SELECT data_master_lo.*, absensi.status_hadir FROM `data_master_lo` LEFT JOIN absensi ON absensi.id_lo = data_master_lo.id where absensi.status_hadir = 1 GROUP BY nip_nik');
	$query_get_data_lo = $db->prepare('SELECT data_master_lo.*, absensi.status_hadir FROM `data_master_lo` LEFT JOIN absensi ON absensi.id_lo = data_master_lo.id GROUP BY nip_nik');
	$query_get_data_lo->execute();

    // Set content type header
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=data_export.xls");
	?>
	<table border="1">
		<tr>
			<th>No</th>
			<th>NIP/NIK</th>
			<th>Nama</th>
			<th>Status Kepegawaian</th>
			<th>OPD</th>
			<th>No HP</th>
			<th>Kehadiran</th>
			<th>Catatan</th>
		</tr>

		<?php
		$no = 1;
		while($data_query_get_data_lo = $query_get_data_lo->fetch(PDO::FETCH_ASSOC)){
			if ($data_query_get_data_lo['status_perubahan'] == 1) {
				?>
				<tr style="background-color: #bfffbf;">
					<td><?=$no++?></td>
					<td>'<?=$data_query_get_data_lo['nip_nik']?></td>
					<td><?=$data_query_get_data_lo['nama']?></td>
					<td><?=$data_query_get_data_lo['status_kepegawaian']?></td>
					<td><?=$data_query_get_data_lo['nama_opd']?></td>
					<td>'<?=$data_query_get_data_lo['no_hp']?></td>
					<td>
						<?php
						if ($data_query_get_data_lo['status_hadir'] == 1) {
							echo "Hadir";
						}
						else{
							echo "<font color='red'>Tidak Hadir</font>";   
						}
						?>
					</td>
					<td><font color="red"><?=$data_query_get_data_lo['catatan']?></font></td>
				</tr>
				<?php
			}
			else if ($data_query_get_data_lo['status_perubahan'] == 3) {
				?>
				<tr style="background-color: #E97451;">
					<td><?=$no++?></td>
					<td>'<?=$data_query_get_data_lo['nip_nik']?></td>
					<td><?=$data_query_get_data_lo['nama']?></td>
					<td><?=$data_query_get_data_lo['status_kepegawaian']?></td>
					<td><?=$data_query_get_data_lo['nama_opd']?></td>
					<td>'<?=$data_query_get_data_lo['no_hp']?></td>
					<td>
						<?php
						if ($data_query_get_data_lo['status_hadir'] == 1) {
							echo "Hadir";
						}
						else{
							echo "<font color='red'>Tidak Hadir</font>";   
						}
						?>
					</td>
					<td><font color="red"><?=$data_query_get_data_lo['catatan']?></font></td>
				</tr>
				<?php
			}
			else if ($data_query_get_data_lo['status_hadir'] == 0) {
				?>
				<tr style="background-color: #E97451;">
					<td><?=$no++?></td>
					<td>'<?=$data_query_get_data_lo['nip_nik']?></td>
					<td><?=$data_query_get_data_lo['nama']?></td>
					<td><?=$data_query_get_data_lo['status_kepegawaian']?></td>
					<td><?=$data_query_get_data_lo['nama_opd']?></td>
					<td>'<?=$data_query_get_data_lo['no_hp']?></td>
					<td>
						<?php
						if ($data_query_get_data_lo['status_hadir'] == 1) {
							echo "Hadir";
						}
						else{
							echo "<font color='red'>Tidak Hadir</font>";   
						}
						?>
					</td>
					<td><font color="red">*DIBATALKAN</font></td>
				</tr>
				<?php
			}
			else{
				?>
				<tr>
					<td><?=$no++?></td>
					<td>'<?=$data_query_get_data_lo['nip_nik']?></td>
					<td><?=$data_query_get_data_lo['nama']?></td>
					<td><?=$data_query_get_data_lo['status_kepegawaian']?></td>
					<td><?=$data_query_get_data_lo['nama_opd']?></td>
					<td>'<?=$data_query_get_data_lo['no_hp']?></td>
					<td>
						<?php
						if ($data_query_get_data_lo['status_hadir'] == 1) {
							echo "Hadir";
						}
						else{
							echo "Tidak Hadir";   
						}
						?>
					</td>
					<td></td>
					<?php
				}
			}
			?>
		</table>

	</body>
	</html>
