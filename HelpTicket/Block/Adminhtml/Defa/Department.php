<?php

namespace MW\HelpTicket\Block\Adminhtml\Defa;

use Magento\Backend\Block\Template;

class Department extends Template
{

    protected $_defaFactory;
    protected $_topicFactory;
    protected $_ticketFactory;

    public function __construct(
        \MW\HelpTicket\Model\DefaFactory $defaFactory,
        \MW\HelpTicket\Model\TopicFactory $topicFactory,
        \MW\HelpTicket\Model\TicketFactory $ticketFactory,
        Template\Context $context,
        array $data = []
    )
    {
        $this->_defaFactory = $defaFactory;
        $this->_topicFactory = $topicFactory;
        $this->_ticketFactory = $ticketFactory;
        parent::__construct($context, $data);
    }
    public function getAll(){
        return $this->_defaFactory->create()->getCollection()->addFieldToFilter('status',['eq'=>1])->getData();
    }

    public function getActiveTab(){
            $param = $this->getRequest()->getParams();
            if (isset($param['tab_department'])) {
                return $param['tab_department'];
            }else return 0;
    }
    public function checkTicketContent(){
            $param = $this->getRequest()->getParams();
            if (isset($param['department_ticket'])) {
                 return $param['department_ticket'];
            }else return 0;
    }

    public function getTicketContent(){
            $param = $this->getRequest()->getParams();
            if (isset($param['department_ticket'])) {
                $list = $this->_ticketFactory->create()->getCollection();
                 $list->addFieldToFilter('topic_id',['eq'=>$param['department_ticket']]);
                 return $list->getData();
            }else return null;
    }

    public function getTopiclist($id){
        $list = $this->_topicFactory->create()->getCollection();
        $list->addFieldToFilter('department_id',['eq'=>$id])
            ->addFieldToFilter('status',['eq'=>1])
            ->setOrder('topic_id','DESC');
        return $list->getData();
    }
}
