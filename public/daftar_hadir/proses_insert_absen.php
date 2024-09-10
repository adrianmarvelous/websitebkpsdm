<?php
ini_set('display_errors', 1);
error_reporting(~0);
date_default_timezone_set('Asia/Jakarta');
include "koneksi.php";

$nip = htmlentities($_POST['nip']);
$status_hadir = 1; // Assumsi 1 adalah hadir
$created_at = date("Y-m-d");
$waktu_hadir = date("Y-m-d H:i:s");

// Prepare and execute the select query
$query_select_absensi = $db->prepare("SELECT * FROM daftar_hadir_pengarahan_walikota WHERE nip = :nip");
$query_select_absensi->bindParam(":nip", $nip);
$query_select_absensi->execute();

// cek master
$query_select_master_absensi = $db->prepare("SELECT * FROM daftar_master_pengarahan_walikota WHERE nip = :nip");
$query_select_master_absensi->bindParam(":nip", $nip);
$query_select_master_absensi->execute();

// Check if the NIP is not registered
if ($query_select_master_absensi->rowCount() == 0) {
    echo "<script type='text/javascript'>alert('NIP TIDAK TERDAFTAR');window.location.href='absensi.php';</script>";
    exit();
}
else{
// Check if the query was successful
    if ($query_select_absensi) {
    // Check if any record was found
        if ($query_select_absensi->rowCount() > 0) {
            echo "<script type='text/javascript'>alert('Absen Sudah Pernah Dilakukan');window.location.href='index.php?nip={$nip}';</script>";
        }
        else {
            include "qr_code_generator.php";
        // Prepare and execute the insert query
            $query_insert_absensi = $db->prepare("INSERT INTO daftar_hadir_pengarahan_walikota (nip, status_hadir, waktu_hadir, created_at) VALUES (:nip, :status_hadir, :waktu_hadir, :created_at)");
            $query_insert_absensi->bindParam(':nip', $nip);
            $query_insert_absensi->bindParam(':status_hadir', $status_hadir);
            $query_insert_absensi->bindParam(':waktu_hadir', $waktu_hadir);
            $query_insert_absensi->bindParam(':created_at', $created_at);
            $query_insert_absensi->execute();
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Absensi</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </head>
            <body>
                <div class="container">
                    <!-- Your PHP code and HTML content -->
                </div>
                <script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'Absen Berhasil',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                        // Redirect or do any other action if needed
                        window.location.href = 'index.php?nip=<?= $nip ?>';
                    }
                });
            </script>
        </body>
        </html>
        <?php
    }
} else {
    // Handle query failure (optional)
    echo "<script type='text/javascript'>alert('Query failed. Please try again.');window.history.back();</script>";
}
}
?>
