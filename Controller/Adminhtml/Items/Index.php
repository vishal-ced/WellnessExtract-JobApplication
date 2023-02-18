<?php
namespace WellnessExtract\JobApplication\Controller\Adminhtml\Items;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Backend\App\Action
{

    /**
     * @var ResultFactory
     */
    protected $resultPageFactory;


    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param ResultFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\ResultFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Public function execute
     *
     * @return mixed
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create(ResultFactory::TYPE_PAGE);
        return $resultPage;
    }
}
