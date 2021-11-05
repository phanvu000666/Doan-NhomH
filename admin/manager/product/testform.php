<?php
//Check current page.  against xss.
$currenPage = '/admin/manager/product/form.php';
if ($currenPage !== htmlentities($_SERVER['PHP_SELF'])) {
    //header('Location: http://web1.local/admin/manager/product/information.php');
    //exit;
}
// require utilities.php
require 'utilities.php';
//functions is using.
include '../../include/function.php';
//check $_POST Sended to page.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //list expected fields
    $expected = ['name', 'price', 'quantity', 'description', 'origin', 'manufactures', 'categories', 'image'];
    //set required fields
    $required = ['name', 'price', 'quantity', 'description', 'origin', 'manufactures', 'categories', 'image'];
    //require processform.php
    require '../../include/processform.php';
    //update edit data to form.
    if ($_POST &&  !empty($_POST['id'])) {
        $_SESSION['id'] = decryptionID($_POST['id']);
        $product = $products->getProduct($_SESSION['id'])[0];
        //print_r($product);
        //var_dump($product);
        echo json_encode($product);
        exit;
    }
    echo $image;
}/*  */
//check misssing and errors
if ($missing || $errors) {
    $missing['warning'] = '<p class="warning">Please fix the item(s) indicated </p>';
    //waring name.
    if (in_array('name', $missing)) {
        $warning['name'] = '<span class="warning">Please enter your' . $field['name'] . ' </span>';
    }
    //value send back ajax form
    if ($errors || $missing) {
        $values['name'] = htmlentities($name);
        $values['price'] = htmlentities($price);
        $values['quantity'] = htmlentities($quantity);
        $values['description'] = htmlentities($description);
        $values['origin'] = htmlentities($origin);
        $values['manufactures'] = htmlentities($manufactures);
        $values['categories'] = htmlentities($categories);
        $values['image'] = htmlentities($image);
    }
}
//success form.
if (!$missing && !$errors) {
    $imagename = '';
    //echo $image;die();
    if ($_FILES &&  !empty($_FILES['image'])) {
        $imagename = $products->uploadPhoto($_FILES['image']);
        $id = $_SESSION['id'];

        if ($id) {
            echo $name;
            $products->updateProduct($name, $price, $quantity, $description, $origin, $manufactures, $categories, $imagename, $id);
            unset($_SESSION['id']);
        } else {
            //insert
            $products->insertProduct($name, $price, $quantity, $description, $origin, $manufactures, $categories, $imagename);
        }
    }
    //$_POST = [];
    //header('Location : http://web1.local/admin/manager/product/information.php');
    // exit;
} else {
    //send back to ajax form.
    $data['values'] =  $values;
    $data['missing'] =  $missing;
    $data['warning'] = $warning;
    echo json_encode($data);
}
