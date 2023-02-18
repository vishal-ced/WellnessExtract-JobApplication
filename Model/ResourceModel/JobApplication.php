<?php

namespace WellnessExtract\JobApplication\Model\ResourceModel;

class JobApplication extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('job_application', 'id');
    }
}
