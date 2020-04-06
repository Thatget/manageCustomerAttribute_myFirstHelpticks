<?php
namespace MW\HelpTicket\Model\ResourceModel;

class Defa extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('mw_helpticket_department', 'department_id');
    }
}
