<?php

require 'admin/controller/Pagination.php';
require_once 'admin/Controller/FactoryPattern.php';
$factory  = new FactoryPattern();
$product  = $factory->make('product');
$products = $product->getData();
$result   = $product->getSPNew();

//=================================================================
include_once("view/header.php");
$totalRow = $product->getTotalRow();
$perPage  = 3;
$page     = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
$pageLinks = Pagination::createPageLinks($totalRow, $perPage, $page);
//hien thi array.
function pre_r($array) {
    echo "<pre>";
    print_r($array);
    echo "<pre>";
}
?>
    <!-- header -->
<?php
if ( ! isset($_GET['mod'])) {
    include_once("view/slider.php");
}
if (isset($_GET['mod'])) {
    $a = ucfirst($_GET['mod']);
    $b = ucfirst($_GET['act']);

    include_once("view/".$a."/".$b.".php");
}
?>
    <!-- Hiển thị sp mới nhất -->
<?php include_once("view/product/spMoinhat.php"); ?>
    <!-- logo -->
<?php include_once("view/manufactures/logo.php"); ?>
    <!-- footer -->
<?php include_once("view/footer.php"); ?>

<?php
ob_end_flush();
?>