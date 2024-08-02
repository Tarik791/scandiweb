<?php

namespace App\Model;

class DVD extends Product
{
    private $size;

    public function __construct($sku, $name, $price, $size)
    {
        parent::__construct($sku, $name, $price);
        $this->setSize($size);
    }

    protected function getTableName(): string
    {
        return 'products';
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function save(): bool
    {
        try {
            $this->beginTransaction(); 

            $productData = [
                'sku' => $this->getSku(),
                'name' => $this->getName(),
                'price' => $this->getPrice(),
                'type' => 'DVD'
            ];

            $this->insert($productData);
            $productId = $this->db->lastInsertId();

            $dvdAttributesData = [
                'product_id' => $productId,
                'size' => $this->getSize()
            ];

            $this->insertIntoAdditionalTable('dvd_attributes', $dvdAttributesData);

            $this->commit(); 

            return true;
        } catch (\Exception $e) {
            $this->rollBack(); 
            throw $e;
        }
    }
}
