<?php
namespace MW\HelpTicket\Model\ResourceModel\Ticket;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
    {
    protected $_idFieldName = 'ticket_id';
    protected $_eventPrefix = 'mw_ticket_collection';
    protected $_eventObject = 'ticket_collection';

    /**
    * Define resource model
    *
    * @return void
    */
    protected function _construct()
    {
        $this->_init('MW\HelpTicket\Model\Ticket', 'MW\HelpTicket\Model\ResourceModel\Ticket');
    }

}
