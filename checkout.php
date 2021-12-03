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
                    <p id="billing_country_field"
                      class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                      <label class="" for="billing_country">Country <abbr title="required" class="required">*</abbr>
                      </label>
                      <select class="country_to_state country_select" id="billing_country" name="billing_country">
                        <option value="">Select a country…</option>
                        <option value="AX">Åland Islands</option>
                        <option value="AF">Afghanistan</option>
                        <option value="AL">Albania</option>
                        <option value="DZ">Algeria</option>
                        <option value="AD">Andorra</option>
                        <option value="AO">Angola</option>
                        <option value="AI">Anguilla</option>
                        <option value="AQ">Antarctica</option>
                        <option value="AG">Antigua and Barbuda</option>
                        <option value="AR">Argentina</option>
                        <option value="AM">Armenia</option>
                        <option value="AW">Aruba</option>
                        <option value="AU">Australia</option>
                        <option value="AT">Austria</option>
                        <option value="AZ">Azerbaijan</option>
                        <option value="BS">Bahamas</option>
                        <option value="BH">Bahrain</option>
                        <option value="BD">Bangladesh</option>
                        <option value="BB">Barbados</option>
                        <option value="BY">Belarus</option>
                        <option value="PW">Belau</option>
                        <option value="BE">Belgium</option>
                        <option value="BZ">Belize</option>
                        <option value="BJ">Benin</option>
                        <option value="BM">Bermuda</option>
                        <option value="BT">Bhutan</option>
                        <option value="BO">Bolivia</option>
                        <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
                        <option value="BA">Bosnia and Herzegovina</option>
                        <option value="BW">Botswana</option>
                        <option value="BV">Bouvet Island</option>
                        <option value="BR">Brazil</option>
                        <option value="IO">British Indian Ocean Territory</option>
                        <option value="VG">British Virgin Islands</option>
                        <option value="BN">Brunei</option>
                        <option value="BG">Bulgaria</option>
                        <option value="BF">Burkina Faso</option>
                        <option value="BI">Burundi</option>
                        <option value="KH">Cambodia</option>
                        <option value="CM">Cameroon</option>
                        <option value="CA">Canada</option>
                        <option value="CV">Cape Verde</option>
                        <option value="KY">Cayman Islands</option>
                        <option value="CF">Central African Republic</option>
                        <option value="TD">Chad</option>
                        <option value="CL">Chile</option>
                        <option value="CN">China</option>
                        <option value="CX">Christmas Island</option>
                        <option value="CC">Cocos (Keeling) Islands</option>
                        <option value="CO">Colombia</option>
                        <option value="KM">Comoros</option>
                        <option value="CG">Congo (Brazzaville)</option>
                        <option value="CD">Congo (Kinshasa)</option>
                        <option value="CK">Cook Islands</option>
                        <option value="CR">Costa Rica</option>
                        <option value="HR">Croatia</option>
                        <option value="CU">Cuba</option>
                        <option value="CW">CuraÇao</option>
                        <option value="CY">Cyprus</option>
                        <option value="CZ">Czech Republic</option>
                        <option value="DK">Denmark</option>
                        <option value="DJ">Djibouti</option>
                        <option value="DM">Dominica</option>
                        <option value="DO">Dominican Republic</option>
                        <option value="EC">Ecuador</option>
                        <option value="EG">Egypt</option>
                        <option value="SV">El Salvador</option>
                        <option value="GQ">Equatorial Guinea</option>
                        <option value="ER">Eritrea</option>
                        <option value="EE">Estonia</option>
                        <option value="ET">Ethiopia</option>
                        <option value="FK">Falkland Islands</option>
                        <option value="FO">Faroe Islands</option>
                        <option value="FJ">Fiji</option>
                        <option value="FI">Finland</option>
                        <option value="FR">France</option>
                        <option value="GF">French Guiana</option>
                        <option value="PF">French Polynesia</option>
                        <option value="TF">French Southern Territories</option>
                        <option value="GA">Gabon</option>
                        <option value="GM">Gambia</option>
                        <option value="GE">Georgia</option>
                        <option value="DE">Germany</option>
                        <option value="GH">Ghana</option>
                        <option value="GI">Gibraltar</option>
                        <option value="GR">Greece</option>
                        <option value="GL">Greenland</option>
                        <option value="GD">Grenada</option>
                        <option value="GP">Guadeloupe</option>
                        <option value="GT">Guatemala</option>
                        <option value="GG">Guernsey</option>
                        <option value="GN">Guinea</option>
                        <option value="GW">Guinea-Bissau</option>
                        <option value="GY">Guyana</option>
                        <option value="HT">Haiti</option>
                        <option value="HM">Heard Island and McDonald Islands</option>
                        <option value="HN">Honduras</option>
                        <option value="HK">Hong Kong</option>
                        <option value="HU">Hungary</option>
                        <option value="IS">Iceland</option>
                        <option value="IN">India</option>
                        <option value="ID">Indonesia</option>
                        <option value="IR">Iran</option>
                        <option value="IQ">Iraq</option>
                        <option value="IM">Isle of Man</option>
                        <option value="IL">Israel</option>
                        <option value="IT">Italy</option>
                        <option value="CI">Ivory Coast</option>
                        <option value="JM">Jamaica</option>
                        <option value="JP">Japan</option>
                        <option value="JE">Jersey</option>
                        <option value="JO">Jordan</option>
                        <option value="KZ">Kazakhstan</option>
                        <option value="KE">Kenya</option>
                        <option value="KI">Kiribati</option>
                        <option value="KW">Kuwait</option>
                        <option value="KG">Kyrgyzstan</option>
                        <option value="LA">Laos</option>
                        <option value="LV">Latvia</option>
                        <option value="LB">Lebanon</option>
                        <option value="LS">Lesotho</option>
                        <option value="LR">Liberia</option>
                        <option value="LY">Libya</option>
                        <option value="LI">Liechtenstein</option>
                        <option value="LT">Lithuania</option>
                        <option value="LU">Luxembourg</option>
                        <option value="MO">Macao S.A.R., China</option>
                        <option value="MK">Macedonia</option>
                        <option value="MG">Madagascar</option>
                        <option value="MW">Malawi</option>
                        <option value="MY">Malaysia</option>
                        <option value="MV">Maldives</option>
                        <option value="ML">Mali</option>
                        <option value="MT">Malta</option>
                        <option value="MH">Marshall Islands</option>
                        <option value="MQ">Martinique</option>
                        <option value="MR">Mauritania</option>
                        <option value="MU">Mauritius</option>
                        <option value="YT">Mayotte</option>
                        <option value="MX">Mexico</option>
                        <option value="FM">Micronesia</option>
                        <option value="MD">Moldova</option>
                        <option value="MC">Monaco</option>
                        <option value="MN">Mongolia</option>
                        <option value="ME">Montenegro</option>
                        <option value="MS">Montserrat</option>
                        <option value="MA">Morocco</option>
                        <option value="MZ">Mozambique</option>
                        <option value="MM">Myanmar</option>
                        <option value="NA">Namibia</option>
                        <option value="NR">Nauru</option>
                        <option value="NP">Nepal</option>
                        <option value="NL">Netherlands</option>
                        <option value="AN">Netherlands Antilles</option>
                        <option value="NC">New Caledonia</option>
                        <option value="NZ">New Zealand</option>
                        <option value="NI">Nicaragua</option>
                        <option value="NE">Niger</option>
                        <option value="NG">Nigeria</option>
                        <option value="NU">Niue</option>
                        <option value="NF">Norfolk Island</option>
                        <option value="KP">North Korea</option>
                        <option value="NO">Norway</option>
                        <option value="OM">Oman</option>
                        <option value="PK">Pakistan</option>
                        <option value="PS">Palestinian Territory</option>
                        <option value="PA">Panama</option>
                        <option value="PG">Papua New Guinea</option>
                        <option value="PY">Paraguay</option>
                        <option value="PE">Peru</option>
                        <option value="PH">Philippines</option>
                        <option value="PN">Pitcairn</option>
                        <option value="PL">Poland</option>
                        <option value="PT">Portugal</option>
                        <option value="QA">Qatar</option>
                        <option value="IE">Republic of Ireland</option>
                        <option value="RE">Reunion</option>
                        <option value="RO">Romania</option>
                        <option value="RU">Russia</option>
                        <option value="RW">Rwanda</option>
                        <option value="ST">São Tomé and Príncipe</option>
                        <option value="BL">Saint Barthélemy</option>
                        <option value="SH">Saint Helena</option>
                        <option value="KN">Saint Kitts and Nevis</option>
                        <option value="LC">Saint Lucia</option>
                        <option value="SX">Saint Martin (Dutch part)</option>
                        <option value="MF">Saint Martin (French part)</option>
                        <option value="PM">Saint Pierre and Miquelon</option>
                        <option value="VC">Saint Vincent and the Grenadines</option>
                        <option value="SM">San Marino</option>
                        <option value="SA">Saudi Arabia</option>
                        <option value="SN">Senegal</option>
                        <option value="RS">Serbia</option>
                        <option value="SC">Seychelles</option>
                        <option value="SL">Sierra Leone</option>
                        <option value="SG">Singapore</option>
                        <option value="SK">Slovakia</option>
                        <option value="SI">Slovenia</option>
                        <option value="SB">Solomon Islands</option>
                        <option value="SO">Somalia</option>
                        <option value="ZA">South Africa</option>
                        <option value="GS">South Georgia/Sandwich Islands</option>
                        <option value="KR">South Korea</option>
                        <option value="SS">South Sudan</option>
                        <option value="ES">Spain</option>
                        <option value="LK">Sri Lanka</option>
                        <option value="SD">Sudan</option>
                        <option value="SR">Suriname</option>
                        <option value="SJ">Svalbard and Jan Mayen</option>
                        <option value="SZ">Swaziland</option>
                        <option value="SE">Sweden</option>
                        <option value="CH">Switzerland</option>
                        <option value="SY">Syria</option>
                        <option value="TW">Taiwan</option>
                        <option value="TJ">Tajikistan</option>
                        <option value="TZ">Tanzania</option>
                        <option value="TH">Thailand</option>
                        <option value="TL">Timor-Leste</option>
                        <option value="TG">Togo</option>
                        <option value="TK">Tokelau</option>
                        <option value="TO">Tonga</option>
                        <option value="TT">Trinidad and Tobago</option>
                        <option value="TN">Tunisia</option>
                        <option value="TR">Turkey</option>
                        <option value="TM">Turkmenistan</option>
                        <option value="TC">Turks and Caicos Islands</option>
                        <option value="TV">Tuvalu</option>
                        <option value="UG">Uganda</option>
                        <option value="UA">Ukraine</option>
                        <option value="AE">United Arab Emirates</option>
                        <option selected="selected" value="GB">United Kingdom (UK)</option>
                        <option value="US">United States (US)</option>
                        <option value="UY">Uruguay</option>
                        <option value="UZ">Uzbekistan</option>
                        <option value="VU">Vanuatu</option>
                        <option value="VA">Vatican</option>
                        <option value="VE">Venezuela</option>
                        <option value="VN">Vietnam</option>
                        <option value="WF">Wallis and Futuna</option>
                        <option value="EH">Western Sahara</option>
                        <option value="WS">Western Samoa</option>
                        <option value="YE">Yemen</option>
                        <option value="ZM">Zambia</option>
                        <option value="ZW">Zimbabwe</option>
                      </select>
                    </p>

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


                    <div class="create-account">
                      <p>Create an account by entering the information below. If you are a
                        returning customer please login at the top of the page.</p>
                      <p id="account_password_field" class="form-row validate-required">
                        <label class="" for="account_password">Account password <abbr title="required"
                            class="required">*</abbr>
                        </label>
                        <input type="password" value="" placeholder="Password" id="account_password"
                          name="account_password" class="input-text">
                      </p>
                      <div class="clear"></div>
                    </div>

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
                    <li class="list-group-item d-flex justify-content-between bg-light">
                      <div class="text-success">
                        <h6 class="my-0">Promo code</h6>
                        <small>EXAMPLECODE</small>
                      </div>
                      <span class="text-success">-$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                      <span>Total (USD)</span>
                      <strong>$20</strong>
                    </li>
                  </ul>

                  <form class="card p-2">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Promo code">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                      </div>
                    </div>
                  </form>
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

              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                  <label class="custom-control-label" for="credit">Credit card</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="debit">Debit card</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="paypal">PayPal</label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="cc-name">Name on card</label>
                  <input type="text" class="form-control" id="cc-name" placeholder="Name on card is required" required>
                  <small class="text-muted">Full name as displayed on card</small>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="cc-number">Credit card number</label>
                  <input type="text" class="form-control" id="cc-number" placeholder="Credit card number is required"
                    required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="cc-expiration">Expiration</label>
                  <input type="text" class="form-control" id="cc-expiration" placeholder="Expiration date required"
                    required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="cc-cvv">CVV</label>
                  <input type="text" class="form-control" id="cc-cvv" placeholder="Security code required" required>
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