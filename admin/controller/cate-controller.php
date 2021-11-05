<?php

namespace SmartWeb\Controller;

use Manufacture;
use Product;
use SmartWeb\Repository\ManufactureRepository;

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
require_once("{$base_dir}repository{$ds}cate-repository.php");
include_once("{$base_dir}include{$ds}function.php");
class CategoryController
{
    public function __construct()
    {
        ManufactureRepository::getInstance();
    }
    public function display_cate()
    {
        $result = ManufactureRepository::select("SELECT * FROM manufacturers");

        $select = <<< Select
            <select name="categories" id="categories">
            <option value="">Selected one</option>
        Select;
        foreach ($result as $key => $value) {
            $select .= <<< Select
            <option value="{$value['id']}">{$value['name']}</option>
            Select;
        }
        $select .= <<< Select
        </select>
        Select;
        return $select;
    }

    public function delete()
    {
    }
}
