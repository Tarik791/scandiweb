<?php

namespace App\Controller;

use App\Model\DVD;
use App\Model\Book;
use App\Model\Furniture;
use App\Model\ProductManager;
use App\Validation\ProductValidator;

class ProductController
{
    public function getProducts()
    {
        $productManager = new ProductManager();
        $products = $productManager->getAll();
        $products = $productManager->getProductDetails();
        return json_encode($products);
    }
    
    public static function addProduct($data)
    {
        $validator = new ProductValidator();

        $sku = htmlspecialchars($data['sku']);
        $name = htmlspecialchars($data['name']);
        $price = htmlspecialchars($data['price']);
        $productType = $data['productType'];

        $validator->validateSKU($sku);
        $validator->validateName($name);
        $validator->validatePrice($price);

        $valid = true;
        if ($productType === 'DVD') {
            $validator->validateSize($data['size']);
            $product = new DVD($sku, $name, $price, $data['size']);
        } elseif ($productType === 'Book') {
            $validator->validateWeight($data['weight']);
            $product = new Book($sku, $name, $price, $data['weight']);
        } elseif ($productType === 'Furniture') {
            $valid = $validator->validateDimensions($data['height'], $data['width'], $data['length']);
            $product = new Furniture($sku, $name, $price, $data['height'], $data['width'], $data['length']);
        } else {
            $validator->getErrors()['productType'] = 'Invalid Product Type';
            $valid = false;
        }

        $errors = $validator->getErrors();

        if (!$valid || !empty($errors)) {
            return json_encode(['errors' => $errors]);
        }

        if ($product->save()) {
            return json_encode(['message' => 'Successfully to add product']);
        } else {
            return json_encode(['message' => 'Failed to add product']);
        }
    }

    public static function deleteProducts($data) {
        $productManager = new ProductManager();
        $ids = $data['ids'] ?? [];

        if (empty($ids)) {
            return json_encode(['message' => 'No product IDs provided']);
        }

        if ($productManager->deleteByIds($ids)) {
            return json_encode(['message' => 'Products deleted successfully']);
        } else {
            return json_encode(['message' => 'Failed to delete products']);
        }
    }
}
