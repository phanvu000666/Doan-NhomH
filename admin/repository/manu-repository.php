<?php

namespace SmartWeb\Repository;

use SmartWeb\Models\ObjectAssembler;
use SmartWeb\Models\Manufacture;

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

class ManuRepository
{
    private static Manufacture $manu;

    public static function insert(array $params)
    {
        //initialize manu.
        if (empty($manu)) {
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            $conf = "{$base_dir}dj{$ds}object.xml";
            $assembler = new ObjectAssembler($conf);

            static::$manu = $assembler->getComponent(Manufacture::class);
        }
        $is_finished = false;
        if (is_array($params)) {
            //add manu.
            $paramsmanu['ManufacturerName'] = htmlentities($params['ManufacturerName']);
            $is_finished =  static::$manu->insert($paramsmanu);
        }
        return $is_finished;
    }

    public static function delete($ManuID)
    {
        //initialize manu.
        if (empty($manu)) {
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            $conf = "{$base_dir}dj{$ds}object.xml";
            $assembler = new ObjectAssembler($conf);

            static::$manu = $assembler->getComponent(Manufacture::class);
        }

        //delte manu.
        $params['ManufacturerID'] = $ManuID;


        self::$manu->delete($params);
    }

    public static function update($params)
    {
        //initialize manu.
        if (empty($manu)) {
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            $conf = "{$base_dir}dj{$ds}object.xml";
            $assembler = new ObjectAssembler($conf);

            static::$manu = $assembler->getComponent(Manufacture::class);
        }
        $is_finished = false;
        if (is_array($params)) {
            //add manu.
            $paramsmanu['ManufacturerID'] = htmlentities($params['ManufacturerID']);
            $paramsmanu['ManufacturerName'] = htmlentities($params['ManufacturerName']);
            $paramsmanu['Version'] = htmlentities($params['Version']);
            $is_finished =  static::$manu->update($paramsmanu);
        }
        return $is_finished;
    }

    public static function getManu()
    {
        //initialize manu.
        if (empty($manu)) {
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            $conf = "{$base_dir}dj{$ds}object.xml";
            $assembler = new ObjectAssembler($conf);

            static::$manu = $assembler->getComponent(Manufacture::class);
        }
        return static::$manu;
    }
}
