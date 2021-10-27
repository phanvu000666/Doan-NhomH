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


<?php include_once("view/footer.php");