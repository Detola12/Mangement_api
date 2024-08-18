<?php


namespace App\Interfaces;


use App\Models\Product;
use App\Responses\ProductResponse;

interface Productable
{
    public function getAllProduct() : ProductResponse;
//    public function editProduct(Product $product);
    public function removeProduct(Product $product) : ProductResponse;
    public function getSingleProductDetail(Product $product) : ProductResponse;
}
