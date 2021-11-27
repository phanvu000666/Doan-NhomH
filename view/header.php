<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
session_start();

// if (!isset($_SESSION['username'])||!isset($_SESSION['email'])) {
//     header('Location: dangnhap.php');
// }
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
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet'
        type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="admin_backup/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    <link rel="stylesheet" href="../css/css-shop-page.css">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="admin_backup/css/owl.carousel.css">
    <link rel="stylesheet" href="admin_backup/css/style.css">
    <link rel="stylesheet" href="admin_backup/css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="../css/css-header.css">
</head>

<body>
<div id="header" class="my-container-fluid-6 px-6">
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-0">
        <a class="navbar-brand " href="index.php">
            <img data-lazyloaded="1" src="img/logo1.png"
                 data-src="https://www.bootstrapdash.com/wp-content/themes/bootstradash/images/bootstrapdash-logo.svg"
                 alt="Bootstrap dash Logo" class="img-fluid litespeed-loaded" width="184" height="35"
                 data-was-processed="true">
        </a>
        <button class="navbar-toggler navbar-light px-0" type="button" data-toggle="collapse"
                data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="true"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse collapse2 navbar-collapse pl-lg-4 pb-lg-0 pb-4">
            <div class="menu-header-menu-container">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-36029">
                        <a href="index.php" class="nav-link">HOME</a>
                    </li>
                    <li
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-36029">
                        <a href="shop.php" class="nav-link">SHOP</a>

                    </li>
                    <li
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-36029">
                        <a href="#" class="nav-link">CATEGORY</a>
                        <ul class="sub-menu">
                            <?php include_once("view/category/category.php"); ?>
                        </ul>
                    </li>
                    <li
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-36029">
                        <a href="#" class="nav-link">MANUFACTURE</a>
                        <ul class="sub-menu">
                            <?php include_once("view\manufactures\manufacturers.php"); ?>
                        </ul>
                    </li>
                    <li
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-36029">
                            <a href="cart.php" class="nav-link">CART</a>
                        </li>
                    <div class="col-sm-4">
                        <div class="search">
                            <form action="shop.php" method="get" style="display: flex">
                                <input type="text" name="keyword" class="searchTerm" placeholder="search...">
                                <button type="submit" class="searchButton">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="nav-right-item mr-0 ml-auto">
                        <ul class="navbar-nav mr-auto align-items-lg-center align-items-start">
                            <li class="nav-item">
                                <a class="navbar-btn">Login/Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="navbar-btn"><i class="fa fa-shopping-cart"></i> <span>0</span></a>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</div>
<!--Header cu-->
<!--   <div class="header-area">-->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col-md-8">-->
<!--                    <div class="user-menu">-->
<!--                        <ul>-->
<!--                            --><?php
//                            if (isset($_SESSION['username']) && $_SESSION['groupID'] == 1) {
//                                echo " <li><a href='admin/'><i class='fa fa-user'></i> Trang Quản trị </a></li>";
//                            }
//                            ?>
    <!--                            <li><a href="#"><i class="fa fa-user"></i> My Account</a></li>-->
    <!--                            <li><a href="#"><i class="fa fa-heart"></i> Wishlist</a></li>-->
    <!--                            <li><a href="cart.php"><i class="fa fa-user"></i> My Cart</a></li>-->
    <!--                            <li><a href="checkout.php"><i class="fa fa-user"></i> Checkout</a></li>-->
    <!--                            --><?php
//                            if (!isset($_SESSION['username'])) {
//                                echo " <li><a href='dangnhap.php'><i class='fa fa-user'></i> Login </a></li>";
//                            }
//                            ?>
    <!--                            --><?php
//                            if (isset($_SESSION['username'])) {
//                                echo " <li><a href='dangxuat.php'><i class='fa fa-user'></i> Logout </a></li>";
//                            }
//                            ?>
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>  End header area -->

    <!--    <div class="site-branding-area">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-sm-6">-->
    <!--                    <div class="logo">-->
    <!--                        <h1><a href="./"><img src="img/logo.png"></a></h1>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-4">-->
    <!--                    <div class="search">-->
    <!--                        <form action="shop.php" method="get">-->
    <!--                            <input type="text" name="keyword" class="searchTerm" placeholder="search...">-->
    <!--                            <button type="submit" class="searchButton">-->
    <!--                                <i class="fa fa-search">Tìm Kiếm</i>-->
    <!--                            </button>-->
    <!--                        </form>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-2">-->
    <!--                    <div class="shopping-item">-->
    <!--                        <a href="cart.php">Cart <i class="fa fa-shopping-cart"></i></a>-->
    <!--                        --><?php
