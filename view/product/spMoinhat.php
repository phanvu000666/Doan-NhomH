<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Sản Phẩm Mới Nhất</h2>
                    <div class="product-carousel">
                        
                        <?php  foreach ($result as $key => $value) {

                            ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="pictures/upload/<?php echo $value['ImageUrl'] ?>" alt="" style="width:220px;height:280px;">
                                    <div class="product-hover">
                                        <a name="add" href="index.php" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to
                                            cart</a>
                                            <a href="single-product.php?id=<?=  $value['ProductID']?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="single-product.php"><?php echo $value['ProductName'] ?></a></h2>

                                <div class="product-carousel-price">
                                    <ins><?php echo "$".number_format($value['Price'],1) ?></ins>
                                    <del><?php echo "$".number_format($value['Price'],1) ?></del>
                                </div>
                                <form action="index.php" method="post">
                                    <input type="hidden" name="ProductID"
                                           value=<?= $value['ProductID'] ?>>
                                    <input name="ProductName" value="<?=$value['ProductName']?>" hidden>
                                    <input name="Quantity" value="<?=$value['Quantity']?>" hidden>
                                    <input name="Price" value="<?=$value['Price']?>" hidden>
                                    <input name="ImageUrl" value="<?= $value['ImageUrl'] ?>" hidden>
                                    <button type="submit" name="add-cart"
                                            class="btn btn-warning my3">Add to
                                        Cart <i
                                                class="fa fa-shopping-cart"></i>
                                    </button>

                                </form>
                            </div>
                        <?php } ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->