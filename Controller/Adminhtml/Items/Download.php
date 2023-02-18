<?php
namespace WellnessExtract\JobApplication\Controller\Adminhtml\Items;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Download extends Action
{
    /**
     * @var \WellnessExtract\JobApplication\Model\JobApplicationFactory
     */
    public $blogFactory;

    /**
     * @param Context $context
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     * @param \Magento\Framework\Filesystem\DirectoryList $directory
     * @param \WellnessExtract\JobApplication\Model\JobApplicationFactory $blogFactory
     */
    public function __construct(
        Context $context,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\Filesystem\DirectoryList $directory,
        \WellnessExtract\JobApplication\Model\JobApplicationFactory $blogFactory
    ) {
         $this->blogFactory = $blogFactory;
         $this->_downloader = $fileFactory;
         $this->directory = $directory;
        parent::__construct($context);
    }

    /**
     * Public function execute
     *
     * @return mixed
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        try {
            $blogModel = $this->blogFactory->create();
            $blogModel->load($id);
            $fileName = $blogModel->getResume();
            $file = $this->directory->getPath("media")."/wellnessextract/jobapplication/".$fileName;
            return $this->_downloader->create(
                $fileName,
                @file_get_contents($file)
            );

        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
                    $this->messageManager->addErrorMessage(__('Your pdf file is not downloaded.'));
            return $resultRedirect->setPath('wellnessextract_jobapplication/*/');
        }
    }
}
