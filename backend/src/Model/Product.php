<?php

namespace App\Model;

abstract class Product extends BaseModel
{
    protected $sku;
    protected $name;
    protected $price;

    public function __construct($sku = null, $name = null, $price = null)
    {
        parent::__construct();
        $this->setSku($sku);
        $this->setName($name);
        $this->setPrice($price);
    }

    abstract public function save(): bool;

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
