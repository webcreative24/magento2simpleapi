<?php

namespace Yarmolich\AddFromUrl\Controller\Catalog;

use Yarmolich\AddFromUrl\Api\AddToCartInterface;
use Magento\Framework\App\Action\Context;

class Product extends \Magento\Framework\App\Action\Action
{
    /**
     * @var AddToCartInterface
     */
    private $addToCartInterface;
    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;
    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * Controller constructor.
     *
     * @param Context            $context
     * @param AddToCartInterface $addToCartInterface
     */
    public function __construct(
        Context $context,
        AddToCartInterface $addToCartInterface
    ) {
        parent::__construct($context);
        $this->addToCartInterface = $addToCartInterface;
        $this->messageManager = $context->getMessageManager();
        $this->resultRedirectFactory = $context->getResultRedirectFactory();
    }

    /**
     * Process addtocart interface and redirect to target page
     *
     * @return \Magento\Framework\Controller\Result\RedirectFactory
     */
    public function execute()
    {
        $productId = (int)$this->getRequest()->getParam('id');
        $response = $this->addToCartInterface->addToCart($productId);
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($response !== true) {
            $this->messageManager->addError($response);
            return $resultRedirect->setRefererOrBaseUrl();
        }
        return $resultRedirect->setPath('checkout/cart');
    }
}
