<?php
namespace MW\CreAtt\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    protected $resultPageFactory;

    public function __construct(
        PageFactory $pageFactory,
        Action\Context $context
    )
    {
        $this->resultPageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        /**
         * Set active menu item
         */
        $resultPage->setActiveMenu('MW_CreAtt::customer_attribute');
        $resultPage->getConfig()->getTitle()->prepend(__('Customer Attributes'));


        return $resultPage;
    }
}
