<?php
namespace MW\HelpTicket\Controller\Adminhtml\Topic;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Topiclist extends Action
{

    protected $resultFactory;

    public function __construct(
        ResultFactory $resultFactory,
        Action\Context $context
    )
    {
        $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $response = $this->resultFactory
        ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
        ->setData([
            'status'  => "ok",
            'content' => "form submitted correctly"
        ]);
        return $response;
    }
}
