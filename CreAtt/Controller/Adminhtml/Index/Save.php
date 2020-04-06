<?php

namespace MW\CreAtt\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\Customer;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class Save extends Action implements HttpPostActionInterface
{

    const ADMIN_RESOURCE = 'Magento_Customer::customer';
    protected $_eavSetupFactory;
    protected $_setup;
    protected $_eavConfig;

    public function __construct(
        ModuleDataSetupInterface $setup,
        Action\Context $context,
        Config $eavConfig,
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->_eavConfig = $eavConfig;
        $this->_setup = $setup;
        $this->_eavSetupFactory = $eavSetupFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        $system = !empty($data['customer_system'])?(int)$data['customer_system']:0;
        $position = !empty($data['customer_sort'])?(int)$data['customer_sort']:999;
        $attributeCode = !empty($data['attribute_code'])?$data['attribute_code']:strtolower(str_replace(' ','_',$data['frontend_label']));
        $eavlSetup = $this->_eavSetupFactory->create(['setup'=>$this->_setup]);
        $eavlSetup->addAttribute(
            Customer::ENTITY,
            $attributeCode,
            [
                'type'         => !empty($data['data_type'])?$data['data_type']:'varchar',
                'label'        => $data['frontend_label'],
                'input'        => !empty($data['input_type'])?$data['input_type']:'text',
                'required'     => (bool)$data['is_required'],
                'visible'      => (bool)$data['customer_visible'],
                'user_defined' => (bool)$data['is_user_defined'],
                'position'     => $position,
                'system'       => $system,
            ]
        );
        $newAttribute = $this->_eavConfig->getAttribute(Customer::ENTITY,$attributeCode);
        $newAttribute->setData(
            'used_in_forms',
            $data['custom_form_code']
        );
        $newAttribute->save();
        return $resultRedirect->setPath('*/*/');
    }
}
