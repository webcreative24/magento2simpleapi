<?php

namespace Yarmolich\AddFromUrl\Model;

use Yarmolich\AddFromUrl\Api\AddToCartInterface;
use Magento\Checkout\Model\Cart;
use Magento\Catalog\Api\ProductRepositoryInterface;

class AddToCart implements AddToCartInterface
{
    /**
     * @var Cart
     */
    protected $cart;
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * AddToCart constructor.
     *
     * @param Cart                       $cart
     * @param ProductRepositoryInterface $productRepository
     */

    public function __construct(
        Cart $cart,
        ProductRepositoryInterface $productRepository
    ) {
    
        $this->cart = $cart;
        $this->productRepository = $productRepository;
    }
    
    /**
     * @inheritdoc
     */
    public function addToCart($productId)
    {
        try {
            $product = $this->productRepository->getById($productId);
             $this->cart->addProduct($product, array('qty' => 1));
             $this->cart->save();
             return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
