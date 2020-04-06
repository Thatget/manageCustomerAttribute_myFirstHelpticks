<?php
namespace MW\HelpTicket\Controller\Adminhtml\Tick;

use Magento\Backend\App\AbstractAction;
use Magento\Backend\App\Action;

class Save extends AbstractAction {

    protected $_defaFactory;
    protected $_ticketFactory;
    protected $_topicFactory;

    public function __construct(
        \MW\HelpTicket\Model\DefaFactory $defaFactory,
        \MW\HelpTicket\Model\TopicFactory $topicFactory,
        \MW\HelpTicket\Model\TicketFactory $ticketFactory,
        Action\Context $context
    )
    {
        $this->_defaFactory = $defaFactory;
        $this->_ticketFactory = $ticketFactory;
        $this->_topicFactory = $topicFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();
        if (isset($params)) {
            $defa = $this->_defaFactory->create()->load($params['department_id'])->getData();
            $ticketData = array();
            $ticketData['topic_id'] = $params['topic_id'];
            $ticketData['department_id'] = $params['department_id'];
            $ticketData['topic'] = "service";
            $ticketData['department'] = $defa['title'] . '(' . $defa['staff'] . ')';
            $ticketData['content'] = $params['content'];
            $ticket = $this->_ticketFactory->create();
            $ticket->setData($ticketData);
            $ticket->save();
            $this->messageManager->addSuccessMessage(
                __('Done!.')
            );
        }
        $this->_redirect('*/tick/defa');
    }
}
