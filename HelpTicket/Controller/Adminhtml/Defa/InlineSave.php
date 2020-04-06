<?php
namespace MW\HelpTicket\Controller\Adminhtml\Defa;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;


class InlineSave extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    protected $jsonFactory;
    protected $loger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        Context $context,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->loger = $logger;
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParams()['items'];
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $entityId) {
                    $model = $this->_objectManager->create('MW\HelpTicket\Model\Defa')->load($entityId);
                    try {
                        $model->setData(array_merge($model->getData(), (array)$postItems[$entityId]));
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Error:]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
