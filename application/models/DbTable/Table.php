<?php

class Application_Model_DbTable_Table extends Zend_Db_Table_Abstract
{

    public function __construct($config) {
        parent::__construct($config);
    }

    public function getName() {
        return $this->_name;
    }

    public function getKey() {
        return $this->_primary;
    }
}