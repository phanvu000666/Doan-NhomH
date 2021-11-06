<?php
//UPDATE MODEL
namespace SmartWeb;
class TerrainFactory
{
    #[InjectConstructor(DB::class, Product::class)]
    public function __construct(private DB $db,  private Model $product)
    {
    }

    public function getDB(): DB
    {
        return $this->db;
    }

    public function getProduct(): Model
    {
        return $this->product;
    }
}

use Attribute;

#[Attribute]
class InjectConstructor
{
    public function __construct()
    {
        
    }
}
