<?php

namespace Magentomobileshop\Pushnotification\Controller\Index;

use Magento\Framework\App\Action\Context;
use \Magentomobileshop\Pushnotification\Model\PushnotificationsFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    private $resultPageFactory;//@codingStandardsIgnoreStart
    public function __construct(
        Context $context,
        PushnotificationsFactory $modelNotificationsFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magentomobileshop\Connector\Helper\Data $customHelper,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\Json\Helper\Data $jsonHelper
    ) {
        $this->resultPageFactory  = $resultPageFactory;
        $this->resultJsonFactory  = $resultJsonFactory;
        $this->modelNotifications = $modelNotificationsFactory;
        $this->scopeConfig        = $scopeConfig;
        $this->_storeManager      = $storeManager;
        $this->customHelper       = $customHelper;
        $this->jsonHelper         = $jsonHelper;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->customHelper->loadParent($this->getRequest()->getHeader('token'));
        $this->storeId  = $this->customHelper->storeConfig($this->getRequest()->getHeader('storeid'));
        $this->viewId   = $this->customHelper->viewConfig($this->getRequest()->getHeader('viewid'));
        $this->currency = $this->customHelper->currencyConfig($this->getRequest()->getHeader('currency'));
        $params         = $this->getParams();
        $finalInput     = json_decode($params, true);
        $result         = $this->resultJsonFactory->create();
        $model          = $this->modelNotifications->create();
        $deviceFilter   = $model->getCollection()
            ->addFieldToFilter('device_id', ['eq' => $finalInput['device_id']])
            ->getFirstItem();
        if (!empty($deviceFilter)) {
            if ($finalInput['registration_id'] != $deviceFilter['registration_id']) {
                $finalInput['id']          = $deviceFilter['id'];
                $finalInput['create_date'] = $deviceFilter['create_date'];
                $finalInput['update_date'] = date("Y-m-d");
                $finalInput['app_status']  = 1;
                $model->setData($finalInput)->save();
            }
        } else {
            if (!empty($finalInput['device_id'])) {
                $finalInput['create_date'] = date("Y-m-d");
                $finalInput['update_date'] = date("Y-m-d");
                $finalInput['app_status']  = 1;
                $model->setData($finalInput)->save();
            }
        }
        return $result->setData(['status' => "success", 'message' => 'Device registered.']);
    }//@codingStandardsIgnoreEnd

    private function getParams()
    {
        //@codingStandardsIgnoreStart
        return file_get_contents("php://input");
        //@codingStandardsIgnoreEnd
    }
}
