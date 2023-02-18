<?php
namespace WellnessExtract\JobApplication\Model\Source;

use WellnessExtract\JobApplication\Model\ResourceModel\JobApplication\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

class Department implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Public function toOptionArray
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '-- Please Select --', 'value' => ''];
        $collection = $this->collectionFactory->create()->distinct(true)
        ->addFieldToSelect('department');

        foreach ($collection as $category) {
            $options[] = [
                'label' => $category->getDepartment(),
                'value' => $category->getDepartment()
            ];
        }

        return $options;
    }
}
