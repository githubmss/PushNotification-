<?php

namespace Magentomobileshop\Pushnotification\Model\Config\Backend;

class CustomFileType extends \Magento\Config\Model\Config\Backend\File
{
    /**
     * @return string[]
     */
    public function _getAllowedExtensions()
    {
        return ['pem'];
    }
}
