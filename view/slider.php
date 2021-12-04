<div class='slider-area'>
    <!-- Slider -->
    <div class='block-slider block-slider4'>
    <ul class='' id='bxslider-home4'>
    <?php   
foreach ($ban as $key => $value)
        echo"<li>
                <img src='img/".$ban[$key]['BannerImage']."' alt='Slide'>
                <div class='caption-group'>
                    <h2 class='caption title'>
                        <a href=''>".($ban[$key]['BannerTitle'])."</a>
                    </h2>
                    <h4 class='caption subtitle'>".$ban[$key]['BannerSubTitle']."</h4>
                    <a class='caption button-radius' href='shop.php'><span class='icon'></span>Shop now</a>
                </div>
            </li>;"
        ?>
         </ul>
    </div>
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