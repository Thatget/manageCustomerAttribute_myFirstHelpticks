<?php
namespace MW\CreAtt\Model\Attribute;

use MW\CreAtt\Model\ResourceModel\Attribute\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $employeeCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        if (!empty($items)) {
            foreach ($items as $employee) {
                $this->_loadedData[$employee->getId()] = $employee->getData();
                $this->_loadedData[$employee->getId()]['custom_form_code'] =
                    explode(',',$employee->getData()['custom_form_code']);
                $this->_loadedData[$employee->getId()]['do_we_hide_it'] = true;
            }
        }
        return $this->_loadedData;
    }
}