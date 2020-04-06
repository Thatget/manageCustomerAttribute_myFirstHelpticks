<?php
namespace MW\HelpTicket\Model;

use Magento\Framework\Model\AbstractModel;

class Ticket extends AbstractModel implements \Magento\Framework\DataObject\IdentityInterface{



    const CACHE_TAG = 'mw_help_ticket';

    protected $_cacheTag = [self::CACHE_TAG];

    protected $_eventPrefix = 'mw_help_ticket';

    protected function _construct()
    {
        $this->_init('MW\HelpTicket\Model\ResourceModel\Ticket');
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
