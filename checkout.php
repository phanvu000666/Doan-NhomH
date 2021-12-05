<?php
require_once 'Controller/FactoryPattern.php';
$factory = new FactoryPattern();
$product = $factory->make('product');
$sanpham = $product->getData();
$keyword = '';
?>
<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<?php include_once("view/header.php"); ?>

<div class="product-big-title-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="product-bit-title text-center">
          <h2>Check Out</h2>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="single-product-area">
  <div class="zigzag-bottom"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="single-sidebar">
          <h2 class="sidebar-title">Search Products</h2>
          <form action="shop.php" method="get">
            <input type="text" name="keyword" class="searchTerm" placeholder="Search products..." <?php echo $keyword
              ?>></input>
            <button type="submit" class="searchButton">
              <i class="fa fa-search"></i>
            </button>
          </form>
        </div>

        <div class="single-sidebar">
          <h2 class="sidebar-title">Products</h2>
          <div class="thubmnail-recent">
            <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
            <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
            <div class="product-sidebar-price">
              <ins>$700.00</ins> <del>$100.00</del>
            </div>
          </div>
          <div class="thubmnail-recent">
            <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
            <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
            <div class="product-sidebar-price">
              <ins>$700.00</ins> <del>$100.00</del>
            </div>
          </div>
          <div class="thubmnail-recent">
            <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
            <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
            <div class="product-sidebar-price">
              <ins>$700.00</ins> <del>$100.00</del>
            </div>
          </div>
          <div class="thubmnail-recent">
            <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
            <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
            <div class="product-sidebar-price">
              <ins>$700.00</ins> <del>$100.00</del>
            </div>
          </div>
        </div>

        <div class="single-sidebar">
          <h2 class="sidebar-title">Recent Posts</h2>
          <ul>
            <li><a href="single-product.html">Sony Smart TV - 2015</a></li>
            <li><a href="single-product.html">Sony Smart TV - 2015</a></li>
            <li><a href="single-product.html">Sony Smart TV - 2015</a></li>
            <li><a href="single-product.html">Sony Smart TV - 2015</a></li>
            <li><a href="single-product.html">Sony Smart TV - 2015</a></li>
          </ul>
        </div>
      </div>

      <div class="col-md-8">
        <div class="product-content-right">
          <div class="woocommerce">
            <div class="woocommerce-info">Returning customer? <a class="showlogin" data-toggle="collapse"
                href="#login-form-wrap" aria-expanded="false" aria-controls="login-form-wrap">Click here
                to login</a>
            </div>

            <form id="login-form-wrap" class="login collapse" method="post">


              <p>If you have shopped with us before, please enter your details in the boxes below. If you
                are a new customer please proceed to the Billing &amp; Shipping section.</p>

              <p class="form-row form-row-first">
                <label for="username">Username or email <span class="required">*</span>
                </label>
                <input type="text" id="username" name="username" class="input-text">
              </p>
              <p class="form-row form-row-last">
                <label for="password">Password <span class="required">*</span>
                </label>
                <input type="password" id="password" name="password" class="input-text">
              </p>
              <div class="clear"></div>


              <p class="form-row">
                <input type="submit" value="Login" name="login" class="button">
                <label class="inline" for="rememberme"><input type="checkbox" value="forever" id="rememberme"
                    name="rememberme"> Remember me </label>
              </p>
              <p class="lost_password">
                <a href="#">Lost your password?</a>
              </p>

              <div class="clear"></div>
            </form>

            <div class="woocommerce-info">Have a coupon? <a class="showcoupon" data-toggle="collapse"
                href="#coupon-collapse-wrap" aria-expanded="false" aria-controls="coupon-collapse-wrap">Click here to
                enter your code</a>
            </div>

            <form id="coupon-collapse-wrap" method="post" class="checkout_coupon collapse">

              <p class="form-row form-row-first">
                <input type="text" value="" id="coupon_code" placeholder="Coupon code" class="input-text"
                  name="coupon_code">
              </p>

              <p class="form-row form-row-last">
                <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
              </p>

              <div class="clear"></div>
            </form>

            <form enctype="multipart/form-data" action="#" class="checkout" method="post" name="checkout">

              <div id="customer_details" class="col2-set">
                <div class="col-1">
                  <div class="woocommerce-billing-fields">
                    <h3>Billing Details</h3>
                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                      <label class="" for="billing_first_name">First Name <abbr title="required"
                          class="required">*</abbr>
                      </label>
                      <input type="text" value="" placeholder="" id="billing_first_name" name="billing_first_name"
                        class="input-text ">
                    </p>

                    <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                      <label class="" for="billing_last_name">Last Name <abbr title="required" class="required">*</abbr>
                      </label>
                      <input type="text" value="" placeholder="" id="billing_last_name" name="billing_last_name"
                        class="input-text ">
                    </p>
                    <div class="clear"></div>

                    <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                      <label class="" for="billing_address_1">Address <abbr title="required" class="required">*</abbr>
                      </label>
                      <input type="text" value="" placeholder="Street address" id="billing_address_1"
                        name="billing_address_1" class="input-text ">
                    </p>



                    <div class="clear"></div>

                    <p id="billing_email_field" class="form-row form-row-first validate-required validate-email">
                      <label class="" for="billing_email">Email Address <abbr title="required" class="required">*</abbr>
                      </label>
                      <input type="text" value="" placeholder="you@example.com" id="billing_email" name="billing_email"
                        class="input-text ">
                    </p>

                    <p id="billing_phone_field" class="form-row form-row-last validate-required validate-phone">
                      <label class="" for="billing_phone">Phone <abbr title="required" class="required">*</abbr>
                      </label>
                      <input type="text" value="" placeholder="" id="billing_phone" name="billing_phone"
                        class="input-text ">
                    </p>
                    <div class="clear"></div>
                  </div>
                </div>
                <div class="col-md-4 order-md-2 mb-4">
                  <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                  </h4>
                  <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">Product name</h6>
                        <small class="text-muted">Brief description</small>
                      </div>
                      <span class="text-muted">$12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">Second product</h6>
                        <small class="text-muted">Brief description</small>
                      </div>
                      <span class="text-muted">$8</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">Third item</h6>
                        <small class="text-muted">Brief description</small>
                      </div>
                      <span class="text-muted">$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                      <span>Total (USD)</span>
                      <strong>$20</strong>
                    </li>
                  </ul>
                </div>
              </div>
              <hr class="mb-4">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="same-address">
                <label class="custom-control-label" for="same-address">Shipping address is the same as my billing
                  address</label>
              </div>
              <hr class="mb-4">


              <!-- <h4 class="mb-3">Payment</h4> -->
              <h3>PAYMENT</h3>
                <div class="custom-control custom-radio">
                  <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="debit">Cash</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="paypal">PayPal</label>
                </div>
              </div>
              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include_once("view/footer.php");