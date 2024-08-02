<?php

namespace App\Model;

class Furniture extends Product
{
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price, $height, $width, $length)
    {
        parent::__construct($sku, $name, $price);
        $this->setHeight($height);
        $this->setWidth($width);
        $this->setLength($length);
    }

    protected function getTableName(): string
    {
        return 'products';
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function save(): bool
    {
        $productData = [
            'sku' => $this->getSku(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'type' => 'Furniture'
        ];

        $this->insert($productData);
        $productId = $this->db->lastInsertId();

        $furnitureAttributesData = [
            'product_id' => $productId,
            'height' => $this->getHeight(),
            'width' => $this->getWidth(),
            'length' => $this->getLength(),        ];

        $this->insertIntoAdditionalTable('furniture_attributes', $furnitureAttributesData);
        return true;
    }
}
