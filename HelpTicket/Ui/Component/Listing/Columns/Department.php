<?php

namespace MW\HelpTicket\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class Actions
 */
class Department extends Column
{

    protected $defaFactory;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \MW\HelpTicket\Model\DefaFactory $defaFactory,
        array $components = [],
        array $data = []
    )
    {
        $this->defaFactory = $defaFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {

            $department = $this->defaFactory->create();

            foreach ($dataSource['data']['items'] as & $item) {

                $departmentName = $department->load($item['department_id']);
                $item[$this->getData('name')] = $departmentName['title'].'('.$departmentName['staff'].')';
            }
        }

        return $dataSource;
    }
}
