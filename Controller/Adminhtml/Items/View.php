<?php
namespace WellnessExtract\JobApplication\Controller\Adminhtml\Items;

use Magento\Framework\Controller\ResultFactory;

class View extends \Magento\Backend\App\Action
{
    /**
     * Public function execute
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $resultPage;
    }
}
