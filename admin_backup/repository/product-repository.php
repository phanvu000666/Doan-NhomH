<?php

namespace SmartWeb\Repository;

use SmartWeb\DataBase\Product\Property;
use SmartWeb\Models\ObjectAssembler;
use SmartWeb\Models\Product;
use SmartWeb\Models\Phone;

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

class ProductRepository
{
    private static Phone $product;
    private static \SmartWeb\Models\Property $property;

    public static function insert(array $params)
    {
        //initialize product and property.
        if (empty($product) && empty($property)) {
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            $conf = "{$base_dir}dj{$ds}object.xml";
            $assembler = new ObjectAssembler($conf);

            static::$product = $assembler->getComponent(Product::class);
            static::$property = $assembler->getComponent(\SmartWeb\Models\Property::class);
        }
        $is_finished = false;
        if (is_array($params)) {

            //add product.
            $paramsproduct['ProductName'] = htmlentities($params['ProductName']);
            $paramsproduct['CategoryID'] = htmlentities($params['CategoryID']);
            $paramsproduct['ManufacturerID']  = htmlentities($params['ManufacturerID']);
            $is_finished =  static::$product->insert($paramsproduct);
            //add property.
            $id_max = (int)static::$product->getMaxID();
            $paramsproperty['ProductID'] = htmlentities($id_max);
            $paramsproperty['ImageUrl'] = htmlentities($params['ImageUrl']);
            $paramsproperty['Price'] = htmlentities($params['Price']);
            $paramsproperty['Quantity'] = htmlentities($params['Quantity']);
            $paramsproperty['Description'] = htmlentities($params['Description']);
            $is_finished = static::$property->insert($paramsproperty);
        }
        return $is_finished;
    }

    public static function delete($ProductID)
    {
        //initialize product and property.
        if (empty($product) && empty($property)) {
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            $conf = "{$base_dir}dj{$ds}object.xml";
            $assembler = new ObjectAssembler($conf);

            static::$product = $assembler->getComponent(Product::class);
            static::$property = $assembler->getComponent(\SmartWeb\Models\Property::class);
        }

        //delte product.
        $params['ProductID'] = $ProductID;
        self::$product->delete($params);
        //delete property.
        self::$property->delete($params);
    }

    public static function update($params)
    {
        //initialize product and property.
        if (empty($product) && empty($property)) {
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            $conf = "{$base_dir}dj{$ds}object.xml";
            $assembler = new ObjectAssembler($conf);

            static::$product = $assembler->getComponent(Product::class);
            static::$property = $assembler->getComponent(\SmartWeb\Models\Property::class);
        }
        $is_finished = false;
        if (is_array($params)) {


            //add product.
            $paramsproduct['ProductName'] = htmlentities($params['ProductName']);
            $paramsproduct['ManufacturerID']  = (int) htmlentities($params['ManufacturerID']);
            $paramsproduct['CategoryID'] = (int)htmlentities($params['CategoryID']);
            $paramsproduct['ProductID'] = (int)htmlentities($params['ProductID']);

            $is_finished =  static::$product->update($paramsproduct);
            if ($is_finished) {
                //add property.
                $paramsproperty['ImageUrl'] = htmlentities($params['ImageUrl']);
                $paramsproperty['Price'] = (int)htmlentities($params['Price']);
                $paramsproperty['Quantity'] = htmlentities($params['Quantity']);
                $paramsproperty['Description'] = htmlentities($params['Description']);
                $paramsproperty['ProductID'] =(int) htmlentities($paramsproduct['ProductID']);
                $is_finished = static::$property->update($paramsproperty);
            }
        }

        return $is_finished;
    }

    public static function getProduct()
    {
        //initialize product and property.
        if (empty($product) && empty($property)) {
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            $conf = "{$base_dir}dj{$ds}object.xml";
            $assembler = new ObjectAssembler($conf);

            static::$product = $assembler->getComponent(Product::class);
            static::$property = $assembler->getComponent(\SmartWeb\Models\Property::class);
        }
        return static::$product;
    }
}
