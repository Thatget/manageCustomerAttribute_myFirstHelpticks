<?php
namespace MW\HelpTicket\Controller\Adminhtml\Defa;

use Magento\Backend\App\AbstractAction;
use Magento\Backend\App\Action;

class Remove extends AbstractAction {

    protected $defaFactory;

    public function __construct(
        \MW\HelpTicket\Model\DefaFactory $defaFactory,
        Action\Context $context
    )
    {
        $this->defaFactory = $defaFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $url = $this->resultRedirectFactory->create();
        $department_id = $this->getRequest()->getParams()['department_id'];
        try {
            $model = $this->defaFactory->create();
            $model->load($department_id);
            $model->delete();
        }catch (\Exception $e){
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        return $url->setPath('*/tick/defalist');
    }
}
