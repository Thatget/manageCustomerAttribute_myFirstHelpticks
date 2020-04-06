<?php

namespace MW\CreAtt\Model\OptionSource;

use Magento\Framework\Data\OptionSourceInterface;

class Display implements OptionSourceInterface
{

    public function toOptionArray(): array
    {
        $array = [];
        $array[] = array('label' => 'Admin Checkout', 'value' => 'adminhtml_checkout');
        $array[] = array('label' => 'Admin Customer', 'value' => 'adminhtml_customer');
        $array[] = array('label' => 'Admin Customer Address', 'value' => 'adminhtml_customer_address');
        $array[] = array('label' => 'Customer Address Edit', 'value' => 'customer_address_edit');
        $array[] = array('label' => 'Customer Account Create', 'value' => 'customer_account_create');
        $array[] = array('label' => 'Customer Register Address', 'value' => 'customer_register_address');
        return $array;
    }
}
