<?php
session_start();

require_once 'Controller/order.php';
require_once 'Controller/Product.php';
require_once 'Controller/Pagination.php';
require_once('./PHP/component.php');
$products = new Product();
$total    = 0;
$data     = $products->getData();

//unset($_SESSION['cart']);

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
        var_dump($_GET['action']);
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


<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart Page - Ustora Demo</title>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600'
          rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300'
          rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100'
          rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="admin/css/bootstrap.min.css">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin.css/font-awesome.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="admin/css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="admin/css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <![endif]-->
</head>
<body>

<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    <ul>
                        <li><a href="#"><i class="fa fa-user"></i> My Account</a></li>
                        <li><a href="#"><i class="fa fa-heart"></i> Wishlist</a></li>
                        <li><a href="cart.php"><i class="fa fa-user"></i> My Cart</a></li>
                        <li><a href="checkout.php"><i class="fa fa-user"></i> Checkout</a></li>
                        <li><a href="#"><i class="fa fa-user"></i> Login</a></li>
                        <li><a href="logout.php"><i class="fa fa-user"></i> Logout </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End header area -->

<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>Ì
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="shop.php">Shop page</a></li>
                    <li><a href="single-product.php">Single product</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="checkout.php">Checkout</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="#">Others</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->

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
</div>


<div class="footer-top-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="footer-about-us">
                    <h2>u<span>Stora</span></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis sunt id doloribus vero quam
                        laborum quas alias dolores blanditiis iusto consequatur, modi aliquid eveniet eligendi iure
                        eaque ipsam iste, pariatur omnis sint! Suscipit, debitis, quisquam. Laborum commodi veritatis
                        magni at?</p>
                    <div class="footer-social">
                        <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">User Navigation </h2>
                    <ul>
                        <li><a href="#">My account</a></li>
                        <li><a href="#">Order history</a></li>
                        <li><a href="#">Wishlist</a></li>
                        <li><a href="#">Vendor contact</a></li>
                        <li><a href="#">Front page</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">Categories</h2>
                    <ul>
                        <li><a href="#">Mobile Phone</a></li>
                        <li><a href="#">Home accesseries</a></li>
                        <li><a href="#">LED TV</a></li>
                        <li><a href="#">Computer</a></li>
                        <li><a href="#">Gadets</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-newsletter">
                    <h2 class="footer-wid-title">Newsletter</h2>
                    <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your
                        inbox!</p>
                    <div class="newsletter-form">
                        <form action="#">
                            <input type="email" placeholder="Type your email">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer top area -->

<div class="footer-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="copyright">
                    <p>&copy; 2015 uCommerce. All Rights Reserved. <a href="http://www.freshdesignweb.com"
                                                                      target="_blank">freshDesignweb.com</a></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-card-icon">
                    <i class="fa fa-cc-discover"></i>
                    <i class="fa fa-cc-mastercard"></i>
                    <i class="fa fa-cc-paypal"></i>
                    <i class="fa fa-cc-visa"></i>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer bottom area -->

<!-- Latest jQuery form server -->
<script src="https://code.jquery.com/jquery.min.js"></script>

<!-- Bootstrap JS form CDN -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!-- jQuery sticky menu -->
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.sticky.js"></script>

<!-- jQuery easing -->
<script src="js/jquery.easing.1.3.min.js"></script>

<!-- Main Script -->
<script src="js/main.js"></script>
</body>
<script>
    function msg() {
        var id = document.getElementById('idOrder').getAttribute('value');
        var number = document.getElementById('numberQuantity').getAttribute('value');

        alert("Hello world!" + number + " " + id);
    }
</script>


</html>