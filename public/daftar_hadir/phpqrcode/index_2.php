<?php
  
// Include the qrlib file
include 'qrlib.php';
  
// $text variable has data for QR 
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
// QR Code generation using png()
// When this function has only the
// text parameter it directly
// outputs QR in the browser
QRcode::png($actual_link);
?>