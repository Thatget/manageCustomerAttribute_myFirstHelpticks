<?php
namespace MW\HelpTicket\Controller\Adminhtml\Defa;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use MW\HelpTicket\Model\ResourceModel\Defa\CollectionFactory;

class MassChange extends \Magento\Backend\App\Action implements HttpPostActionInterface
{

    protected $filter;

    protected $collectionFactory;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    )
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {

        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $co = $collection->getData();
        $collectionSize = $collection->getSize();
        foreach ($co as & $item){
            $item['status'] = ($item['status'] == 1)?0:1;
        }
        $i = 0;
        foreach ($collection as $page) {
            $page->setData($co[$i]);
            $page->save();
            $i++;
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been changed.', $collectionSize));

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('*/tick/defalist');
    }
}
