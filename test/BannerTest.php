<?php

// use SmartWeb\DataBase\Product\Model;
// use SmartWeb\Models\Product;
// use SmartWeb\Models\Banner;
use PHPUnit\Framework\TestCase;


class BannerTest extends TestCase
{
    public function testSumbOK()
    {
        var_dump(123);
        $phone = new Phone();
        $banner = new Banner();
        $exc=3;
        $act=$banner->sumb(1, 2);
        $this->assertEquals($exc, $act);
    }
}