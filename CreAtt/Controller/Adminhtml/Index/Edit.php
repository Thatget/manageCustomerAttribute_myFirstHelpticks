<?php

namespace MW\CreAtt\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Backend\App\Action;


class Edit extends \Magento\Backend\App\Action implements HttpGetActionInterface
{

    protected $_coreRegistry;

    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    protected function _initAction()
    {
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('attribute_id');
        $model = $this->_objectManager->create(\MW\CreAtt\Model\Attribute::class);

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This attribute no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Attribute') : __('New Attribute'),
            $id ? __('Edit Attribute') : __('New Attribute')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Attribute'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('New Attribute'));

        return $resultPage;
    }
}
