<?php
namespace WellnessExtract\JobApplication\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * Public function execute
     *
     * @return void
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
