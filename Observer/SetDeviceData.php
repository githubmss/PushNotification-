<?php
namespace Magentomobileshop\Pushnotification\Observer;

use Magentomobileshop\Pushnotification\Helper\Data;
use \Magento\Framework\Event\Observer;
use \Magento\Framework\Event\ObserverInterface;

class SetDeviceData implements ObserverInterface
{

    public function __construct(
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    ) {
        $this->jsonHelper        = $jsonHelper;
        $this->resultJsonFactory = $resultJsonFactory;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $result = $this->resultJsonFactory->create();
        if ($observer->getData('order')) {
            $result                = [];
            $order                 = $observer->getData('order');
            $result['device_type'] = $observer->getData('device_type')
            ? $observer->getData('device_type') : 0;
            $result['device_registraton'] = $observer->getData('device_registraton') ?
            $observer->getData('device_registraton') : null;
            $finalResult = $this->jsonHelper->jsonEncode($result);
            $order->setDeviceData($finalResult);
            $order->addStatusToHistory($order->getStatus(), 'User is notified by his app');
            try {
                $order->save();
            } catch (\Exception $e) {
                $result->setData(['status' => 'error', 'message' => __($e->getMessage())]);
                return $result;
            }
        }
    }
}
