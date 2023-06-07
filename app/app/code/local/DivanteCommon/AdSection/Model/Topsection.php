<?php

class DivanteCommon_AdSection_Model_Resource_Topsection extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('divantecommon_adsection/topsection', 'id');
    }
}
