<?php
<<<<<<< HEAD
require "./model/config.php";
require "./model/mysqli_con.php";
require_once 'Controller/Product.php';
require_once 'Controller/Order.php';
require_once('controller/component.php');
=======
include "model/mysqli_con.php";
include "model/config.php";
include "Controller/order.php";
require_once 'Controller/Product.php';
require_once('Controller/component.php');
>>>>>>> TrongTinh
$products = new Product();
$oder     = new Order();
$insertOd = $oder->insertOder();
$total    = 0;
$data     = $products->getData();
$user     = $products->getUsers();
$getORDER = $oder->getOrderItems();
var_dump($getORDER);
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
                        <h4> Vui lòng điền thông tin bên dưới để đặt hàng</h4>
                    </table>
                    <form method="post" action="check_out.php" name="checkout">
                        <h5>Nhập tên</h5>
                        <input type="text" class='input-field' name="name" value="">
                        <h5>Email</h5>
                        <input type="text" class='input-field' name="email" value="">
                        <h5>Số điện thoại </h5>
                        <input type="number" class='input-field' name="sdt" value="">
                        <h5>Địa chỉ</h5>
                        <input type="text" class='input-field' name="diachi">
                        <button class='pay-btn' name="checkout">Checkout</button>
                    </form>
                    <?php
                    if (isset($_POST['checkout'])) { echo "ádas";?>
                        <script>
                            swal("", "Đặt hàng thành công!", "success");
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
        <strong>vui lòng đăng nhập</strong> <a href="dangnhap.php"> Login</a>
    </div>


<?php } ?>

