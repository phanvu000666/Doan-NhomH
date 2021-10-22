<?php
require 'Controller/Product.php';
require 'Controller/Pagination.php';
$product = new Product();
$products = $product->getData();
//$products = $product->getAllProducts();
$totalRow = $product->getTotalRow();
$perPage = 3;
$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
$pageLinks = Pagination::createPageLinks($totalRow, $perPage, $page);
//=================================================================
$sanphan = $product->getData();
$keyword = '';
if (!empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $Search = $product->Search($keyword);
    //var_dump($Search);
}
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 6;
$total_rows = $product->countAll();
$total_pages = ceil($total_rows / $limit);
if ($current_page > $total_pages) {
    $current_page = $total_pages;
} elseif ($current_page < 1) {
    $current_page = 1;
}
$start = ($current_page - 1) * $limit;
$result = $product->Search_Paginate($start, $limit, $keyword);
//var_dump($result);
//var_dump($total_rows);


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
    <title>Shop Page- Ustora Demo</title>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
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

<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="./"><img src="img/logo.png"></a></h1>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="shopping-item">
                    <a href="cart.html">Cart - <span class="cart-amunt">$100</span> <i class="fa fa-shopping-cart"></i>
                        <span class="product-count">5</span></a>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End site branding area -->

<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
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
<div class="search">
    <form action="shop.php" method="get">
        <input type="text" name="keyword" class="searchTerm" placeholder="search..." <?php echo $keyword ?>>
        <button type="submit" class="searchButton">
            <i class="fa fa-search"></i>
        </button>
    </form>
</div>
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shop</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                $getData = $product->getAllProducts($page, $perPage);
                foreach ($result as $key => $value)
                    echo "<div class='col-md-4'>
                    <div class='single-shop-product'>
                        <div class='product-upper'>
                            <img src='pictures/" . $result[$key]['ImageUrl'] . "' style='width:220px;height:220px;'>
                        </div>
                        <h2><a href='single-product.php?id=" . $result[$key]['ProductID'] . "'>" . ($result[$key]['ProductName']) . "</a></h2>
                        <div class='product-carousel-price'>
                        <h2>" . number_format($result[$key]['Price']) . " VND</h2>
                        </div>  
                        
                        <div class='product-option-shop'>
                            <a class='add_to_cart_button' data-quantity='1' data-product_sku='' data-product_id='70' rel='nofollow' href='updateOrder.php?id=" . $result[$key]['ProductID'] . "&action=3'>Add to cart</a>
                        </div>   
                        </div>              
                    </div>"
                ?>
                <div class="pagination">
                    <nav class="pagination-center" aria-label="Page navigation example">
                        <ul class="pagination justify-content-center" style="margin-left: 450px !important;">

                            <?php if ($current_page > 1 && $total_pages > 1) { ?>
                                <li class="page-item disabled">
                                    <a class="page-link" aria-label="Previous"
                                       href="shop.php?page=<?= ($current_page - 1) ?>">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php
                            // Lặp khoảng giữa
                            for ($i = 1;
                                 $i <= $total_pages;
                                 $i++) {
                                // Nếu là trang hiện tại thì hiển thị thẻ span
                                // ngược lại hiển thị thẻ a
                                if ($i == $current_page) { ?>
                                    <li class="page-item"><a class="page-link" href=><?= $i ?></a></li>
                                <?php } else { ?>
                                    <li class="page-item"><a class="page-link" href="
                                                 shop.php?page=<?= $i ?>"><?= $i ?></a></li>
                                    <?php
                                }
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
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
                        <li><a href="">My account</a></li>
                        <li><a href="">Order history</a></li>
                        <li><a href="">Wishlist</a></li>
                        <li><a href="">Vendor contact</a></li>
                        <li><a href="">Front page</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">Categories</h2>
                    <ul>
                        <li><a href="">Mobile Phone</a></li>
                        <li><a href="">Home accesseries</a></li>
                        <li><a href="">LED TV</a></li>
                        <li><a href="">Computer</a></li>
                        <li><a href="">Gadets</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-newsletter">
                    <h2 class="footer-wid-title">Newsletter</h2>
                    <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your
                        inbox!</p>
                    <div class="newsletter-form">
                        <input type="email" placeholder="Type your email">
                        <input type="submit" value="Subscribe">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
</div>

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
</html>