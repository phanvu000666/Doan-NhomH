<?php
require 'Controller/Product.php';
require 'Controller/Pagination.php';
$product = new Product();
$products = $product->getData();
$result = $product->getSPNew();
//$products = $product->getAllProducts();
$totalRow = $product->getTotalRow();
$perPage = 6;
$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
$pageLinks = Pagination::createPageLinks($totalRow, $perPage, $page);
//=================================================================
$keyword = '';
if (!empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $Search = $product->Search($keyword);
    //var_dump($Search);
}
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 3;
$total_rows = $product->countAll();
$total_pages = ceil($total_rows / $limit);
if ($current_page > $total_pages) {
    $current_page = $total_pages;
} elseif ($current_page < 1) {
    $current_page = 1;
}
$start = ($current_page - 1) * $limit;
$search_result = $product->Search_Paginate($start, $limit, $keyword);
//var_dump($result);
//var_dump($total_rows);


?>
<?php include_once("view/header.php"); ?> <br>
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
<?php
        if (!isset($_GET['mod'])) {
            if (!isset($_GET['keyword'])) {
                include_once("view/product/allProduct.php");
            }
            if (isset($_GET['keyword'])) {
                include_once("view/product/search_result.php");
            }
        }
        if(isset($_GET['mod'])) {
            $a = ucfirst($_GET['mod']);
            $b = ucfirst($_GET['act']);

            include_once("view/".$a."/".$b.".php");
        }
    ?>
<?php include_once("view/product/spMoinhat.php"); ?>
<!-- logo -->
<?php include_once("view/manufactures/logo.php"); ?>
<!-- product_widget -->
<?php include_once("view/product/product_widget.php"); ?>


<?php include_once("view/footer.php");