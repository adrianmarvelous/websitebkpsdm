<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$kode_booking = $_POST['kode_booking'];
	$status = $_POST['status'];
	$catatan = $_POST['catatan'];

	// Debugging output
	// echo "Kode Booking: " . htmlspecialchars($kode_booking) . "<br>";
	// echo "Status: " . htmlspecialchars($status) . "<br>";
	// echo "Catatan: " . htmlspecialchars($catatan) . "<br>";

	// Proceed with database update
	try {
		$db = new PDO("mysql:host=172.18.0.78;dbname=bkpsdm_surabaya_2", "pompi_bkd", "luckyLif+15");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = $db->prepare("UPDATE sidayoh_daftar_tamu SET status = :status, catatan = :catatan WHERE kode_booking = :kode_booking");
		$query->bindParam(':status', $status, PDO::PARAM_INT);
		$query->bindParam(':catatan', $catatan, PDO::PARAM_STR);
		$query->bindParam(':kode_booking', $kode_booking, PDO::PARAM_STR);

		if ($query->execute()) {
			echo "Data updated successfully!";
		} else {
			echo "Failed to update data.";
		}
	} catch (PDOException $e) {
		echo "Error: " . htmlspecialchars($e->getMessage());
	}
} else {
	echo "Invalid request method.";
}
?>