//                        if (isset($_SESSION['cart'])) {
//                            $count = count($_SESSION['cart']);
//                            echo "<span class='text-warning bg-light' id='cart_count'> $count</span>";
//                        } else {
//                            echo "<span class='text-warning bg-light' id='cart_count'>0</span>";
//                        }
//                        ?>
    <!---->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div> <-- End site branding area -->
    <!---->
    <!--        <div class="mainmenu-area">-->
    <!--            <div class="container">-->
    <!--                <div class="row">-->
    <!--                    <div class="navbar-header">-->
    <!--                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">-->
    <!--                            <span class="sr-only">Toggle navigation</span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                        </button>-->
    <!--                    </div>-->
    <!--                    <div class="navbar-collapse collapse">-->
    <!--                        <ul class="nav navbar-nav">-->
    <!--                            <li class="active"><a href="index.php">Home</a></li>-->
    <!--                            <li><a href="shop.php">Shop page</a></li>-->
    <!--                            <li><a href="single-product.php">Single product</a></li>-->
    <!--                            <li><a href="cart.php">Cart</a></li>-->
    <!--                            <li><a href="checkout.php">Checkout</a></li>-->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Category</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view/category/category.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Manufactures</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view\manufactures\manufacturers.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li><a href="#">Others</a></li>-->
    <!--                            <li><a href="#">Contact</a></li>-->
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>  <div class="site-branding-area">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-sm-6">-->
    <!--                    <div class="logo">-->
    <!--                        <h1><a href="./"><img src="img/logo.png"></a></h1>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-4">-->
    <!--                    <div class="search">-->
    <!--                        <form action="shop.php" method="get">-->
    <!--                            <input type="text" name="keyword" class="searchTerm" placeholder="search...">-->
    <!--                            <button type="submit" class="searchButton">-->
    <!--                                <i class="fa fa-search">Tìm Kiếm</i>-->
    <!--                            </button>-->
    <!--                        </form>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-2">-->
    <!--                    <div class="shopping-item">-->
    <!--                        <a href="cart.php">Cart <i class="fa fa-shopping-cart"></i></a>-->
    <!--                        --><?php
//                        if (isset($_SESSION['cart'])) {
//                            $count = count($_SESSION['cart']);
//                            echo "<span class='text-warning bg-light' id='cart_count'> $count</span>";
//                        } else {
//                            echo "<span class='text-warning bg-light' id='cart_count'>0</span>";
//                        }
//                        ?>
    <!---->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div> <-- End site branding area -->
    <!---->
    <!--        <div class="mainmenu-area">-->
    <!--            <div class="container">-->
    <!--                <div class="row">-->
    <!--                    <div class="navbar-header">-->
    <!--                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">-->
    <!--                            <span class="sr-only">Toggle navigation</span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                        </button>-->
    <!--                    </div>-->
    <!--                    <div class="navbar-collapse collapse">-->
    <!--                        <ul class="nav navbar-nav">-->
    <!--                            <li class="active"><a href="index.php">Home</a></li>-->
    <!--                            <li><a href="shop.php">Shop page</a></li>-->
    <!--                            <li><a href="single-product.php">Single product</a></li>-->
    <!--                            <li><a href="cart.php">Cart</a></li>-->
    <!--                            <li><a href="checkout.php">Checkout</a></li>-->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Category</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view/category/category.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Manufactures</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view\manufactures\manufacturers.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li><a href="#">Others</a></li>-->
    <!--                            <li><a href="#">Contact</a></li>-->
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>  <div class="site-branding-area">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-sm-6">-->
    <!--                    <div class="logo">-->
    <!--                        <h1><a href="./"><img src="img/logo.png"></a></h1>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-4">-->
    <!--                    <div class="search">-->
    <!--                        <form action="shop.php" method="get">-->
    <!--                            <input type="text" name="keyword" class="searchTerm" placeholder="search...">-->
    <!--                            <button type="submit" class="searchButton">-->
    <!--                                <i class="fa fa-search">Tìm Kiếm</i>-->
    <!--                            </button>-->
    <!--                        </form>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-2">-->
    <!--                    <div class="shopping-item">-->
    <!--                        <a href="cart.php">Cart <i class="fa fa-shopping-cart"></i></a>-->
    <!--                        --><?php
