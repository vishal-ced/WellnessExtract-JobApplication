<?php
namespace WellnessExtract\JobApplication\Block;

use Magento\Directory\Model\ResourceModel\Country\CollectionFactory as CountryCollectionFactory;
use Magento\Framework\View\Element\Template;

/**
 * JobApplication content block
 */
class JobApplication extends \Magento\Framework\View\Element\Template
{
    /**
     * @var CountryCollectionFactory
     */
    protected $_countryCollectionFactory;

    /**
     * @param CountryCollectionFactory $countryCollectionFactory
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        CountryCollectionFactory $countryCollectionFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        $this->_countryCollectionFactory = $countryCollectionFactory;
        parent::__construct($context);
    }

    /**
     * Public function _prepareLayout
     *
     * @return mixed
     */
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    /**
     * Public function getAvailableCountries
     *
     * @return mixed
     */
    public function getAvailableCountries()
    {
        $collection = $this->_countryCollectionFactory->create();
        $collection->addFieldToSelect('*');
        return $collection;
    }
}
