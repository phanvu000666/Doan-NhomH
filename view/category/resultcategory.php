<?php

use SmartWeb\DBMYSQL;
use SmartWeb\Phone;
use SmartWeb\Category;

$cate = Category::getInstance();
$pro = Phone::getInstance();
$id = $_GET['id'];

$result1 = $pro->getProductsByCateID($id);
$cateName = $cate->getCateName($id);
?>
<center>
    <h2 style=" background-color: #5a88ca;color:#fff;padding: 10px; font-size: 40px;">
        <?php foreach ($cateName as $ctname) {
            echo $ctname['CategoryName'];
        } ?></h2>
</center>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container mt-4">
        <div class="grid-layout">
            <?php
                if (count($result1) < 1) {
                    echo "<center><h2>Không có sản phẩm nào</h2></center>";
                } else foreach ($result1 as $key => $value)
            echo"<div class='recipe_card'>
                <div class='top'><img
                        src='pictures/upload/".$result1[$key]['ImageUrl']."'
                        href='single-product.php?id=".$result1[$key]['ProductID']."' style='width:360px;height:290px;'></div>
                <div class='center'><a href='single-product.php?id=".$result1[$key]['ProductID']."'>".($result1[$key]['ProductName'])."</a></div>
                <div class='center'>".number_format($result1[$key]['Price'])."</div>
                <div class='bottom'><button class='btn btn-small btn-primary-detail'><a rel='nofollow noopener'
                            href='updateOrder.php?id=".$result1[$key]['ProductID']."&action=3'>ADD TO CARD</a></button></div>
            </div>";
                    ?>
        </div>
    </div>
</div>