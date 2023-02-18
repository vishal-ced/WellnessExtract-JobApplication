<?php

namespace WellnessExtract\JobApplication\Model;

use Magento\Framework\Model\AbstractModel;

class JobApplication extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(\WellnessExtract\JobApplication\Model\ResourceModel\JobApplication::class);
    }
}
