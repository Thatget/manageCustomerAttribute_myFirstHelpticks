<?php
namespace MW\CreAtt\Model\ResourceModel\Attribute;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'attribute_id';
    protected $_eventPrefix = 'create_attribute_collection';
    protected $_eventObject = 'create_collection';

    protected function _construct()
    {
        $this->_init(\MW\CreAtt\Model\Attribute::class,
            \MW\CreAtt\Model\ResourceModel\Attribute::class
        );
    }
    protected function _initSelect()
    {
        $object = \Magento\Framework\App\ObjectManager::getInstance();
        $webId = $object->get('\Magento\Store\Model\StoreManagerInterface')->getStore()->getWebsiteId();
        $this->getSelect()
            ->from(['main_table' => $this->getResource()->getMainTable()])
            ->joinLeft(
                ['table1' => $this->getTable('customer_eav_attribute')],
                'main_table.attribute_id = table1.attribute_id',
                [
                    'customer_visible'=>'table1.is_visible',
                    'customer_system' =>'table1.is_system',
                    'customer_sort' =>'table1.sort_order',
                    'is_required' =>'main_table.is_required',
                    'customer_system'=>'table1.is_system'
                ]
            )->joinLeft(
                ['table2'=>$this->getTable('customer_eav_attribute_website')],
                'table1.attribute_id = table2.attribute_id',
                ['website_required'=>'table2.is_required']
            )->joinLeft(
                ['table3' =>$this->getTable('customer_form_attribute')],
                'table2.attribute_id = table3.attribute_id',
                ['custom_form_code'=>'GROUP_CONCAT(table3.form_code)']
            )->group('main_table.attribute_id');
        $this->addFieldToFilter('main_table.frontend_label',['neq'=>''])
        ->addFieldToFilter('table2.website_id',['eq'=>(int)$webId])
        ->addFieldToFilter('main_table.entity_type_id',['eq'=>1]);
        $this->addFilterToMap('attribute_id', 'main_table.attribute_id');
    }

}
