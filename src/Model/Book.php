<?php

namespace App\Model;

class Book extends Product
{
    private $weight;

    public function __construct($sku, $name, $price, $weight)
    {
        parent::__construct($sku, $name, $price);
        $this->setWeight($weight);
    }

    protected function getTableName(): string
    {
        return 'products';
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function save(): bool
    {
        $productData = [
            'sku' => $this->getSku(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'type' => 'Book'
        ];

        $this->insert($productData);
        $productId = $this->db->lastInsertId();

        $bookAttributesData = [
            'product_id' => $productId,
            'weight' => $this->getWeight()
        ];

        $this->insertIntoAdditionalTable('book_attributes', $bookAttributesData);
        return true;
    }
}
