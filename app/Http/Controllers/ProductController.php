<?php

namespace App\Http\Controllers;

use App\Interfaces\Productable;
use Illuminate\Http\Request;

class ProductController extends BaseController
{

    public function __construct(private Productable $product)
    {
    }

    public function getAllProducts()
    {
        $productRes = $this->product->getAllProduct();
        return $this->success($productRes->getMessage(), $productRes->getCollection());
    }
}
