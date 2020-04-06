<?php
namespace MW\HelpTicket\Model;

use Magento\Framework\Model\AbstractModel;

class Defa extends AbstractModel implements \Magento\Framework\DataObject\IdentityInterface{



    const CACHE_TAG = 'mw_help_defa';

    protected $_cacheTag = [self::CACHE_TAG];

    protected $_eventPrefix = 'mw_help_defa';

    protected function _construct()
    {
        $this->_init('MW\HelpTicket\Model\ResourceModel\Defa');
    }
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    public function getDefaultValue(){
        $value = [];
        return $value;
    }

    public function getAvailableStatuses()
    {
        return [1=>__('Enabled'),0=>__('Disabled')];
    }
}
