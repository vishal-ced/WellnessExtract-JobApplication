<?php
namespace WellnessExtract\JobApplication\Ui\Component\Listing\Column;

class JobApplicationActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    public const URL_PATH_VIEW = 'wellnessextract_jobapplication/items/view';

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    /**
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Public function prepareDataSource
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href' => $this->_urlBuilder->getUrl(
                            static::URL_PATH_VIEW,
                            [
                                'id' => $item['id']
                            ]
                        ),
                        'label' => __('View')
                    ],
                ];
            }
        }
        return $dataSource;
    }
}
