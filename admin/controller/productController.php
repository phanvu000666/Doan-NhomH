<?php

namespace SmartWeb\Controller;

use SmartWeb\DataBase\Product\Model;
use SmartWeb\Models\ObjectAssembler;
use SmartWeb\Models\Phone;
use SmartWeb\Repository\ProductRepository;
use SmartWeb\File\Upload;
use SmartWeb\Models\Product;

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
        $ds = DIRECTORY_SEPARATOR;
        $base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

        //C:\Users\Administrator\Desktop\web1\pictures
        $body_table = <<< Gryphon
        <thead>
            <tr>
                <th class="product_remove">ID</th>
                <th class="product_thumb">Image</th>
                <th class="product_name">Product</th>
                <th class="product-price">Price</th>
                <th class="product_quantity">Quantity</th>
                <th class="product_total">Handle</th>
            </tr>
        </thead> <!-- End Cart Table Head -->
        <tbody>
        Gryphon;
        foreach ($result as $key => $value) {

            $encode = encodeID($value['ProductID']);
            $body_table .= <<< Gryphon
            <tr class="single-product" data-prid={$encode}>
                <td class="product-id">{$encode}</td>
                <td class="product-thumb">
                    <a href="product-details-default.html">
                    <img src="../pictures/Upload/{$value['ImageUrl']}" alt="">
                    </a>
                </td>
                <td class="product-name">{$value['ProductName']}</td>
                <td class="product-price">{$value['Price']}</td>
                <td class="product-quantity"><b>{$value['Quantity']}</b></td>
                <td class="product-handle">
                   <div><button
                   style="all:unset" id="{$encode}" onclick="editProduct({$encode})" type="button" class="edit-data" data-toggle="modal" data-target="#editProductModal">
                   <span class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </span>
                    </span>
                   </button>
                        <a href="{$_SERVER['PHP_SELF']}?ProductID={$encode}&handle=delete" class="btn btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                        </a>
                    </div>
                </td>
            </tr>
            Gryphon;
        }
        // <a href="{$_SERVER['PHP_SELF']}?ProductID={$encode}&handle=delete"><i class="fa fa-trash-o 1"></i></a>
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
            $base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

            require  "{$base_dir}include{$ds}processform.php";

            if ($_FILES &&  !empty($_FILES['ImageUrl'])) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $path = "{$root}{$ds}pictures{$ds}Upload{$ds}";
                $file = new Upload($path);
                $file->upload("ImageUrl");
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

            $product = ProductRepository::getProduct();
            $version  = $product->getVersion($_POST['ProductID']);

            if ($version['Version'] === $_POST['Version']) {
                var_dump("hien tai o day");
                if ($_FILES &&  !empty($_FILES['ImageUrl'])) {
                    $root = $_SERVER['DOCUMENT_ROOT'];
                    $path = "{$root}{$ds}pictures{$ds}Upload{$ds}";
                    $file = new Upload($path);
                    $file->upload("ImageUrl");
                }

                $is_update  = ProductRepository::update($_POST);
            }
        }
    }
}