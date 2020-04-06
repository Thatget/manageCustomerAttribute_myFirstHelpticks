<?php

namespace MW\CreAtt\Block\Adminhtml\Attribute\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveAndContinueButton extends GenericButton implements ButtonProviderInterface
{

    public function getButtonData()
    {
        $data = [];
        if ($this->canRender('save_and_continue_edit')) {
            $data = [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'on_click' => '',
                'sort_order' => 90,
            ];
        }
        return $data;
    }
}
