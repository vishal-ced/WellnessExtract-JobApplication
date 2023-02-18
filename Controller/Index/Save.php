<?php
namespace WellnessExtract\JobApplication\Controller\Index;

use Magento\Framework\App\Action\Context;
use WellnessExtract\JobApplication\Model\JobApplicationFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;
/**
 * jobform of Save
 *
 * @author vishal singh
 */
class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var JobApplicationFactory
     */
    protected $_jobapplication;

    /**
     * @var UploaderFactory
     */
    protected $_fileUploaderFactory;

    /**
     * @var DirectoryList
     */
    protected $_directory_list;

    /**
     * @var Filesystem
     */
    protected $_filesystem;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @param Context $context
     * @param JobApplicationFactory $jobapplication
     * @param UploaderFactory $fileUploaderFactory
     * @param DirectoryList $directory_list
     * @param Filesystem $filesystem
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        JobApplicationFactory $jobapplication,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        \Magento\Framework\App\Filesystem\DirectoryList $directory_list,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_jobapplication = $jobapplication;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_directory_list = $directory_list;
        $this->_storeManager = $storeManager;
        $this->_filesystem = $filesystem;
        parent::__construct($context);
    }

    /**
     * Public function execute
     *
     * @return void
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        if (isset($data['department'])) {
            if ($data['department'] == 'custom') {
                $data['department'] = $data['job_title'];
            }
            $success = false;
            $extError = true;
            $responseArray = array();

            $jobapplication = $this->_jobapplication->create();
            $filenameArray = isset($_FILES['resume']['name']) ? $_FILES['resume']['name'] : array();
            $arrdata = explode(" ",$filenameArray);
            $filename = "";
            foreach ($arrdata as $index => $value) {
                $ext = pathinfo($value, PATHINFO_EXTENSION);
                $filename = $value;

            } if (in_array(strtolower($ext), ['pdf', 'doc', 'docx'])) {
                if($filename != ''){
                    $path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('wellnessextract/jobapplication/');

                    $file_name = $_FILES['resume']['name'];
                    $Arr = explode(' ', $file_name);
                    $resume = implode("_", $Arr);
                    $data['resume'] = $resume;
                    $targetFile = $path.'/'. $resume;;
                    $tmpnameArray = isset($_FILES['resume']['tmp_name']) ? $_FILES['resume']['tmp_name'] : array();
                    $tempname = "";
                    $arrda = explode(" ",$tmpnameArray);
                    foreach ($arrda as $index => $value) {
                        $tempname = $value;
                    }
                    if($tempname != ''){

                        if (move_uploaded_file($tempname, $targetFile)) {
                            $success = true;
                        }
                    }
                }
            } else {
                $this->messageManager->addErrorMessage(__('Please upload only PDF, DOC, DOCX.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setRefererOrBaseUrl();
                return $resultRedirect;
                $extError = true;
            }
            if($success){
                $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
                $data['resume'] = $resume;;
            }
            if (isset($data['ethnicity'])) {
                $data['ethnicity'] = implode(", ", $data['ethnicity']);
            }
            $jobapplication->setData($data);
            try {
                $jobapplication->save();
                $this->messageManager->addSuccess(__('Job Application has been saved successfully.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setRefererOrBaseUrl();
                return $resultRedirect;

            } catch (\Exception $e) {
                echo $e->getMessage();
                $this->messageManager->addException($e, __('Something went wrong while saving the Job Application.'));
            }
        }
    }
}