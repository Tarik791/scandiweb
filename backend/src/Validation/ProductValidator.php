<?php

namespace App\Validation;

use App\Model\ProductManager;

class ProductValidator
{
    private $errors = [];
    private $productManager;

    public function __construct()
    {
        $this->productManager = new ProductManager();
    }

    public function validateSKU($sku)
    {
        if (empty($sku) || !preg_match('/^[A-Za-z0-9]+$/', $sku)) {
            $this->errors['sku'] = 'SKU must be alphanumeric and cannot be empty';
        } 

        if ($this->productManager->skuExists($sku)) {
            $this->errors['sku'] = 'SKU must be unique';
        }
        
    }

    public function validateName($name)
    {
        if (empty($name)) {
            $this->errors['name'] = 'Name cannot be empty';
        }
    }

    public function validatePrice($price)
    {
        if (empty($price)) {
            $this->errors['price'] = 'Price cannot be empty';
        }

        if (!is_numeric($price) || $price <= 0) {
            $this->errors['price'] = 'Price must be a positive number';
        }
    }

    public function validateSize($size)
    {
        if (empty($size)) {
            $this->errors['size'] = 'Size cannot be empty';
        }
        
        if (!is_numeric($size) || $size <= 0) {
            $this->errors['size'] = 'Size must be a positive number';
        }
    }

    public function validateWeight($weight)
    {
        if (empty($weight)) {
            $this->errors['weight'] = 'Weight cannot be empty';
        }

        if (!is_numeric($weight) || $weight <= 0) {
            $this->errors['weight'] = 'Weight must be a positive number';
        }
    }

    public function validateDimensions($height, $width, $length)
    {
        $valid = true;
        if (!is_numeric($height) || $height <= 0) {
            $this->errors['height'] = 'Height must be a positive number';
            $valid = false;
        }
        if (!is_numeric($width) || $width <= 0) {
            $this->errors['width'] = 'Width must be a positive number';
            $valid = false;
        }
        if (!is_numeric($length) || $length <= 0) {
            $this->errors['length'] = 'Length must be a positive number';
            $valid = false;
        }
        return $valid;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
