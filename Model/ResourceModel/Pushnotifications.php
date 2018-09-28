<?php

namespace Magentomobileshop\Pushnotification\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Pushnotifications extends AbstractDb
{
    /**
     * Define main table
     */
    public function _construct()
    {
        $this->_init('Magentomobileshop_Pushnotification', 'id');
    }
}
