<?php

function cartElement($product_img, $productName, $product_Price, $product_id) {
    $id = $product_id;
    $element = "
    
    <form method=\"post\" action = \"cart.php?action=remove&id=$product_id\" class=\"cart-items\" style='margin-bottom: 2px;border: 2px solid #000000;'>
                            <div class=\"row bg-white\">
                                <div class=\"col-md-3\">
                                    <img src =\"pictures/upload/$product_img\"style='width:180px;height:220px;';>
                                </div >
                                <div class=\"col-md-6\">
                                    <h4 class=\"h2\">$productName</h4>
                                    <h4 class=\"text - warning\">$ $product_Price</h4>
                                    <button type=\"submit\" class=\"btn-group-sm\">
                                        Save for later
                                                 </button >
                                    <button type = \"submit\" class=\"btn-group-sm\" name = \"remove\">
                                        Remove
                                    </button >
                                </div >
                                <div class=\"col-md-3\" style =\"padding-top: 50px\">
                                    <div style =\"display:flex\">

                                        <button type=\"submit\" class=\"minus\" style =\"border-radius: 20px\" name='minus'><i
                                                    class=\"fa fa-minus\"></i></button>
                                        <input type=\"text\" value=\"".$_SESSION['quanlity'][$id]."\" class=\"form - control w - 25 d - inline\"
                                               style=\"width: 30%;height: auto;text-align: center\" name='price'>
                                        <button type=\"submit\" class=\"plus\" style =\"border-radius: 20px\" name='plus'><i
                                                    class=\"fa fa-plus\"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php }?>
    ";

    echo $element;
}