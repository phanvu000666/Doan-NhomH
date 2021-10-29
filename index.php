<?php
require 'Controller/Product.php';
require 'Controller/Pagination.php';
$product = new Product();
$products = $product->getData();
$result = $product->getSPNew();
//=================================================================
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
$result_search = $product->Search_Paginate($start, $limit, $keyword);
//var_dump($result);
//var_dump($total_rows);


?>
<!-- header -->
<?php include_once("view/header.php"); ?>
<?php
        if (!isset($_GET['mod'])) {
            include_once("view/slider.php");
        }
        if(isset($_GET['mod'])) {
            $a = ucfirst($_GET['mod']);
            $b = ucfirst($_GET['act']);

            include_once("view/".$a."/".$b.".php");
        }
    ?>
<!-- Hiển thị sp mới nhất -->
<?php include_once("view/product/spMoinhat.php"); ?>
<!-- logo -->
<?php include_once("view\manufactures\logo.php"); ?>
<!-- product_widget -->
<?php include_once("view/product/product_widget.php"); ?>
<!-- footer -->
<?php include_once("view/footer.php");?>

<?php
    ob_end_flush();
?>