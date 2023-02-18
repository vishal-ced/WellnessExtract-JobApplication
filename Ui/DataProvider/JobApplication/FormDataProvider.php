<?php

namespace WellnessExtract\JobApplication\Ui\DataProvider\JobApplication;

/**
 * Class DataProvider for Zalando Feeds
 */
class FormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var $collection
     */
    public $collection;

    /**
     * @var $addFieldStrategies
     */
    public $addFieldStrategies;

    /**
     * @var $addFilterStrategies
     */
    public $addFilterStrategies;

    /**
     * @param string|array $name
     * @param string|array $primaryFieldName
     * @param string|array $requestFieldName
     * @param \WellnessExtract\JobApplication\Model\ResourceModel\JobApplication\CollectionFactory $collectionFactory
     * @param array $addFieldStrategies
     * @param array $addFilterStrategies
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \WellnessExtract\JobApplication\Model\ResourceModel\JobApplication\CollectionFactory $collectionFactory,
        $addFieldStrategies = [],
        $addFilterStrategies = [],
        $meta = [],
        $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->addFieldStrategies = $addFieldStrategies;
        $this->addFilterStrategies = $addFilterStrategies;
    }

    /**
     * Public function getData
     *
     * @return array
     */
    public function getData()
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }
        $this->_loadedData=[];
        $items = $this->collection->getItems();
        foreach ($items as $jobapplication) {
            $data = $jobapplication->getData();
            $data['view'] = true;
            $this->_loadedData[$jobapplication->getId()] = $data;
        }
        return $this->_loadedData;
    }
}
