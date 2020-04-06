<?php
namespace MW\HelpTicket\Model\ResourceModel\Defa;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'department_id';
    protected $_eventPrefix = 'mw_defa_collection';
    protected $_eventObject = 'defa_collection';

    /**
    * Define resource model
    *
    * @return void
    */
    protected function _construct()
    {
        $this->_init('MW\HelpTicket\Model\Defa', 'MW\HelpTicket\Model\ResourceModel\Defa');
    }

}
