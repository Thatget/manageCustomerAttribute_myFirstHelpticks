<?php
namespace MW\HelpTicket\Model\ResourceModel\Topic;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
    {
    protected $_idFieldName = 'topic_id';
    protected $_eventPrefix = 'mw_topic_collection';
    protected $_eventObject = 'topic_collection';

    /**
    * Define resource model
    *
    * @return void
    */
    protected function _construct()
    {
        $this->_init('MW\HelpTicket\Model\Topic', 'MW\HelpTicket\Model\ResourceModel\Topic');
    }

}
