<?php
namespace MW\HelpTicket\Model\Defa;

use Magento\Ui\DataProvider\AbstractDataProvider;
use MW\HelpTicket\Model\ResourceModel\Defa\CollectionFactory;

class DataProvider extends AbstractDataProvider{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $defaCollectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $defaCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    public function getData()
    {
        return [];
    }
}