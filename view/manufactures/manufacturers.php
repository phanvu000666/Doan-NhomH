<?php
include_once("model/manufacture.php");

use SmartWeb\DBMYSQL;
use SmartWeb\Manufacture;

$manu = Manufacture::getInstance();
$resultm = $manu->getManufactures();
// var_dump($result);
foreach ($resultm as $row) {
    echo "<li class='menu-item menu-item-type-post_type menu-item-object-page menu-item-20527'> </li> <a class='nav-link' href=\"index.php?mod=manufactures&act=resultmanufacturers&id={$row['ManufacturerID']}\">{$row['ManufacturerName']}</a>";
}
