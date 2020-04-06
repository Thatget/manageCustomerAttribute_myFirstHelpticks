<?php

namespace MW\CreAtt\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{

    const PRE_YES=1;
    const PRE_NO=0;

    public static function getOptionArray()
    {
        return [
            self::PRE_YES => __('Yes'),
            self::PRE_NO => __('No')
        ];
    }
    public function toOptionArray()
    {
        $res = [];
        foreach (self::getOptionArray() as $index => $value) {
            $res[] = ['value' => $index, 'label' => $value];
        }
        return $res;
    }
}