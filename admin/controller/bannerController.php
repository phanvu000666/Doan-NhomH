<?php

namespace SmartWeb\Controller;

use SmartWeb\DataBase\Product\Model;
use SmartWeb\Models\ObjectAssembler;
use SmartWeb\Repository\BannerRepository;
use SmartWeb\File\Upload;
use SmartWeb\Models\Product;
use SmartWeb\Models\Banner;

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}include{$ds}function.php");
include_once("{$base_dir}model{$ds}update-file.php");
include("{$base_dir}repository{$ds}banner-repository.php");

class BannerController
{
    private Banner $banner;
    public function __construct(string $conf)
    {
        $assembler = new ObjectAssembler($conf);
        $this->banner = $assembler->getComponent(Banner::class);
    }
    public function display_banners()
    {
        //initialize
        $result = $this->banner->getBannerList();
        $ds = DIRECTORY_SEPARATOR;
        $base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

        //C:\Users\Administrator\Desktop\web1\pictures
        $body_table = <<< Gryphon
        <thead>
            <tr>
                <th class="banner-remove">ID</th>
                <th class="banner-thumb">Image</th>
                <th class="banner-name">Title</th>
                <th class="banner-price">SubTitle</th>
            </tr>
        </thead> <!-- End Cart Table Head -->
        <tbody>
        Gryphon;
        foreach ($result as $key => $value) {
            $encode = encodeID($value['BannerId']);
            $body_table .= <<< Gryphon
            <tr class="single-banner" data-prid={$encode}>
                <td class="banner-id">{$encode}</td>
                <td class="banner-thumb">
                    <a href="banner-details-default.html">
                    <img  width="100rem" height="50rem" src="../img/{$value['BannerImage']}" class"img-fluid" alt="">
                    </a>
                </td>
                <td class="banner-title">{$value['BannerTitle']}</td>
                <td class="banner-sub-title">{$value['BannerSubTitle']}</td>
                <td class="banner-handle">
                   <div><button
                   style="all:unset" id="{$encode}" onclick="editBanner({$encode})" type="button" class="edit-data" data-toggle="modal" data-target="#editBannerModal">
                   <span class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </span>
                    </span>
                   </button>
                        <a href="{$_SERVER['PHP_SELF']}?BannerId={$encode}&handle=delete" class="btn btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                        </a>
                    </div>
                </td>
            </tr>
            Gryphon;
        }
        $body_table .= <<< Gryphon
        </tbody>
        Gryphon;
        return $body_table;
    }
    public function insert()
    {
        if (empty($_POST['BannerID']) && isset($_POST) && count($_POST) > 1) {
            //list expected fields
            $expected = ['BannerId',  'BannerImage', 'BannerTitle', 'BannerSubTitle'];
            //set required fields
            $required = ['BannerId',  'BannerImage', 'BannerTitle', 'BannerSubTitle'];
            //require processform.php
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

            require  "{$base_dir}include{$ds}processform.php";

            if ($_FILES &&  !empty($_FILES['BannerImage'])) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $path = "{$root}{$ds}img{$ds}";
                $file = new Upload($path);
                $file->upload("BannerImage");
            }
            var_dump($_POST);
            BannerRepository::insert($_POST);
        }
    }
    public function delete()
    {
        if (isset($_GET) && !empty($_GET['BannerId'])) {
            #check current page.
            $currentPage = 'slider.php';
            if ($currentPage !== htmlentities(basename($_SERVER['PHP_SELF']))) {
                // header('Location: ../admin/manager/product/information.php');
                exit;
            }
            if ($_GET && $_GET['handle'] == 'delete') {
                #decryption id
                $id = $_GET['BannerId'];
                $id = decryptionID($id);
                #delete banner.
                $result = BannerRepository::delete($id);
            }
        }
    }
    public function update()
    {
        if (!empty($_POST['BannerId']) && count($_POST) > 1) {
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