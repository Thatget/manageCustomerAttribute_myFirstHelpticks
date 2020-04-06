<?php
namespace MW\HelpTicket\Controller\Ticketlist;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session;

class Index extends Action{

    protected $pageFactory;
    protected $customerSession;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Session $customerSession
        )
    {
        $this->customerSession = $customerSession;
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $data = $this->customerSession->isLoggedIn();
        if (!$data){
            return $this->_redirect('customer/account/login');
        }
        $resultPage = $this->pageFactory->create();
        return $resultPage;
    }
}