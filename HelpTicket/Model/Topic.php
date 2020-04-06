<?php
namespace MW\HelpTicket\Model;

use Magento\Framework\Model\AbstractModel;

class Topic extends AbstractModel implements \Magento\Framework\DataObject\IdentityInterface{



    const CACHE_TAG = 'mw_help_topic';

    protected $_cacheTag = [self::CACHE_TAG];

    protected $_eventPrefix = 'mw_help_topic';

    protected function _construct()
    {
        $this->_init('MW\HelpTicket\Model\ResourceModel\Topic');
    }
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    public function getDefaultValue(){
        $value = [];
        return $value;
    }
}
