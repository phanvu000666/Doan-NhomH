<?php
if (!isset($_POST['selectPrice'])) {
    $getData=$product->getAllProducts($page,$perPage);
} else {
    $type=$_POST['selectPrice'];
    if ($type=='all') {
        $getData=$product->getAllProducts($page,$perPage);
    } else {
        $getData=$product->getProductsByPrice($type);
    }
}
?>
<center>
    <br>
    <form method="post" action="shop.php?mod=product&act=allproduct">
        <select class="mdb-select md-form" name="selectPrice" id="cbbGia">
            <option value="" disabled selected>Chọn hình thức hiển thị</option>
            <option value="all">Tất cả sản phẩm</option>
            <option value="asc">Giá tăng dần</option>
            <option value="des">Giá giảm dần</option>
        </select>
        <button type="submit" name="btnOK" style="font-size: 12px; border-radius: 10px; margin-left: 5px">Hiển Thị</button>
    </form>
</center>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container mt-4">
        <div class="grid-layout">
            <?php   
                        foreach ($getData as $key => $value)
            echo"<div class='recipe_card'>
                <div class='top'><img
                        src='pictures/upload/".$getData[$key]['ImageUrl']."'
                        href='single-product.php?id=".$getData[$key]['ProductID']."' style='width:360px;height:290px;'></div>
                <div class='center'><a href='single-product.php?id=".$getData[$key]['ProductID']."'>".($getData[$key]['ProductName'])."</a></div>
                <div class='center'>".number_format($getData[$key]['Price'])."</div>
                <div class='bottom'><button class='btn btn-small btn-primary-detail'><a rel='nofollow noopener'
                            href='updateOrder.php?id=".$getData[$key]['ProductID']."&action=3'>ADD TO CARD</a></button></div>
            </div>";
            echo $pageLinks;
                    ?>
        </div>
    </div>
</div>