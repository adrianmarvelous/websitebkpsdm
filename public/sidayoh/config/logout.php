<?php
require("conn.php");
$login->logout();
create_alert("Success","Anda sudah logout dari sistem","../login.php");
?>