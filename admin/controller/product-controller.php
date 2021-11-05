<?php

namespace SmartWeb\Controller;

use Product;
use SmartWeb\Repository\ProductRepository;

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
require_once("{$base_dir}repository{$ds}product-repository.php");
include_once("{$base_dir}include{$ds}function.php");
class ProductController
{
    public function __construct()
    {
        ProductRepository::getInstance();
    }
    public function display_products()
    {
        $result = ProductRepository::select("SELECT * FROM products ps INNER JOIN properties p ON p.id_product = ps.id");
        $body_table = "";
        foreach ($result as $key => $value) {
            // $id = $value['id'];
            $encode = encodeID($value['id']);
            $body_table .= <<< Gryphon
            <tr>
                <th rowspan="2" scope="row">{$value['id']}</th>
                <th rowspan="2" scope="row"><img class="img-thumbnail mx-auto img-fluid" src="../../images/{$value['image']}" alt="Hinh san pham"></th>
                <td rowspan="2">{$value['name']}</td>
                <td rowspan="2">{$value['price']}</td>
                <td rowspan="2">{$value['description']}</td>
                <td>
                    <a href="{$_SERVER['PHP_SELF']}?id={$encode}&handle=delete">Delete</a>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" id="{$encode}" value="Edit" class="edit-data" data-toggle="modal" data-target="#myModel">
                </td>
            </tr>
Gryphon;
        }
        return $body_table;
    }

    public function delete()
    {
        #check current page.
        $currentPage = 'information.php';
        if ($currentPage !== htmlentities(basename($_SERVER['PHP_SELF']))) {
            header('Location: http://web1.local/admin/manager/product/information.php');
            exit;
        }
        if ($_GET && $_GET['handle'] == 'delete') {
            #decryption id
            $id = $_GET['id'];
            $id = decryptionID($id);
            #delete product.
            $result = ProductRepository::delete("DELETE FROM products ps WHERE ps.id = :id", ['id' => $id]);
            if ($result === true) {
                #thong bao sang form
            } else {
                #thong bao sang form
            }
            header('Location: http://web1.local/admin/manager/product/information.php');
            exit;
        }
    }
}
