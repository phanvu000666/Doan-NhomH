<?php
require_once 'Controller/Product.php';
require_once('Controller/component.php');
$products = new Product();
$oder     = new Order();
$insertOd = $oder->insertOder();
$total    = 0;
$data     = $products->getData();
$user     = $products->getUsers();
$getORDER = $oder->getOrderItems();
include "./view/check_out/header.php";
$_SESSION['user'] = $user;

?>
<?php
if (isset($_SESSION['username'])) {?>

    <div class='container'>
        <div class='window'>
            <div class='order-info'>
                <div class='order-info-content'>
                    <?php
                    if (isset($_SESSION['cart'])) {
                        $product_id = array_column($_SESSION['cart'], 'prductID');
                        $listIDs    = $products->getData();

                        foreach ($product_id as $id) {
                            for ($i = 0, $iMax = count($listIDs); $i < $iMax; $i++) {
                                if ( $listIDs[$i]['ProductID'] == $id) {
                                    checkOutElment($listIDs[$i]['ImageUrl'], $listIDs[$i]['ProductName'], $listIDs[$i]['Price'], $listIDs[$i]['ProductID'], $listIDs[$i]['Quantity']);
                                    $total = $total + (int) $listIDs[$i]['Price'];
                                }
                            }
                        }
                        if ($total != $_SESSION['total']) {
                            $_SESSION['total'] = $total;
                            echo "<script>window.location.reload()</script>";
                        }


                    } ?>
                    <div class='total'>
          <span style='float:left;'>
            <div class='thin dense'> VAT 19 %</div>
            <div class='thin dense'> Delivery</div>
    <h4> TOTAL</h4>
          </span>
                        <span style='float:right; text-align:right;'>
            <div class='thin dense'> $68.75 </div>
            <div class='thin dense'> $4.95 </div>
     <h5>$435.55 </h5>
    </span>
                    </div>
                </div>
            </div>
            <div class='credit-info'>
                <div class='credit-info-content'>
                    <table class='half-input-table'>
                        <td> Vui l??ng ??i???n th??ng tin b??n d?????i ????? ?????t h??ng</td>
                    </table>
                    <img src='./img/banner-mega-sale-23-15-bcb043f9-0cd6-47b6-b255-b760249b03c1.jpg' height='80'
                         class='credit-card-image' id='credit-card-image'>
                    <form method="post" action="check_out.php" name="checkout">
                        <h5>Vui l??ng nh???p t??n</h5>
                        <input type="text" class='input-field' name="name" value="">
                        <h5>Email</h5>
                        <input type="text" class='input-field' name="email" value="">
                        <h5>S??? ??i???n tho???i </h5>
                        <input type="number" class='input-field' name="sdt" value="">
                        <h5>?????a ch???</h5>
                        <input type="text" class='input-field' name="diachi">
                        <button class='pay-btn' name="checkout">Checkout</button>
                    </form>
                    <?php
                    if (isset($_POST['checkout'])) { ?>
                        <script>
                            swal("", "?????t h??ng th??nh c??ng!", "success");
                        </script>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['checkout'])) {
            $insertOd;
        }
        ?>
    </div>
<?php } else { ?>
    <div class="btn-checkout">
        <button class='pay-btn' name="btnkiemtra"> Checkout</button>
        <strong>vui l??ng ????ng nh???p</strong> <a href="Login.php"> Login</a>
    </div>


<?php } ?>

