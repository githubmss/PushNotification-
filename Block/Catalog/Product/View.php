<?php

namespace Magentomobileshop\Pushnotification\Block\Catalog\Product;

class View extends \Magento\Catalog\Block\Product\View
{
    /**
     * Retrieve current product model
     *
     * @return \Magento\Catalog\Model\Product
     */
    //@codingStandardsIgnoreStart
    public function getProduct()
    {
        // logging to test override
        return parent::getProduct();
    }//@codingStandardsIgnoreEnd
}
