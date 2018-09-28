<?php
namespace Magentomobileshop\Pushnotification\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Backend\App\Action
{
    private $resultPageFactory;
    //@codingStandardsIgnoreStart
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory) {
        $this->resultPageFactory = $resultPageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->resultPageFactory->create();
    }//@codingStandardsIgnoreEnd
}
