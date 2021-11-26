<?php

use SmartWeb\DBMYSQL;
use SmartWeb\Manufacture;
use SmartWeb\Phone;

include_once("model/manufacture.php");
include_once("model/phone.php");
$cate = Manufacture::getInstance(new DBMYSQL);
$pro = Phone::getInstance(new DBMYSQL);
$id = $_GET['id'];

$result2 = $pro->getProductsByManuID($id);
$manuName = $cate->getManuName($id);
?>
<center>
    <h2 style=" background-color: #5a88ca;color:#fff;padding: 10px; font-size: 40px;"><?php foreach ($manuName as $mnname) {
                                                                                            echo $mnname['ManufacturerName'];
                                                                                        } ?></h2>
</center>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container mt-4">
        <div class="grid-layout">
            <?php
                if (count($result2) < 1) {
                    echo "<center><h2>Không có sản phẩm nào</h2></center>";
                } else foreach ($result2 as $key => $value)
            echo"<div class='recipe_card'>
                <div class='top'><img
                        src='pictures/upload/".$result2[$key]['ImageUrl']."'
                        href='single-product.php?id=".$result2[$key]['ProductID']."' style='width:360px;height:290px;'></div>
                <div class='center'><a href='single-product.php?id=".$result2[$key]['ProductID']."'>".($result2[$key]['ProductName'])."</a></div>
                <div class='center'>".number_format($result2[$key]['Price'])."</div>
                <div class='bottom'><button class='btn btn-small btn-primary-detail'><a rel='nofollow noopener'
                            href='updateOrder.php?id=".$result2[$key]['ProductID']."&action=3'>ADD TO CARD</a></button></div>
            </div>";
                    ?>
        </div>
    </div>
</div>