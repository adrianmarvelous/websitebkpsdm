<?php
include "koneksi.php";
include "phpqrcode/qrlib.php"; // Include QR Code library outside the loop

$query_get_data_lo = $db->prepare('SELECT data_master_lo.*, absensi.status_hadir FROM `data_master_lo` left join absensi on absensi.id_lo = data_master_lo.id');
$query_get_data_lo->execute();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Absensi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP/NIK</th>
                    <th>Nama</th>
                    <th>Status Kepegawaian</th>
                    <th>OPD</th>
                    <th>No HP</th>
                    <th>Kehadiran</th>
                    <th>Qr Code</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while($data_query_get_data_lo = $query_get_data_lo->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td>
                            <?php
                            $id_lo = $data_query_get_data_lo['id'];
                            echo $nip_nik = $data_query_get_data_lo['nip_nik']; 
                            ?>
                        </td>
                        <td><?=$data_query_get_data_lo['nama']?></td>
                        <td><?=$data_query_get_data_lo['status_kepegawaian']?></td>
                        <td><?=$data_query_get_data_lo['nama_opd']?></td>
                        <td><?=$data_query_get_data_lo['no_hp']?></td>
                        <td>
                            <?php
                            if ($data_query_get_data_lo['status_hadir'] == 1) {
                                echo "Hadir";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            include "qr_code_generator.php";
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
