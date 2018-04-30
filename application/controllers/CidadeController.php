<?php

class CidadeController extends Zend_Controller_Action
{

    public function init()
    {

        $this->model = new Application_Model_Cidade();
    }

    public function indexAction()
    {
        // action body
    }

    public function restAction()
    {

      if($this->getParam('estado_id') != null) {

        $obj = $this->model->fetchAll(array('fk_estado_id' => $this->getParam('estado_id')));

        $this->_helper->json($obj);
      }

    }

}
