<?php
require 'Controller/Pagination.php';
require_once 'Controller/FactoryPattern.php';
$factory = new FactoryPattern();
$product = $factory->make('product');
$sanpham = $product->get3SPNew();
$getData  = $product->getData();
$keyword = '';
?>
<?php include_once("view/header.php"); ?>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Search Products</h2>
                    <form class="form-group form-search" action="shop.php" method="get">
                        <input type="text" name="keyword" class="form-control searchTerm"
                            placeholder="Search products..." <?php echo $keyword ?>></input>
                        <button type="submit" class="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class='single-sidebar'>
                    <h2 class='sidebar-title'>Sản phẩm mới nhất</h2>
                    <?php foreach ($sanpham as $key => $value) {
    echo "
                    <div class='thubmnail-recent'>
                    <img src='pictures/upload/" . $value['ImageUrl'] . "' class='recent-thumb' style='width:70px;height:70px;'>
                    <h2><a href='single-product.php?id=" . $value['ProductID'] . " '>" . ($sanpham[$key]['ProductName']) . "</a></h2>                
                    <div class='product-sidebar-price'>
                    <h2>" . number_format($sanpham[$key]['Price']) . " VND</h2>
                        </div>
                    </div>";
}
                ?>
                </div>
            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <a href="">Home</a>
                        <a href="">Category Name</a>
                        <a href="">Sony Smart TV - 2015</a>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <?php
                      if (!isset($_GET['id'])) {
                          echo "Vui lòng chọn sản phẩm !";
                      } else {
                          foreach ($product->getData() as $key => $value) {
                              if ($_GET['id']==$product->getData()[$key]['ProductID']) {
                                  echo"<div class='product-images'>
                          <div class='product-main-img'>
                              <img src='pictures/upload/".$product->getData()[$key]['ImageUrl']."'>
                          </div>
                          
                          <div class='product-gallery'>
                          <img src='pictures/upload/".$product->getData()[$key]['ImageUrl']."'>
                          <img src='pictures/upload/".$product->getData()[$key]['ImageUrl']."'>
                          <img src='pictures/upload/".$product->getData()[$key]['ImageUrl']."'>
                          </div>
                      </div>
                  </div>
                  
                  <div class='col-sm-6'>
                      <div class='product-inner'>
                      <h2>".$product->getData()[$key]['ProductName']."</h2>
                          <div class='product-inner-price'>
                              <span>".number_format($product->getData()[$key]['Price'])." VND</span><br>
                          </div>    
                          
                          <form action='' class='cart'>
                              <div class='quantity'>
                                  <input type='number' size='4' class='input-text qty text' title='Qty' value='1' name='quantity' min='1' step='1'>
                              </div>
                              <button class='add_to_cart_button' type='submit'>Add to cart</button>
                          </form>   
                          
                          <div class='product-inner-category'>
                              <p>Category: <a href=''>Summer</a>. Tags: <a href=''>awesome</a>, <a href=''>best</a>, <a href=''>sale</a>, <a href=''>shoes</a>. </p>
                          </div> 
                          
                          <div role='tabpanel'>
                              <ul class='product-tab' role='tablist'>
                                  <li role='presentation' class='active'><a href='#home' aria-controls='home' role='tab' data-toggle='tab'>Description</a></li>
                                  <li role='presentation'><a href='#profile' aria-controls='profile' role='tab' data-toggle='tab'>Reviews</a></li>
                              </ul>
                              <div class='tab-content'>
                                  <div role='tabpanel' class='tab-pane fade in active' id='home'>
                                      <h2>Product Description</h2>  
                                      <p>".$product->getData()[$key]['Description']."</p>
                                  </div>
                                  </div>
                              </div>
                          </div>
                          ;";
                              }
                          }
                      }?>

                        </div>
                    </div>
                </div>
                <div class="related-products-wrapper">
                    <h2 class="related-products-title">Related Products</h2>
                    <div class="related-products-carousel">
                                    <?php foreach ($getData as $key => $value) {
                            echo"
                    <div class='single-shop-product'>
                        <div class='product-upper'>
                            <img src='pictures/upload/".$getData[$key]['ImageUrl']."'style='width:220px;height:220px;'>
                        </div>
                        <div class='product-content'>
                        <h2><a href='single-product.php?id=".$getData[$key]['ProductID']."'>".($getData[$key]['ProductName'])."</a></h2>
                        <div class='product-carousel-price'>
                        <h2>".number_format($getData[$key]['Price'])." VND</h2>
                        </div>  
                        
                        <div class='product-option-shop'>
                            <a class='add_to_cart_button' data-quantity='1' data-product_sku='' data-product_id='70' rel='nofollow' href='updateOrder.php?id=".$getData[$key]['ProductID']."&action=3'>Add to cart</a>
                        </div>   
                        </div>
                        </div>";
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php include_once("view/footer.php");
