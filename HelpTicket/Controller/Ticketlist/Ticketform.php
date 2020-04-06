<?php
namespace MW\HelpTicket\Controller\Ticketlist;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;

class Ticketform extends Action {

    protected $_topicFactory;
    protected $_ticketFactory;
    protected $_defaFactory;
    protected $_customerSession;

    public function __construct(
        \MW\HelpTicket\Model\TopicFactory $topicFactory,
        \MW\HelpTicket\Model\TicketFactory $ticketFactory,
        \MW\HelpTicket\Model\DefaFactory $defaFactory,
        Session $customerSession,
        Context $context
    )
    {
        $this->_topicFactory = $topicFactory;
        $this->_ticketFactory = $ticketFactory;
        $this->_defaFactory = $defaFactory;
        $this->_customerSession = $customerSession;
        parent::__construct($context);
    }

    public function execute()
    {
        if (!$this->_customerSession->isLoggedIn()) {
            return $this->_redirect('customer/account/login');
        }
        $params = $this->getRequest()->getParams();
        if (isset($params['close'])){
            $close = $this->_topicFactory->create()->load($params['close']);
            if (empty($close->getData())){
                $this->messageManager->addErrorMessage('This Topic is no longer exit !');
            }else {
                $close->setData(['topic_id'=>$params['close'],'status' => 0]);
                $close->save();
                $this->messageManager->addSuccessMessage('This Topic has been closed !');
            }
            $this->_redirect('*/ticketlist/index');
        }
        $topicData = $this->_topicFactory->create()->load($params['topicid'])->getData();
        $defaData = $this->_defaFactory->create()->load($topicData['department_id'])->getData();
        $ticketData = array();
        $ticketData['topic_id'] = $params['topicid'];
        $ticketData['department_id'] = $topicData['department_id'];
        $ticketData['topic'] = "customer";
        $ticketData['department'] = $defaData['title'].'('.$defaData['staff'].')';
        $ticketData['content'] = $params['content'];
        $ticket = $this->_ticketFactory->create();
        $ticket->setData($ticketData);
        $ticket->save();
        $this->messageManager->addSuccessMessage(
            __('Done!.')
        );
        $this->_redirect('*/ticketlist/index');
    }
}