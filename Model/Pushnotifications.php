<?php
 
namespace Magentomobileshop\Pushnotification\Model;
 
use Magento\Framework\Model\AbstractModel;
 
class Pushnotifications extends AbstractModel
{
    /**
     * Define resource model
     */
    public function _construct()
    {
        $this->_init('Magentomobileshop\Pushnotification\Model\ResourceModel\Pushnotifications');
    }
}
