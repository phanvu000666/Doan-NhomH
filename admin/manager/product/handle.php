<?php
#check current page.
$currentPage = 'handle.php';
if ($currentPage !== htmlentities(basename($_SERVER['PHP_SELF']))) {
    header('Location: http://web1.local/admin/manager/product/information.php');
    exit;
}

#check delete.
if ($_GET && $_GET['handle'] == 'delete') {
    #decryption id
    $id = $_GET['id'];
    $id = decryptionID($id);
    #delete product.
    include '../../../admin/controller/product.php';
    $product = new Product();
    $notification = $product->deleteProduct($id);
    if ($notification === true) {
        #thong bao sang form
    } else {
        #thong bao sang form
    }
    
    header('Location: http://web1.local/admin/manager/product/information.php');
    exit;
}

function decryptionID($id)
{
    return  substr($id, 4, 4);
}
