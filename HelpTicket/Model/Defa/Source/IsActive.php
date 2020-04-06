<?php

namespace MW\HelpTicket\Model\Defa\Source;

use Magento\Framework\Data\OptionSourceInterface;

class IsActive implements OptionSourceInterface
{

    protected $defa;

    public function __construct(\MW\HelpTicket\Model\Defa $defa)
    {
        $this->defa = $defa;
    }

    public function toOptionArray()
    {
        $availableOptions = $this->defa->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
