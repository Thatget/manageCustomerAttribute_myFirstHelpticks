<?php

namespace MW\HelpTicket\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class Actions
 */
class Actions extends Column
{

    const DEFA_URL_PATH_CHANGE = 'helptick/defa/change';
    const DEFA_URL_PATH_REMOVE = 'helptick/defa/remove';

    protected $urlBuilder;

    public function __construct(
        UrlInterface $urlBuilder,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    )
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if($item['status']==0) {
                   $label = 'Enable';
                }else  $label = 'Disable';
                $item[$this->getData('name')] = [
                    'remove' => [
                        'href' => $this->urlBuilder->getUrl(self::DEFA_URL_PATH_REMOVE,['department_id'=>$item['department_id']]),
                        'label' => __('Remove')
                    ],
                    'change' => [
                        'href' => $this->urlBuilder->getUrl(self::DEFA_URL_PATH_CHANGE,['department_id'=>$item['department_id']]),
                        'label' => __($label)
                    ],
                ];
            }
        }

        return $dataSource;
    }
}
