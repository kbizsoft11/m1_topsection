<?php
class DivanteCommon_AdSection_Adminhtml_SectionController extends Mage_Adminhtml_Controller_Action
{

    protected function _initAction()
    {
        $this->loadLayout();

        return $this;
    }

    public function indexAction()
    {
        $this->_initAction()->renderLayout();
    }

    public function editAction()
    {
        Mage::register('adsection_section', $this->_getModel());
        $this->_initAction()->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }
public function saveAction()
{
    if ($data = $this->getRequest()->getPost()) {
        try {
            // Unset the form_key field
            unset($data['form_key']);

            $resource = Mage::getSingleton('core/resource');
            $connection = $resource->getConnection('core_write');
            $tableName = $resource->getTableName('kbizsoft_topsection');

            $data['created_at'] = now();
            $data['updated_at'] = now();

            $existingData = $connection->fetchRow("SELECT * FROM $tableName");
            if ($existingData) {
                // Update the existing row
                $connection->update($tableName, $data);
            } else {
                // Insert a new row
                $connection->insert($tableName, $data);
            }

            // Return success response
            $response = array('success' => true);
            $this->getResponse()->setBody(json_encode($response));
            return;
        } catch (Exception $e) {
            // Return error response
            $response = array('success' => false, 'error' => $e->getMessage());
            $this->getResponse()->setBody(json_encode($response));
            return;
        }
    }

    // If the form data is not available, return error response
    $response = array('success' => false, 'error' => 'No data received');
    $this->getResponse()->setBody(json_encode($response));
    return;
}



    public function deleteAction()
    {
        $row = $this->_getModel();
        if($row->getId()) {
            try {
                $row->delete();
                $this->_getSession()->addSuccess($this->__("Delete success."));
            } catch (Exception $e) {
                $this->_getSession()->addError($this->__("Delete error with message: " . $e->getMessage()));
            }
        }

        $this->_redirect('*/*/');
    }

    /**
     * @return DivanteCommon_AdSection_Model_Section
     */
    protected function _getModel()
    {
        $id = $this->getRequest()->getParam('id', false);
        /* @var $model DivanteCommon_AdSection_Model_Section */
        $model = Mage::getModel('divantecommon_adsection/section');

        /** @var $row DivanteCommon_AdSection_Model_Section */
        $row = $id ? $model->load($id) : $model;

        return $row;
    }

}
