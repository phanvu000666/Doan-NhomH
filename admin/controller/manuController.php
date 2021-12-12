<?php

namespace SmartWeb\Controller;

use SmartWeb\Models\ObjectAssembler;
use SmartWeb\File\Upload;
use SmartWeb\Models\Manufacture;
use SmartWeb\Repository\ManuRepository;

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}include{$ds}function.php");
include("{$base_dir}repository{$ds}manu-repository.php");

class ManufactureController
{
    private Manufacture $manu;
    public function __construct(string $conf)
    {
        $assembler = new ObjectAssembler($conf);
        $this->manu = $assembler->getComponent(Manufacture::class);
    }
    public function display_manu()
    {
        //initialize
        $result = $this->manu->getManu();

        $select = <<< Select
            <select name="ManufacturerID" id="ManufacturerID">
            <option value="">Selected one</option>
        Select;
        foreach ($result as $key => $value) {
            $select .= <<< Select
            <option value="{$value['ManufacturerID']}">{$value['ManufacturerName']}</option>
            Select;
        }
        $select .= <<< Select
        </select>
        Select;
        return $select;
    }
    public function display_manus()
    {
        //initialize
        $result = $this->manu->getManu();
        $body_table = <<< Gryphon
        <thead>
            <tr>
                <th class="product_remove">ManufacturerID</th>
                <th class="manu_name">Manufacturer</th>
                <th class="product_total">Handle</th>
            </tr>
        </thead> <!-- End Cart Table Head -->
        <tbody>
        Gryphon;
        foreach ($result as $key => $value) {

            $encode = encodeID($value['ManufacturerID']);
            $body_table .= <<< Gryphon
            <tr class="single-product">
                <td class="manu-id">{$encode}</td>
                <td class="product-name">{$value['ManufacturerName']}</td>
                <td class="product-handle">
                   <div><button
                   style="all:unset"  data-ManufacturerID={$encode} id="{$encode}" type="button" class="edit-data edit-manu" data-toggle="modal" data-target="#editManuModal">
                   <span class="btn btn-info btn-icon-split edit-manu-btn">
                    <i style="background: rgba(0,0,0,.15);
                    display: inline-block;
                    padding: 0.375rem 0.75rem; font-weight: 900;" class="fas fa-edit edit-manu-i"></i>
                    </span>
                   </button>
                        <a href="{$_SERVER['PHP_SELF']}?ManufacturerID={$encode}&handle=delete" class="btn btn-danger btn-icon-split">
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
        if (isset($_GET) && !empty($_GET['ManufacturerID'])) {
           
            #check current page.
            $currentPage = 'manufacture.php';
            // if ($currentPage !== htmlentities(basename($_SERVER['PHP_SELF']))) {
            //     header('Location: http://web.local:81/admin/manufacture.php');
            //     exit;
            // }
            if ($_GET && $_GET['handle'] == 'delete') {
                #decryption id
                $id = $_GET['ManufacturerID'];
                $id = decryptionID($id);    
                 
                #delete manu.
                $result = ManuRepository::delete($id);

               
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
        if (empty($_POST['ManufacturerID']) && isset($_POST) && count($_POST) > 1) {
            // var_dump($_POST);
            // die();
            //list expected fields
            $expected = ['ManufacturerName', 'ManufacturerID'];
            //set required fields
            $required = ['ManufacturerName', 'ManufacturerID'];
            //require processform.php
            // $ds = DIRECTORY_SEPARATOR;
            // $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            // require  "{$base_dir}include{$ds}processform.php";


            ManuRepository::insert($_POST);
        }
    }

    public function send_data_from()
    {
        if ($_POST) {
            if (isset($_POST['GetManuData'])) {
                $id = decryptionID($_POST['ManufacturerID']);
           
                $manu = $this->manu->getManuID($id)[0];
                echo json_encode($manu);
                exit;
            }
        }
        // //   die();
        // if (isset($_POST['ManufacturerID']) &&
        //  !empty($_POST['ManufacturerID']) &&
        //   count($_POST) == 2 &&
        //    isset($_POST['GetManuData'])
        //    ) {
        //     $id = decryptionID($_POST['ManufacturerID']);
           
        //     $manu = $this->manu->getManuID($id)[0];
        //     echo json_encode($manu);
        //     exit;
        // }
    }

    public function update()
    {
        if (!empty($_POST['ManufacturerID']) && count($_POST) > 1) {
            //list expected fields
            $expected = ['ManufacturerName', 'ManufacturerID'];
            //set required fields
            $required = ['ManufacturerName', 'ManufacturerID'];
            //require processform.php
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            require  "{$base_dir}include{$ds}processform.php";

            $manu = ManuRepository::getManu();
            $version  = $manu->getVersion($_POST['ManufacturerID']);
            if ($version['Version'] === $_POST['Version']) {
                $is_update  = ManuRepository::update($_POST);
            }
        }
    }
}