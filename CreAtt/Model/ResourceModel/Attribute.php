<?php
namespace MW\CreAtt\Model\ResourceModel;

class Attribute extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('eav_attribute','attribute_id');
    }
}
