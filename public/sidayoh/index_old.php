<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>SiDAYO</title>

    <!-- Icons font CSS-->
    <link href="assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="assets/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="assets/css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Sistem Informasi Buku Tamu</h2>
                </div>
                <div class="card-body">
                    <form action="proses_input_daftar_tamu.php" method="POST">
                        <div class="form-row">
                            <div class="name">Nama</div>
                            <div class="value">
                                <!--<div class="row row-space">
                                    <div class="col-2">-->
                                        <div class="input-group">
                                            <input class="input--style-5" type="text" name="nama" value="">
                                        </div>
                                    <!--</div>
                                    </div>-->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Instansi</div>
                                <div class="value">
                                    <div class="input-group">
                                        <!--<div class="rs-select2 js-select-simple select--no-search">-->
                                            <?php
                                            $query_get_opd = $db->prepare("select * from master_opd");
                                            $query_get_opd->execute();
                                            ?>
                                            <select name="instansi" id="id_instansi">
                                                <option selected="selected" disabled="disabled">Pilih Instansi/Umum</option>
                                                <?php
                                                $query_get_siswa = $db->prepare("SELECT * FROM master_opd");
                                                $query_get_siswa->execute();
                                                while($data_query_get_siswa = $query_get_siswa->fetch(PDO::FETCH_ASSOC)){
                                                    ?>
                                                    <option value="<?php echo $data_query_get_siswa['id_instansi']; ?>"><?php echo $data_query_get_siswa['instansi']?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <div class="select-dropdown"></div>
                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="name">Alamat</div>
                                    <div class="value">
                                        <div class="input-group">
                                            <input class="input--style-5" type="text" name="alamat" id="alamat">
                                            <!--<input class="input--style-5" type="text" name="alamat_kosong" id="alamat_kosong">-->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row m-b-55">
                                    <div class="name">No Telp / HP</div>
                                    <div class="value">
                                <!--<div class="row row-refine">
                                    <div class="col-3">-->
                                        <div class="input-group">
                                            <input class="input--style-5" type="number" name="no_telp"> 
                                            <!--<label class="label--desc">Area Code</label>-->
                                        </div>
                                    <!--</div>
                                    </div>-->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Tanggal</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="date" name="tanggal">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Waktu</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="time" name="waktu">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Layanan</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="text" name="layanan" id="layanan">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Tujuan</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="text" name="tujuan">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Permasalahan</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="text" name="permasalahan">
                                    </div>
                                </div>
                            </div>
                        <!--<div class="form-row p-t-20">
                            <label class="label label--block">Are you an existing customer?</label>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55">Yes
                                    <input type="radio" checked="checked" name="exist">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">No
                                    <input type="radio" name="exist">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>-->
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="assets/vendor/select2/select2.min.js"></script>
    <script src="assets/vendor/datepicker/moment.min.js"></script>
    <script src="assets/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="assets/js/global.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>
        $(function() {
            $("#id_instansi").change(function(){
                var id_instansi = $("#id_instansi").val();

                $.ajax({
                    url: 'proses_get_data_alamat.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'id_instansi': id_instansi
                    },
                    success: function (opd) {
                        //$("#alamat").val(opd['alamat']);

                        if (opd['alamat'] == "kosong"){
                            //document.getElementById("alamat").style.visibility = "visible";
                            //document.getElementById("alamat_kosong").style.visibility = "visible";
                            document.getElementById('alamat').readOnly = false;
                            document.getElementById('alamat').value = '';
                            //$("#alamat").val(opd['alamat']);
                        }

                        if (opd['alamat'] != "kosong"){
                          //else{
                            //document.getElementById("alamat").style.visibility = "visible";
                            document.getElementById('alamat').readOnly = true;


                            //document.getElementById("alamat_kosong").style.visibility = "hidden";
                            $("#alamat").val(opd['alamat']);
                        }



                        /*$("#alamat").val(siswa['alamat']);
                        var $jenis_kelamin = $('input:radio[name=jenis_kelamin]');

                        if(siswa['jenis_kelamin'] == 'laki-laki'){
                            $jenis_kelamin.filter('[value=laki-laki]').prop('checked', true);
                        }
                        else{
                            $jenis_kelamin.filter('[value=perempuan]').prop('checked', true);
                        }*/
                    }
                });
            });

            $("form").submit(function(){
                alert("Keep learning");
            });
        });
    </script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->