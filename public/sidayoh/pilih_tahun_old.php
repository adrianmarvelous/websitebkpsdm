<?php
include("koneksi.php");
?>
<!--<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="asset/img/logo_pemkot.png">
    <title>login</title>
    <link rel="stylesheet" href="asset/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="asset/assets/css/-Login-form-Page-BS4-.css">
    <link rel="stylesheet" href="asset/assets/css/styles.css">
</head>

<body>
    <div class="alert alert-warning" role="alert">
        <?php //echo $_SESSION['error']; ?>
    </div>
    <div class="container-fluid">
        <div class="row mh-100vh">
            <div class="col-10 col-sm-8 col-md-6 col-lg-6 offset-1 offset-sm-2 offset-md-3 offset-lg-0 align-self-center d-lg-flex align-items-lg-center align-self-lg-stretch bg-white p-5 rounded rounded-lg-0 my-5 my-lg-0" id="login-block">
                <div class="m-auto w-lg-75 w-xl-50">
                    <img src="asset/img/logo_pemkot.png" style="width: 100px; margin-left: -25px;">
                    <h1 class="text-info font-weight-light mb-6"><i class="fa fa-list-ol"></i>&nbsp;Si</h1>
                    <h4 class="text-info font-weight-light mb-6"></i><b>Sistem Informasi Penilaian Kinerja</b></h4>-->
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label class="text-secondary">Tahun</label>
                            <select name="periode_tahun" class="form-control" required>
                                <?php
                                $query_tahun_periode = $db->prepare("select tahun from periode_tahun");
                                $query_tahun_periode->execute();
                                while($data_query_tahun_periode = $query_tahun_periode->fetch(PDO::FETCH_ASSOC))
                                {
                                    ?>
                                    <option><?=$data_query_tahun_periode['tahun'];?></option>
                                    <?php
                                }
                                ?>
                            </select>   
                        </div>
                        <button class="btn btn-info mt-2" name="submit" type="submit">Pilih</button>
                    </form>
                    <!--<p class="mt-3 mb-0"></p>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-end" id="bg-block" style="background-image:url(&quot;asset/assets/img/trans-suroboyo.png&quot;);background-size:cover;background-position:center center;">
                <p class="ml-auto small text-dark mb-2">
                </div>
            </div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>-->