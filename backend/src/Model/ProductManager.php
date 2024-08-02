<?php

namespace App\Model;

class ProductManager extends BaseModel
{

    public function __construct() {

        parent::__construct();
    }

    protected function getTableName(): string
    {
        return 'products';
    }

    public function skuExists($sku)
    {
        return !$this->unique('sku', $sku);
    }
}