//                        if (isset($_SESSION['cart'])) {
//                            $count = count($_SESSION['cart']);
//                            echo "<span class='text-warning bg-light' id='cart_count'> $count</span>";
//                        } else {
//                            echo "<span class='text-warning bg-light' id='cart_count'>0</span>";
//                        }
//                        ?>
    <!---->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div> <-- End site branding area -->
    <!---->
    <!--        <div class="mainmenu-area">-->
    <!--            <div class="container">-->
    <!--                <div class="row">-->
    <!--                    <div class="navbar-header">-->
    <!--                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">-->
    <!--                            <span class="sr-only">Toggle navigation</span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                        </button>-->
    <!--                    </div>-->
    <!--                    <div class="navbar-collapse collapse">-->
    <!--                        <ul class="nav navbar-nav">-->
    <!--                            <li class="active"><a href="index.php">Home</a></li>-->
    <!--                            <li><a href="shop.php">Shop page</a></li>-->
    <!--                            <li><a href="single-product.php">Single product</a></li>-->
    <!--                            <li><a href="cart.php">Cart</a></li>-->
    <!--                            <li><a href="checkout.php">Checkout</a></li>-->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Category</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view/category/category.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Manufactures</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view\manufactures\manufacturers.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li><a href="#">Others</a></li>-->
    <!--                            <li><a href="#">Contact</a></li>-->
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>  <div class="site-branding-area">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-sm-6">-->
    <!--                    <div class="logo">-->
    <!--                        <h1><a href="./"><img src="img/logo.png"></a></h1>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-4">-->
    <!--                    <div class="search">-->
    <!--                        <form action="shop.php" method="get">-->
    <!--                            <input type="text" name="keyword" class="searchTerm" placeholder="search...">-->
    <!--                            <button type="submit" class="searchButton">-->
    <!--                                <i class="fa fa-search">Tìm Kiếm</i>-->
    <!--                            </button>-->
    <!--                        </form>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-2">-->
    <!--                    <div class="shopping-item">-->
    <!--                        <a href="cart.php">Cart <i class="fa fa-shopping-cart"></i></a>-->
    <!--                        --><?php
//                        if (isset($_SESSION['cart'])) {
//                            $count = count($_SESSION['cart']);
//                            echo "<span class='text-warning bg-light' id='cart_count'> $count</span>";
//                        } else {
//                            echo "<span class='text-warning bg-light' id='cart_count'>0</span>";
//                        }
//                        ?>
    <!---->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div> <-- End site branding area -->
    <!---->
    <!--        <div class="mainmenu-area">-->
    <!--            <div class="container">-->
    <!--                <div class="row">-->
    <!--                    <div class="navbar-header">-->
    <!--                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">-->
    <!--                            <span class="sr-only">Toggle navigation</span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                        </button>-->
    <!--                    </div>-->
    <!--                    <div class="navbar-collapse collapse">-->
    <!--                        <ul class="nav navbar-nav">-->
    <!--                            <li class="active"><a href="index.php">Home</a></li>-->
    <!--                            <li><a href="shop.php">Shop page</a></li>-->
    <!--                            <li><a href="single-product.php">Single product</a></li>-->
    <!--                            <li><a href="cart.php">Cart</a></li>-->
    <!--                            <li><a href="checkout.php">Checkout</a></li>-->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Category</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view/category/category.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Manufactures</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view\manufactures\manufacturers.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li><a href="#">Others</a></li>-->
    <!--                            <li><a href="#">Contact</a></li>-->
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>  <div class="site-branding-area">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-sm-6">-->
    <!--                    <div class="logo">-->
    <!--                        <h1><a href="./"><img src="img/logo.png"></a></h1>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-4">-->
    <!--                    <div class="search">-->
    <!--                        <form action="shop.php" method="get">-->
    <!--                            <input type="text" name="keyword" class="searchTerm" placeholder="search...">-->
    <!--                            <button type="submit" class="searchButton">-->
    <!--                                <i class="fa fa-search">Tìm Kiếm</i>-->
    <!--                            </button>-->
    <!--                        </form>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-2">-->
    <!--                    <div class="shopping-item">-->
    <!--                        <a href="cart.php">Cart <i class="fa fa-shopping-cart"></i></a>-->
    <!--                        --><?php
