<?php

namespace WellnessExtract\JobApplication\Model\ResourceModel\JobApplication;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var $_idFieldName
     */
    protected $_idFieldName = 'id';

    /**
     * Protected function _construct
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \WellnessExtract\JobApplication\Model\JobApplication::class,
            \WellnessExtract\JobApplication\Model\ResourceModel\JobApplication::class
        );
    }
}
