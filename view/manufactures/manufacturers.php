<?php
    include_once("Controller/Manufacturers.php");
    $manu = new Manufactures();
    $resultm = $manu->getManufactures();
    // var_dump($result);
    foreach ($resultm as $row) {
        echo "<a href=\"index.php?mod=manufactures&act=resultmanufacturers&id={$row['ManufacturerID']}\">{$row['ManufacturerName']}</a>";
    }
