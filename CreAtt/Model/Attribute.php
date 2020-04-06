<?php
namespace MW\CreAtt\Model;

use Magento\Framework\Model\AbstractModel;

class Attribute extends AbstractModel implements \Magento\Framework\DataObject\IdentityInterface{



    const CACHE_TAG = 'mw_create_attribute';

    protected $_cacheTag = [self::CACHE_TAG];

    protected $_eventPrefix = 'create_attribute';

    protected function _construct()
    {
        $this->_init(\MW\CreAtt\Model\ResourceModel\Attribute::class);
    }
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    public function getDefaultValue()
    {
        $value = [];
        return $value;
    }
}
