<?php
/**
 * @method DivanteCommon_AdSection_Model_Section setIdentifier(string $identifier)
 * @method string getIdentifier()
 * @method DivanteCommon_AdSection_Model_Section setName(string $name)
 * @method string getName()
 * @method DivanteCommon_AdSection_Model_Section setDescription(string $description)
 * @method string getDescription()
 * @method DivanteCommon_AdSection_Model_Section setCreatedAt(string $date)
 * @method string getCreatedAt()
 * @method DivanteCommon_AdSection_Model_Section setUpdatedAt(string $date)
 * @method string getUpdatedAt()
 */
class DivanteCommon_AdSection_Model_Section extends Mage_Core_Model_Abstract
{

    protected $_eventPrefix = 'kbizsoft_topsection';

    protected function _construct()
    {
        $this->_init('divantecommon_adsection/section');
        parent::_construct();
    }

    /**
     * Save section data to the kbizsoft_topsection table
     *
     * @return DivanteCommon_AdSection_Model_Section
     */
    public function save()
    {
        $isNewSection = !$this->getId();
        if ($isNewSection) {
            $this->setCreatedAt(now());
        }
        $this->setUpdatedAt(now());

        parent::save();

        return $this;
    }

    /**
     * Get the collection for kbizsoft_topsection table
     *
     * @param bool $useStoreFilter
     * @return DivanteCommon_AdSection_Model_Resource_Section_Collection
     */
    public function getCollection($useStoreFilter = false)
    {
        /** @var $collection DivanteCommon_AdSection_Model_Resource_Section_Collection */
        $collection = Mage::getResourceModel('divantecommon_adsection/section_collection');
        if ($useStoreFilter) {
            $stores = array(0, Mage::app()->getStore()->getId());
            $collection->addFieldToFilter('store_id', array('in' => $stores));
        }
        return $collection;
    }
}
