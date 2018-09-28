<?php

namespace Magentomobileshop\Pushnotification\Model\Config\Source;

class Orderlist implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $objectData                    = \Magento\Framework\App\ObjectManager::getInstance();
        $this->statusCollectionFactory = $objectData
            ->get('\Magento\Sales\Model\ResourceModel\Order\Status\CollectionFactory');
        $options = $this->statusCollectionFactory->create()->toOptionArray();
        return $options;
    }
}
