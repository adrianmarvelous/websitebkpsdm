<?php
include "koneksi.php";
include "phpqrcode/qrlib.php"; // Include QR Code library outside the loop

$query_get_data_lo = $db->prepare('SELECT data_master_lo.*, absensi.status_hadir FROM `data_master_lo` LEFT JOIN absensi ON absensi.id_lo = data_master_lo.id GROUP BY nip_nik');
$query_get_data_lo->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    /* Custom CSS for table styling */
    .table-responsive {
        overflow-x: auto;
    }

    /* Additional styles for responsiveness */
    @media (max-width: 767px) {
        .table-responsive {
            overflow-x: auto;
        }
        .table thead th {
            font-size: 14px;
        }
        .table tbody td {
            font-size: 14px;
        }
    }
</style>
</head>
<body>
    <div class="container mt-5">
        <div class="table-responsive">
            <h1 align="center"><strong>LO Surabaya 2024</strong></h1>
            <a href="export_excel.php" class="btn btn-success"><i class="fas fa-file-excel"></i>  Export To Excel</a>
            <br><br>
            <table class="table">
                <thead class="thead-dark">
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
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while($data_query_get_data_lo = $query_get_data_lo->fetch(PDO::FETCH_ASSOC)){
                        if ($data_query_get_data_lo['status_perubahan'] == 1) {
                            ?>
                            <tr style="background-color: #bfffbf;">
                                <td><?=$no++?></td>
                                <td><?=$data_query_get_data_lo['nip_nik']?></td>
                                <td><?=$data_query_get_data_lo['nama']?></td>
                                <td><?=$data_query_get_data_lo['status_kepegawaian']?></td>
                                <td><?=$data_query_get_data_lo['nama_opd']?></td>
                                <td><?=$data_query_get_data_lo['no_hp']?></td>
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
                                <td><?=$data_query_get_data_lo['nip_nik']?></td>
                                <td><?=$data_query_get_data_lo['nama']?></td>
                                <td><?=$data_query_get_data_lo['status_kepegawaian']?></td>
                                <td><?=$data_query_get_data_lo['nama_opd']?></td>
                                <td><?=$data_query_get_data_lo['no_hp']?></td>
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
                                <td><?=$data_query_get_data_lo['nip_nik']?></td>
                                <td><?=$data_query_get_data_lo['nama']?></td>
                                <td><?=$data_query_get_data_lo['status_kepegawaian']?></td>
                                <td><?=$data_query_get_data_lo['nama_opd']?></td>
                                <td><?=$data_query_get_data_lo['no_hp']?></td>
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
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    </html>