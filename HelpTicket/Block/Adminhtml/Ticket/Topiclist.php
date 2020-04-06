<?php
namespace MW\HelpTicket\Block\Adminhtml\Ticket;

use Magento\Backend\Block\Template;

class Topiclist extends Template {

    protected $_ticketFactory;
    protected $_topicFactory;

    public function __construct(
        \MW\HelpTicket\Model\TicketFactory $ticketFactory,
        \MW\HelpTicket\Model\TopicFactory $topicFactory,
        Template\Context $context,
        array $data = []
    )
    {
        $this->_ticketFactory = $ticketFactory;
        $this->_topicFactory = $topicFactory;
        parent::__construct($context, $data);
    }

    public function getTicketList($i){
        $list = $this->_ticketFactory->create()->getCollection()
            ->setOrder('ticket_id','DSEC')
            ->setPageSize(10)
            ->setCurPage($i);
        return $list->getData();
    }

    public function getSize(){
        $param = $this->getRequest()->getParams();
        if (isset($param['limit']))
        {
            return$param['limit'];
        }
        else{
            return 1;
        }
    }
}