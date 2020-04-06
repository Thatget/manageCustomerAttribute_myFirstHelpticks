<?php
namespace MW\HelpTicket\Controller\Ticketlist;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;

class Topicform extends Action {

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
        if ($this->getRequest()->getParams()) {
            $data = $this->getRequest()->getParams();
            $defa = $this->_defaFactory->create();
            $defaValue = $defa->load($data['department'])->getData();
            if (!empty($defaValue)){
                $customer_id = $this->_customerSession->getCustomerData()->getId();
                $ticket = $this->_ticketFactory->create();
                $topic = $this->_topicFactory->create();

                $topicform = array();
                $topicform['title'] = $data['topicname'];
                $topicform['customer_id'] = $customer_id;
                $topicform['status'] = 1;
                $topicform['department_id'] = $data['department'];
                $topic->setData($topicform);
                $topic->save();
                $topicId = $topic->getId();

                $ticketForm = array();
                $ticketForm['topic_id'] = $topicId;
                $ticketForm['status'] = 1;
                $ticketForm['department_id'] = $data['department'];
                $ticketForm['content'] = $data['content'];
                $ticketForm['topic'] = "customer";
                $ticketForm['severity'] = isset($data['severity'])?$data['severity']:1;
                $ticketForm['department'] = $defaValue['title'].'('.$defaValue['staff'].')';
                $ticket->setData($ticketForm);
                $ticket->save();
                $this->messageManager->addSuccessMessage(
                    __('Done!.')
                );
            }
            else {
                $this->messageManager->addErrorMessage('This department is no longer exit !');
            }
        }
        $this->_redirect('*/ticketlist/index');
    }
}