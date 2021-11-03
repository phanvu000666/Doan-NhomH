<?php
include 'Controller/Product.php';
session_start();
require_once('./PHP/component.php');
if ( ! isset($_SESSION['username'])) {
    header('Location: login.php');
}
$product = new Product();
$sanphan = $product->getData();
$keyword = '';
if ( ! empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $Search  = $product->Search($keyword);
    //var_dump($Search);
}
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit        = 5;
$total_rows   = $product->countAll();
$total_pages  = ceil($total_rows / $limit);
if ($current_page > $total_pages) {
    $current_page = $total_pages;
} elseif ($current_page < 1) {
    $current_page = 1;
}
$start = ($current_page - 1) * $limit;

$result    = $product->Search_Paginate($start, $limit, $keyword);
$productID = $product->getID();

//var_dump($productID);

//var_dump($result);
//var_dump($total_rows);

if (isset($_POST['add'])) {
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], "prductID");
        if (in_array($_POST['productID'], $item_array_id)) {
            echo "<script>alert('Sản phẩm đã tồn tại trong giỏ hàng !!!')</script>";
            echo "<script>window.location='index2.php'</script>";
        } else {
            $count      = count($_SESSION['cart']);
            $id = $_POST['productID'];
            $item_array = ['prductID' => $id];
            //var_dump($_POST);
            $_SESSION['cart'][$count] = $item_array;
            $_SESSION['quanlity'][$id] =1;
        }
    } else {
        $id = $_POST['productID'];
        $item_array          = ['prductID' => $id];
        $_SESSION['cart'][0] = $item_array;
        $_SESSION['quanlity'][$id] =1;
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
    <title>Shop SmartPhone</title>

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
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="admin/css/responsive.css">

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
        <div class="col-sm-12">
            <div class="shopping-item">
                <a href="cart2.php">Cart <i class="fa fa-shopping-cart"></i></a>
                <?php
                if (isset($_SESSION['cart'])) {
                    $count = count($_SESSION['cart']);
                    echo "<span class='text-warning bg-light' id='cart_count'> $count</span>";
                } else {
                    echo "<span class='text-warning bg-light' id='cart_count'>0</span>";
                }
                ?>

            </div>
        </div>
    </div>
</div> <!-- End site branding area -->

<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle"
                        data-toggle="collapse" data-target=".navbar-collapse">
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
<div class="wrap">
    <div class="search">
        <form action="index.php" method="get">
            <input style="
    width: 70%;
    margin-top: 20px;
    /* border-top: 81px; */
    margin-left: 200px;" type="text" name="keyword" class="searchTerm"
                   placeholder="search..." <?php echo $keyword ?> >
            <button type="submit" class="searchButton">
                <i class="fa fa-search"></i>
            </button>
        </form>


    </div>
</div>

<div class="slider-area">
    <!-- Slider -->
    <!-- ./Slider -->
</div> <!-- End slider area -->

<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo1">
                    <i class="fa fa-refresh"></i>
                    <p>30 Days return</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo2">
                    <i class="fa fa-truck"></i>
                    <p>Free shipping</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo3">
                    <i class="fa fa-lock"></i>
                    <p>Secure payments</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo4">
                    <i class="fa fa-gift"></i>
                    <p>New products</p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Latest Products</h2>
                    <div class="product-carousel">
                        <?php foreach ($result as $key => $value) {

                            ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="pictures/<?php echo $value['ImageUrl'] ?>" alt=""
                                         style="width:220px;height:280px;">
                                    <div class="product-hover">
                                        <a href="#" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to
                                            cart</a>
                                        <a href="single-product.php?id=<?= $value['ProductID'] ?>"
                                           class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="single-product.php"><?php echo $value['ProductName'] ?></a></h2>

                                <div class="product-carousel-price">
                                    <ins><?php echo $value['Price'] ?></ins>
                                    <del><?php echo $value['Price'] ?></del>
                                </div>
                                <form action="index2.php" method="post">
                                    <button type="submit" name="add"
                                            class="btn btn-warning my3">Add to
                                        Cart <i
                                                class="fa fa-shopping-cart"></i>
                                    </button>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="pagination">
                        <nav class="pagination-center" aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">

                                <?php if ($current_page > 1 && $total_pages > 1) { ?>
                                    <li class="page-item disabled">
                                        <a class="page-link" aria-label="Previous"
                                           href="index.php?page=<?= ($current_page - 1) ?>">
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
                                        <li class="page-item"><a class="page-link" href="#"><?= $i ?></a></li>
                                    <?php } else { ?>
                                        <li class="page-item"><a class="page-link" href="
                                                         index.php?page=<?= $i ?>"><?= $i ?></a></li>
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
</div> <!-- End main content area -->

<div class="brands-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-wrapper">
                    <div class="brand-list">
                        <img src="pictures/iphone.png" alt=""
                             style="width:220px;height:120px;">
                        <img src="pictures/samsung.png" alt=""
                             style="width:220px;height:120px;">
                        <img src="pictures/oppo.png" alt=""
                             style="width:220px;height:120px;">
                        <img src="pictures/xiaomi.png" alt=""
                             style="width:220px;height:120px;">
                        <img src="pictures/nokia.jpg" alt=""
                             style="width:220px;height:120px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End brands area -->

<div class="product-widget-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top Sellers</h2>
                    <a href="" class="wid-view-more">View All</a>
                    <?php
                    component();
                    component();
                    component();
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Recently Viewed</h2>
                    <a href="#" class="wid-view-more">View All</a>
                    <?php
                    component();
                    component();
                    component();
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top New</h2>
                    <a href="#" class="wid-view-more">View All</a>
                    <?php
                    component();
                    component();
                    component();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End product widget area -->

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
<script src="admin/js/owl.carousel.min.js"></script>
<script src="admin/js/jquery.sticky.js"></script>

<!-- jQuery easing -->
<script src="admin/js/jquery.easing.1.3.min.js"></script>

<!-- Main Script -->
<script src="admin/js/main.js"></script>

<!-- Slider -->
<script type="text/javascript" src="admin/js/bxslider.min.js"></script>
<script type="text/javascript" src="admin/js/script.slider.js"></script>
</body>
</html>