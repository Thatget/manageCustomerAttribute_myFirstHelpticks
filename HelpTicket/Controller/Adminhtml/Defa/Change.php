<?php
namespace MW\HelpTicket\Controller\Adminhtml\Defa;

use Magento\Backend\App\AbstractAction;
use Magento\Backend\App\Action;

class Change extends AbstractAction {

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
        if ($this->getRequest()->getParams()) {
            $defa = $this->defaFactory->create();
            $params = $this->getRequest()->getParams();
            $data['title'] = $params['title'];
            $data['department_id'] = $params['department_id'] ?: null;
            $data['status'] = isset($params['status']) ? $params['status'] : 1;
            $data['staff'] = $params['staff'];
            $defa->setData($data);
            $defa->save();
            $this->_redirect('*/tick/defa');
        }
    }
}
