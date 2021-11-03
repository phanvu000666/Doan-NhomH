<?php


require_once 'Controller/Product.php';
require_once 'Controller/order.php';
require_once 'Controller/Pagination.php';
require_once('./PHP/component.php');
$products = new Product();
$total    = 0;
$data     = $products->getData();

//unset($_SESSION['cart']);
$keyword = '';
if (!empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $Search = $product->Search($keyword);
    //var_dump($Search);
}
include_once("view/header.php");
if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            unset($_SESSION['cart'][$key]);
            if ($value["prductID"] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...')</script>";
                //echo "<script> window.location='cart2.php'</script>";
            }
        }
    }
}

if (isset($_POST['plus'])) {
    if ($_GET['action'] === 'remove') {
        // var_dump($_GET['action']);
        foreach ($data as $key => $value) {
            //var_dump($value);
            $id = $value["ProductID"];
            if ($id == $_GET['id']) {

                if (isset($_SESSION['quanlity'][$id])) {
                    ++$_SESSION['quanlity'][$id];
                }
            }
        }
    }
}
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shopping Cart</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Search Products</h2>
                    <form action="#">
                        <input type="text" placeholder="Search products...">
                        <input type="submit" value="Search">
                    </form>
                </div>

                <div class="single-sidebar">
                    <h4 class="sidebar-title">PRICE DETAILS</h4>
                    <hr>
                    <div class="row price-details"></div>
                    <div class="col-md-6">
                        <?php
                        if (isset($_SESSION['cart'])) {
                            $count = count($_SESSION['cart']);
                            echo "<h4> Price ($count items) </h4>";
                        } else {
                            echo "<h6> Price(0 items) </h6>";

                        }
                        ?>
                        <h4>Delivery Charges</h4>
                        <hr>
                        <h4>Amount Payable</h4>
                    </div>
                    <div class="col-md-6">
                        <h4> $ <?php if (isset($_SESSION['total'])) echo number_format($_SESSION['total'], 0); ?></h4>
                        <h4 class="text-success">FREE</h4>
                        <hr>
                        <h4> $ <?php if (isset($_SESSION['total'])) echo number_format($_SESSION['total'], 0); ?></h4>

                    </div>


                </div>

                <div class="single-sidebar">
                    <h2 class="sidebar-title">Recent Posts</h2>
                    <ul>
                        <li><a href="#">Sony Smart TV - 2015</a></li>
                        <li><a href="#">Sony Smart TV - 2015</a></li>
                        <li><a href="#">Sony Smart TV - 2015</a></li>
                        <li><a href="#">Sony Smart TV - 2015</a></li>
                        <li><a href="#">Sony Smart TV - 2015</a></li>
                    </ul>
                </div>
            </div>
            <!-- DANH SÁCH SẢN PHẨM ORDER -->
            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">

                        <?php

                        if (isset($_SESSION['cart'])) {
                            $product_id = array_column($_SESSION['cart'], 'prductID');
                            $listIDs    = $products->getData();

                            foreach ($product_id as $id) {
                                for ($i = 0, $iMax = count($listIDs); $i < $iMax; $i++) {
                                    if ($listIDs[$i]['ProductID'] == $id) {
                                        cartElement($listIDs[$i]['ImageUrl'], $listIDs[$i]['ProductName'], $listIDs[$i]['Price'], $listIDs[$i]['ProductID']);

                                        $total = $total + (int) $listIDs[$i]['Price'];

                                    }
                                }

                            }
                            if ($total != $_SESSION['total']) {
                                $_SESSION['total'] = $total;
                                echo "<script>window.location.reload()</script>";
                            }


                        } else {
                            echo "<h3> Cart is Empty !!!</h3>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function msg() {
    var id = document.getElementById('idOrder').getAttribute('value');
    var number = document.getElementById('numberQuantity').getAttribute('value');

    alert("Hello world!" + number + " " + id);
}
</script>
<?php include_once("view/footer.php"); ?>