//                        if (isset($_SESSION['cart'])) {
//                            $count = count($_SESSION['cart']);
//                            echo "<span class='text-warning bg-light' id='cart_count'> $count</span>";
//                        } else {
//                            echo "<span class='text-warning bg-light' id='cart_count'>0</span>";
//                        }
//                        ?>
    <!---->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div> <-- End site branding area -->
    <!---->
    <!--        <div class="mainmenu-area">-->
    <!--            <div class="container">-->
    <!--                <div class="row">-->
    <!--                    <div class="navbar-header">-->
    <!--                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">-->
    <!--                            <span class="sr-only">Toggle navigation</span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                        </button>-->
    <!--                    </div>-->
    <!--                    <div class="navbar-collapse collapse">-->
    <!--                        <ul class="nav navbar-nav">-->
    <!--                            <li class="active"><a href="index.php">Home</a></li>-->
    <!--                            <li><a href="shop.php">Shop page</a></li>-->
    <!--                            <li><a href="single-product.php">Single product</a></li>-->
    <!--                            <li><a href="cart.php">Cart</a></li>-->
    <!--                            <li><a href="checkout.php">Checkout</a></li>-->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Category</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view/category/category.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Manufactures</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view\manufactures\manufacturers.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li><a href="#">Others</a></li>-->
    <!--                            <li><a href="#">Contact</a></li>-->
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>  <div class="site-branding-area">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-sm-6">-->
    <!--                    <div class="logo">-->
    <!--                        <h1><a href="./"><img src="img/logo.png"></a></h1>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-4">-->
    <!--                    <div class="search">-->
    <!--                        <form action="shop.php" method="get">-->
    <!--                            <input type="text" name="keyword" class="searchTerm" placeholder="search...">-->
    <!--                            <button type="submit" class="searchButton">-->
    <!--                                <i class="fa fa-search">Tìm Kiếm</i>-->
    <!--                            </button>-->
    <!--                        </form>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-2">-->
    <!--                    <div class="shopping-item">-->
    <!--                        <a href="cart.php">Cart <i class="fa fa-shopping-cart"></i></a>-->
    <!--                        --><?php
//                        if (isset($_SESSION['cart'])) {
//                            $count = count($_SESSION['cart']);
//                            echo "<span class='text-warning bg-light' id='cart_count'> $count</span>";
//                        } else {
//                            echo "<span class='text-warning bg-light' id='cart_count'>0</span>";
//                        }
//                        ?>
    <!---->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div> <-- End site branding area -->
    <!---->
    <!--        <div class="mainmenu-area">-->
    <!--            <div class="container">-->
    <!--                <div class="row">-->
    <!--                    <div class="navbar-header">-->
    <!--                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">-->
    <!--                            <span class="sr-only">Toggle navigation</span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                        </button>-->
    <!--                    </div>-->
    <!--                    <div class="navbar-collapse collapse">-->
    <!--                        <ul class="nav navbar-nav">-->
    <!--                            <li class="active"><a href="index.php">Home</a></li>-->
    <!--                            <li><a href="shop.php">Shop page</a></li>-->
    <!--                            <li><a href="single-product.php">Single product</a></li>-->
    <!--                            <li><a href="cart.php">Cart</a></li>-->
    <!--                            <li><a href="checkout.php">Checkout</a></li>-->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Category</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view/category/category.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Manufactures</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view\manufactures\manufacturers.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li><a href="#">Others</a></li>-->
    <!--                            <li><a href="#">Contact</a></li>-->
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>  <div class="site-branding-area">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-sm-6">-->
    <!--                    <div class="logo">-->
    <!--                        <h1><a href="./"><img src="img/logo.png"></a></h1>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-4">-->
    <!--                    <div class="search">-->
    <!--                        <form action="shop.php" method="get">-->
    <!--                            <input type="text" name="keyword" class="searchTerm" placeholder="search...">-->
    <!--                            <button type="submit" class="searchButton">-->
    <!--                                <i class="fa fa-search">Tìm Kiếm</i>-->
    <!--                            </button>-->
    <!--                        </form>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-2">-->
    <!--                    <div class="shopping-item">-->
    <!--                        <a href="cart.php">Cart <i class="fa fa-shopping-cart"></i></a>-->
    <!--                        --><?php
