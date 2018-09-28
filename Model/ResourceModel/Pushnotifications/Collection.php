<?php

namespace Magentomobileshop\Pushnotification\Model\ResourceModel\Pushnotifications;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    public function _construct()
    {
        $this->_init(
            'Magentomobileshop\Pushnotification\Model\Pushnotifications',
            'Magentomobileshop\Pushnotification\Model\ResourceModel\Pushnotifications'
        );
    }
}
