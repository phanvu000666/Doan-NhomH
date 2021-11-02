<?php
define("SEVERNAME", "localhost");
define("DATABASE", "smart-web");
define("USERNAME", "root");
define("PASSWORD", "");

$conn = mysqli_connect(SEVERNAME,USERNAME,PASSWORD,DATABASE) or die("không thể kết nối tới database");
mysqli_query($conn,"SET NAMES 'UTF8'");
?>