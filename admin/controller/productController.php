<?php

namespace SmartWeb\Controller;


use SmartWeb\Models\ObjectAssembler;
use SmartWeb\Models\Phone;
use SmartWeb\Repository\ProductRepository;
use SmartWeb\File\Upload;

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}include{$ds}function.php");
include_once("{$base_dir}model{$ds}update-file.php");
include("{$base_dir}repository{$ds}product-repository.php");

class ProductController
{
    private Phone $phone;
    public function __construct(string $conf)
    {
        $assembler = new ObjectAssembler($conf);
        $this->phone = $assembler->getComponent(Phone::class);
    }
    public function display_products()
    {
        //initialize
        $result = $this->phone->getProduct();


        $body_table = <<< Gryphon
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ImageUrl</th>
            <th scope="col">ProductName</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
        Gryphon;
        foreach ($result as $key => $value) {

            $encode = encodeID($value['ProductID']);
            $body_table .= <<< Gryphon
            <tr>
                <th rowspan="2" scope="row">{$encode}</th>
                <th rowspan="2" scope="row"><img class="img-thumbnail mx-auto img-fluid" src="./images/{$value['ImageUrl']}" alt="Hinh san pham"></th>
                <td rowspan="2">{$value['ProductName']}</td>
                <td rowspan="2">{$value['Price']}</td>
                <td rowspan="2">{$value['Quantity']}</td>
                <td>
                    <a href="{$_SERVER['PHP_SELF']}?ProductID={$encode}&handle=delete">Delete</a>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" id="{$encode}" onclick="editProduct({$encode})" value="Edit" class="edit-data" data-toggle="modal" data-target="#myModel">
                </td>
            </tr>
            Gryphon;
        }
        $body_table .= <<< Gryphon
        </tbody>
        Gryphon;
        return $body_table;
    }

    public function delete()
    {
        if (isset($_GET) && !empty($_GET['ProductID'])) {
            #check current page.
            $currentPage = 'index.php';
            if ($currentPage !== htmlentities(basename($_SERVER['PHP_SELF']))) {
                header('Location: http://web1.local/admin/manager/product/information.php');
                exit;
            }
            if ($_GET && $_GET['handle'] == 'delete') {
                #decryption id
                $id = $_GET['ProductID'];
                $id = decryptionID($id);
                #delete product.
                $result = ProductRepository::delete($id);
                if ($result === true) {
                    #thong bao sang form
                } else {
                    #thong bao sang form
                }
            }
        }
    }

    public function insert()
    {
        if (empty($_POST['ProductID']) && isset($_POST) && count($_POST) > 1) {
            //list expected fields
            $expected = ['ProductName',  'ManufacturerID', 'CategoryID', 'Description', 'Quantity', 'Price'];
            //set required fields
            $required = ['ProductName', 'ManufacturerID', 'CategoryID', 'Description', 'Quantity', 'Price'];
            //require processform.php
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            require  "{$base_dir}include{$ds}processform.php";

            if ($_FILES &&  !empty($_FILES['image'])) {
                $path = "..{$ds}..{$ds}images{$ds}";
                $file = new Upload($path);
                $file->upload("image");
            }
            ProductRepository::insert($_POST);
        }
    }

    public function send_data_from()
    {
        if (isset($_POST['ProductID']) && !empty($_POST['ProductID']) && count($_POST) == 1) {
            $id = decryptionID($_POST['ProductID']);
            $product = $this->phone->getProductID($id)[0];
            echo json_encode($product);
            exit;
        }
    }

    public function update()
    {

        if (!empty($_POST['ProductID']) && count($_POST) > 1) {
            //list expected fields  
            $expected = ['ProductName',  'ManufacturerID', 'CategoryID', 'Description', 'Quantity', 'Price'];
            //set required fields
            $required = ['ProductName', 'ManufacturerID', 'CategoryID', 'Description', 'Quantity', 'Price'];
            //require processform.php
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            require  "{$base_dir}include{$ds}processform.php";

            if ($_FILES &&  !empty($_FILES['ImageUrl'])) {
                $path = "{$base_dir}{$ds}images{$ds}";
                $file = new Upload($path);
                $file->upload("ImageUrl");
            }

            ProductRepository::update($_POST);
        }
    }
}
