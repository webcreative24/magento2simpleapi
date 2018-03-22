<?php

namespace Yarmolich\AddFromUrl\Api;

interface AddToCartInterface
{
    /**
     * @param int $productId
     *
     * @return boolean|Exception
     */
    public function addToCart($productId);
}
