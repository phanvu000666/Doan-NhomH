<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
require 'Controller/Product.php';
$product = new Product();
$sanphan = $product->getData();
$keyword = '';
if (!empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $Search = $product->Search($keyword);
    //var_dump($Search);
}
$result = $product->Search($keyword);
//var_dump($result);
//var_dump($total_rows);

?>
<!-- header -->
<?php include_once("view/header.php"); ?>
<!-- form_search -->
<?php include_once("view/product/form_search.php"); ?>
<!-- slide -->
<?php include_once("view/slider.php"); ?>
<!-- Hiển thị search -->
<?php include_once("view/product/search_result.php"); ?>
<!-- logo -->
<?php include_once("view/manufacturers/logo.php"); ?>
<!-- product_widget -->
<?php include_once("view/product/product_widget.php"); ?>
<!-- footer -->
<?php include_once("view/footer.php");