//                        if (isset($_SESSION['cart'])) {
//                            $count = count($_SESSION['cart']);
//                            echo "<span class='text-warning bg-light' id='cart_count'> $count</span>";
//                        } else {
//                            echo "<span class='text-warning bg-light' id='cart_count'>0</span>";
//                        }
//                        ?>
    <!---->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div> -- End site branding area -->
    <!---->
    <!--        <div class="mainmenu-area">-->
    <!--            <div class="container">-->
    <!--                <div class="row">-->
    <!--                    <div class="navbar-header">-->
    <!--                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">-->
    <!--                            <span class="sr-only">Toggle navigation</span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                        </button>-->
    <!--                    </div>-->
    <!--                    <div class="navbar-collapse collapse">-->
    <!--                        <ul class="nav navbar-nav">-->
    <!--                            <li class="active"><a href="index.php">Home</a></li>-->
    <!--                            <li><a href="shop.php">Shop page</a></li>-->
    <!--                            <li><a href="single-product.php">Single product</a></li>-->
    <!--                            <li><a href="cart.php">Cart</a></li>-->
    <!--                            <li><a href="checkout.php">Checkout</a></li>-->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Category</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view/category/category.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Manufactures</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view\manufactures\manufacturers.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li><a href="#">Others</a></li>-->
    <!--                            <li><a href="#">Contact</a></li>-->
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>  <div class="site-branding-area">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-sm-6">-->
    <!--                    <div class="logo">-->
    <!--                        <h1><a href="./"><img src="img/logo.png"></a></h1>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-4">-->
    <!--                    <div class="search">-->
    <!--                        <form action="shop.php" method="get">-->
    <!--                            <input type="text" name="keyword" class="searchTerm" placeholder="search...">-->
    <!--                            <button type="submit" class="searchButton">-->
    <!--                                <i class="fa fa-search">Tìm Kiếm</i>-->
    <!--                            </button>-->
    <!--                        </form>-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--                <div class="col-sm-2">-->
    <!--                    <div class="shopping-item">-->
    <!--                        <a href="cart.php">Cart <i class="fa fa-shopping-cart"></i></a>-->
    <!--                        --><?php
//                        if (isset($_SESSION['cart'])) {
//                            $count = count($_SESSION['cart']);
//                            echo "<span class='text-warning bg-light' id='cart_count'> $count</span>";
//                        } else {
//                            echo "<span class='text-warning bg-light' id='cart_count'>0</span>";
//                        }
//                        ?>
    <!---->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div> <-- End site branding area -->
    <!---->
    <!--        <div class="mainmenu-area">-->
    <!--            <div class="container">-->
    <!--                <div class="row">-->
    <!--                    <div class="navbar-header">-->
    <!--                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">-->
    <!--                            <span class="sr-only">Toggle navigation</span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                            <span class="icon-bar"></span>-->
    <!--                        </button>-->
    <!--                    </div>-->
    <!--                    <div class="navbar-collapse collapse">-->
    <!--                        <ul class="nav navbar-nav">-->
    <!--                            <li class="active"><a href="index.php">Home</a></li>-->
    <!--                            <li><a href="shop.php">Shop page</a></li>-->
    <!--                            <li><a href="single-product.php">Single product</a></li>-->
    <!--                            <li><a href="cart.php">Cart</a></li>-->
    <!--                            <li><a href="checkout.php">Checkout</a></li>-->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Category</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view/category/category.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li class="dropdown">-->
    <!--                                <a href="#" class="dropbtn">Manufactures</a>-->
    <!--                                <div class="dropdown-content">-->
    <!---->
    <!--                                    --><?php
//                                    include_once("view\manufactures\manufacturers.php");
//                                    ?>
    <!---->
    <!--                                </div>-->
    <!--                            </li>-->
    <!---->
    <!--                            <li><a href="#">Others</a></li>-->
    <!--                            <li><a href="#">Contact</a></li>-->
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div> -- End mainmenu area -->

    <?php

     