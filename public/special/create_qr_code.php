<?php

    ini_set('display_errors', 1);
    error_reporting(~0);
    require_once('../sijaka/plugin/phpqrcode/qrlib.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div style="width: 400px;padding:100px">
        <form action="" method="get">
            <label for="">Masukan Link</label>
            <input class="form-control" name="link" type="text" required>
            <br>
            <input type="hidden" name="" value="">
            <button class="btn btn-primary">Generate Qr Code</button>
        </form>
    </div>
    <?php
        if(isset($_GET['link'])){
            $actual_link = $_GET['link'];
            $id_content = "1";
            //file path
            $name_file = "surat_kesediaan_".$id_content;
            $file = "".$name_file.".png";

            //other parameters
            $ecc = 'M';
            $pixel_size = 10;
            $frame_size = 10;

            // Generates QR Code and Save as PNG
            QRcode::png($actual_link, $id_content, $ecc, $pixel_size, $frame_size);

            // Displaying the stored QR code if you want
            echo "<div><img width=50% src='".$id_content."'></div>";
        }
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>