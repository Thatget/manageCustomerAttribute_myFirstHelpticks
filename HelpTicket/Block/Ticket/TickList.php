<?php
namespace MW\HelpTicket\Block\Ticket;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;

class TickList extends \Magento\Framework\View\Element\Template{

    protected $_defaFactory;
    protected $_topicFactory;
    protected $_ticketFactory;
    protected $_customerSession;

    public function __construct(
        Session $customerSession,
        Template\Context $context,
        array $data = [],
        \MW\HelpTicket\Model\DefaFactory $defaFactory,
        \MW\HelpTicket\Model\TopicFactory $topicFactory,
        \MW\HelpTicket\Model\TicketFactory $ticketFactory
    )
    {
        $this->_customerSession = $customerSession;
        $this->_defaFactory = $defaFactory;
        $this->_topicFactory = $topicFactory;
        $this->_ticketFactory = $ticketFactory;
        parent::__construct($context, $data);
    }

    public function getContent(){
        $param = $this->getRequest()->getParam('x');
        if (isset($param)){
            $topic = $this->_topicFactory->create();
            $check = $topic->load($param)->getData();
            if (empty($check)) {
                return 0;
            }
            return $param;
        }
        else
        return 0;
    }

    public function getDepartmentList(){
        $list = $this->_defaFactory->create()->getCollection();
        $list->addFieldToFilter('status',['eq'=>1]);
        return $list->getData();
    }

    public function getCustomerId()
    {
        return $this->_customerSession->getCustomerData()->getId();
    }

    public function getTopicList(){
        $customerId = $this->getCustomerId();
        $list = $this->_topicFactory->create()->getCollection();
        $list->getSelect()->joinLeft(array('second'=>'mw_helpticket_department'),
            'main_table.department_id = second.department_id',
            ['defatitle'=>'second.title','staff'=>'second.staff']
            );
        $list->addFieldToFilter('customer_id',['eq'=>$customerId])->setOrder('topic_id','DESC');
        return $list->getData();
    }

    public function getTicketContent(){
        $customerId = $this->getCustomerId();
        $topicId = $this->getRequest()->getParam('x');
        $list = $this->_ticketFactory->create()->getCollection()
            ->addFieldToFilter('topic_id',['eq'=>$topicId]);
//            ->setOrder('ticket_id','DESC');
        return $list->getData();
    }

    public function getTopicContent(){
        $customerId = $this->getCustomerId();
        $topicId = $this->getRequest()->getParam('x');
        $list = $this->_topicFactory->create();
        $list->load($topicId);
        return $list->getData();
    }

    public function checkClose()
    {
        $topicId = $this->getRequest()->getParam('x');
        $topic = $this->_topicFactory->create()->load($topicId);
        return $topic->getData();
    }

    public function getFormAction(){
        return $this->getUrl('ticktop/ticketlist/topicform');
    }
    public function getticketAction(){
        return $this->getUrl('ticktop/ticketlist/ticketform');
    }
}